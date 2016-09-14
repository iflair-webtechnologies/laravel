<?php

namespace Villato;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{

    use SoftDeletes;

    protected $table = 'offer';
    public $timestamps = true;
    protected $fillable = ['title', 'description', 'content'];
    protected $dates = ['deleted_at'];
    protected $appends = ['image'];

    /**
     * Query scope for offers in primary region
     *
     * @param $query
     * @param Region $region
     * @return mixed
     */
    public function scopeInPrimaryRegion($query, Region $region)
    {
        if ($region->exists) {
            return $query->whereHas('company.region', function ($q) use ($region) {
                $q->where('region.id', '=', $region->id);
            });
        }

        return $query;
    }

    /**
     * Query scope for offers in secondary region
     *
     * @param $query
     * @param Region $region
     * @return mixed
     */
    public function scopeInSecondaryRegion($query, Region $region)
    {
        if ($region->exists) {
            return $query->whereHas('company.regions', function ($q) use ($region) {
                $q->where('region.id', '=', $region->id);
            });
        }

        return $query;
    }

    /**
     * Query scope for offers in primary or secondary region
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
     * Query scope for recently created offers
     *
     * @param $query
     * @param Region $region
     * @return mixed
     */
    public function scopeRecentlyCreated($query, Region $region)
    {
        return $query->inPrimaryRegion($region)->orderBy('created_at', 'desc');
    }

    /**
     * Query scope for offers in category
     *
     * @param $query
     * @param Category $category
     * @param Region $region
     * @return mixed
     */
    public function scopeInCategory($query, Category $category, Region $region)
    {
        return $query->inSecondaryRegion($region)->whereHas('company.products.category', function ($q) use ($category) {
            $q->where('category.id', '=', $category->id);
        });
    }

    /**
     * Query scope for offers in company
     *
     * @param $query
     * @param Company $company
     * @return mixed
     */
    public function scopeInCompany($query, Company $company)
    {
        return $query->whereHas('company', function ($q) use ($company) {
            $q->where('company.id', '=', $company->id);
        });
    }

    /**
     * Get Offer Image url attribute
     *
     * @return Route
     */
    public function getImageAttribute()
    {
        if(!$this->images->isEmpty()) {
            return route('imagecache', ['large', $this->images->first()->path]);
        }

        return null;
    }

    /**
     * Company relation for offer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo('Villato\Company');
    }

    /**
     * Images relation for offer
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {
        return $this->morphMany('Villato\Image', 'imageable');
    }

}
