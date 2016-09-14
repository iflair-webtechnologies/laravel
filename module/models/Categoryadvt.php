<?php

namespace Villato;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoryadvt extends Model 
{
    use SoftDeletes;

    public $timestamps = true;
    protected $table = 'categoryadvt';
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];
    /**
     * Products relation for category
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function advertisement()
    {
        return $this->hasMany('Villato\Advertisement')->orderBy('created_at', 'desc');
    }
     public function images()
    {
        //return $this->morphMany('Villato\Advertisement', 'imageable');
        return $this->hasOne('Villato\Image');
    }

}