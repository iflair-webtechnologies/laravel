<?php

namespace Villato;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cms extends Model
{
    protected $table = 'cmses';
    public $timestamps = true;
    protected $fillable = ['title', 'content'];
    protected $dates = ['deleted_at'];   
}
