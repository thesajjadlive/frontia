<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
    protected $fillable=[
        'category_id',
        'title',
        'slug',
        'type',
        'details',
        'image',
    ];

    public function getRouteKeyName(){
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
