<?php

namespace Villato;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements SluggableInterface
{

    use SluggableTrait;

    public $timestamps = true;
    protected $table = 'category';
    protected $guarded = [''];
    protected $sluggable = [
        'build_from' => 'name',
        'save_to' => 'slug',
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($company) {
            $productIds = $company->products()->lists('product.id');
            Product::whereIn('id', $productIds)->delete();
        });
    }

    /**
     * Products relation for category
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function products()
    {
        return $this->hasMany('Villato\Product');
    }

    /**
     * Products relation for Company
     *
     * @return mixed
     */
    public function company()
    {
       // echo "hi";exit();
        return $this->belongsToMany('Villato\Company', 'company_category', 'category_id', 'company_id')
            ->distinct();
    }
    
    /**
     * Secondary Region relation for Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function regions()
    {
        return $this->belongsToMany('Villato\Region', 'category_region_relation', 'category_id', 'region_id');
    }

}
