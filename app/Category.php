<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable=[
        'name',
        'slug',
        'icon',
        'image',
    ];

    public function getRouteKeyName(){
        return 'slug';
    }

    /*public function service()
    {
        return $this->hasMany(Service::class);
    }*/
}
