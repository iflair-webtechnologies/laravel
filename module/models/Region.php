<?php

namespace Villato;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Villato\Traits\ActiveTrait;

class Region extends Model implements SluggableInterface
{

    use SluggableTrait, ActiveTrait;

    protected $table = 'region';
    public $timestamps = true;
    protected $guarded = [''];
    protected $sluggable = [
        'build_from' => 'name',
        'save_to' => 'slug',
    ];

    public function scopeNearbyRegions($query, $region)
    {
        if ($region->exists) {
            return $query->selectRaw('
                *, ( 6371 * acos( cos( radians(?) ) *
                    cos( radians( latitude ) )
                    * cos( radians( longitude ) - radians(?)
                    ) + sin( radians(?) ) *
                    sin( radians( latitude ) ) )
                ) AS distance', [$region->latitude, $region->longitude, $region->latitude])->where('id', '!=',
                $region->id)->orderBy('distance');
        }

        return $query;
    }

    /**
     * Company relation for region
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function companies()
    {
        
        return $this->hasMany('Villato\Company');
    }


    /**
     * Product relation for region
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function products()
    {
        return $this->belongsToMany('Villato\Product', 'company_region_product', 'region_id', 'product_id')
            ->distinct();
    }
    
}