<?php

namespace Villato;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Advertisement extends Model implements SluggableInterface
{

    use Eloquence, SluggableTrait;

    public $timestamps = true;
    protected $table = 'advertisement';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'content',
        'company_id'       
    ];
    protected $sluggable = [
        'build_from' => 'name',
        'save_to' => 'slug',
    ];
    protected $searchableColumns = ['name'];
    protected $appends = ['image'];

    /**
     * Category relation for advertisement
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function categoryadvt()
    {
        return $this->belongsTo('Villato\Categoryadvt');
    }
    
    /**
     * Get Advertisement Image url attribute
     *
     * @return Route
     */
    public function getImageAttribute()
    {
        if(!$this->images->isEmpty()) {
            return route('imagecache', ['large', $this->images->first()->path]);
        }

        return '';
    }
    /**
     * Images Relation for Advertisement
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {
        return $this->morphMany('Villato\Image', 'imageable');
    } 
     public function image()
    {
        return $this->hasOne('Villato\Image');
    }
    public function company()
    {
        return $this->hasOne('Villato\Company');
    }    
    public function updateimg($id,$imgtype){
        DB::table('image')
            ->where('imageable_id', $id)
            ->where('imageable_type', $imgtype)
            ->update(['path' => '']);
            return true;
    }
}
