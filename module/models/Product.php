<?php

namespace Villato;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Product extends Model implements SluggableInterface
{

    use Eloquence, SluggableTrait;

    public $timestamps = true;
    protected $table = 'product';
    protected $guarded = [''];
    protected $searchableColumns = ['name'];
    protected $sluggable = [
        'build_from' => 'name',
        'save_to' => 'slug',
    ];

    /**
     * Category relation for product
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    // public function category()
    // {
    //     return $this->belongsTo('Villato\Category');
    // }
     public function category()
    {
        //return $this->belongsTo('Villato\Category');
        
        return $this->belongsToMany('Villato\Category', 'product_category_relation', 'product_id', 'category_id');
    }
    /**
     * Company relation for product
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function companies()
    {
        return $this->belongsToMany('Villato\Company', 'company_region_product', 'product_id', 'company_id');
    }

    /**
     * Region relation for product
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function regions()
    {
        return $this->belongsToMany('Villato\Region', 'company_region_product', 'product_id', 'region_id');
    }

}
