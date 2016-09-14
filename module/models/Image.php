<?php

namespace Villato;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $table = 'image';
    public $timestamps = true;

    public function imageable()
    {
        return $this->morphTo();
    }

    public function getLargeImageUrlAttribute()
    {
        return route('image', ['large', $this->path]);
    }

    public function getMediumImageUrlAttribute()
    {
        return route('image', ['medium', $this->path]);
    }

    public function getSmallImageUrlAttribute()
    {
        return route('image', ['small', $this->path]);
    }

}
