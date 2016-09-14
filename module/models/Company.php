<?php

namespace Villato;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Route;
use Sofa\Eloquence\Eloquence;
use DB;
class Company extends Model implements AuthenticatableContract, CanResetPasswordContract, SluggableInterface
{

    use Authenticatable, CanResetPassword, SoftDeletes, SluggableTrait, Eloquence;

    public $timestamps = true;
    protected $table = 'company';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'email',
        'password',
        'name',
        'info',
        'extra_info',
        'phone',
        'mobile',
        'street',
        'postal_code',
        'website',
        'facebook',
        'newsletter'
    ];
    protected $sluggable = [
        'build_from' => 'name',
        'save_to' => 'slug',
    ];
    protected $searchableColumns = ['name'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($company) {
            $vacancyIds = $company->vacancies()->lists('vacancy.id');
            Vacancy::whereIn('id', $vacancyIds)->delete();

            $offerIds = $company->offers()->lists('offer.id');
            Offer::whereIn('id', $offerIds)->delete();

            $newsIds = $company->news()->lists('news.id');
            News::whereIn('id', $newsIds)->delete();
        });

    }

    /**
     * Query scope for companies in primary Region
     *
     * @param $query
     * @param Region $region
     * @return mixed
     */
    public function scopeInPrimaryRegion($query, Region $region)
    {
        if ($region->exists) {
            return $query->whereHas('region', function ($q) use ($region) {
                $q->where('region.id', '=', $region->id);
            });
        }

        return $query;
    }

    /**
     * Query scope for companies in secondary Region
     *
     * @param $query
     * @param Region $region
     * @return mixed
     */
    public function scopeInSecondaryRegion($query, Region $region)
    {
        if ($region->exists) {
            return $query->whereHas('regions', function ($q) use ($region) {
                $q->where('region.id', '=', $region->id);
            });
        }

        return $query;
    }

    /**
     * Query scope for Company in primary or secondary region
     *
     * @param $query
     * @param Region $region
     * @return mixed
     */
    public function scopeInPrimaryOrSecondaryRegion($query, Region $region)
    {
        return $query->where(function ($query) use ($region) {
            $query->inPrimaryRegion($region);
            $query->orWhere(function ($query) use ($region) {
                $query->inSecondaryRegion($region);
            });
        });
    }

    /**
     * Query scope for recently created companies
     *
     * @param $query
     * @param Region $region
     * @return mixed
     */
    public function scopeRecentlyCreated($query, Region $region)
    {
        if ($region->exists) {
            $query->inPrimaryRegion($region);
        }

        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Query scope for companies in Category
     *
     * @param $query
     * @param Category $category
     * @param Region $region
     * @return mixed
     */
    public function scopeInCategory($query, Category $category, Region $region)
    {
        if ($region->exists) {
            $query->inPrimaryRegion($region);
        }

        return $query->whereHas('products.category', function ($q) use ($category) {
            $q->where('category.id', '=', $category->id);
        });
    }

    /**
     * Get Company Detail url attribute
     *
     * @return Route
     */
    public function getUrlAttribute()
    {
      
        return route('region.company.detail', [$this->region->slug, $this->slug]);
    }

    /**
     * Get full address attribute
     *
     * @return string
     */
    public function getFullAddressAttribute()
    {
        return $this->street . ', ' . $this->postal_code;
    }

    /**
     * Set password attribute
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = (!empty($value) ? bcrypt($value) : $this->password);
    }

    /**
     * Images Relation for Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {
        return $this->morphMany('Villato\Image', 'imageable');
    }

    /**
     * Products relation for Company
     *
     * @return mixed
     */
    public function products()
    {
        return $this->belongsToMany('Villato\Product', 'company_product', 'company_id', 'product_id')
            ->distinct();
    }

    /**
     * Secondary Region relation for Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */    

     /**
     * Secondary Region relation for Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function saveuserregion($data)
    {
        //dd($data);
        DB::table('company_region')->insert($data);
    }
    /**
     * Secondary Region relation for Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function category()
    {
        return $this->belongsToMany('Villato\Category', 'company_category', 'company_id', 'category_id');
    }

    /**
     * Primary Region relation for Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function regions()
    {
       // echo "hi";exit;
        return $this->belongsToMany('Villato\Region', 'company_region', 'company_id', 'region_id');     
    }

    /**
     * Returns all company categories
     *
     * @return mixed
     */
    public function categories()
    {
        $model = new Category();
       // echo "hi";die();    
        // return $model->join('product', 'product.category_id', '=', 'category.id')
        //     ->join('company_region_product', 'company_region_product.product_id', '=', 'product.id')
        //     ->select('category.*')
        //     ->where('company_region_product.company_id', '=', $this->id)
        //     ->distinct()->get();
        return $model->join('company_category', 'company_category.category_id', '=', 'category.id')
            ->select('category.*')
            ->where('company_category.company_id', '=', $this->id)
            ->distinct()->get();
    }

    /**
     * Vacancy relation for Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vacancies()
    {
        return $this->hasMany('Villato\Vacancy');
    }

    /**
     * News relation for Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function news()
    {
        return $this->hasMany('Villato\News');
    }

    /**
     * Offer relation for Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offers()
    {
        return $this->hasMany('Villato\Offer');
    }
    public function advertisement()
    {
        return $this->hasMany('Villato\Advertisement');
    }

}
