<?php

namespace Villato;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacancy extends Model
{

    use SoftDeletes;

    public $timestamps = true;
    protected $table = 'vacancy';
    protected $fillable = ['title', 'description', 'function_description', 'email', 'education', 'duration', 'hours'];
    protected $dates = ['deleted_at'];

    /**
     * Query scope for vacancies in primary region
     *
     * @param $query
     * @param Region $region
     * @return mixed
     */
    public function scopeInPrimaryRegion($query, Region $region)
    {
        if($region->exists) {
            return $query->whereHas('company.region', function ($q) use ($region) {
                $q->where('region.id', '=', $region->id);
            });
        }

        return $query;
    }

    /**
     * Query scope for vacancies in secondary region
     *
     * @param $query
     * @param Region $region
     * @return mixed
     */
    public function scopeInSecondaryRegion($query, Region $region)
    {
        if($region->exists) {
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
     * Query scope for recently created vacancies
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
     * Query scope for vacancies in category
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
     * Query scope for vacancies in company
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
     * Company relation for vacancy
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo('Villato\Company');
    }

}
