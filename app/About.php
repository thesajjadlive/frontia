<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class About extends Model
{
    use SoftDeletes;
    protected $fillable=[
        'about',
        'quote',
        'image',
        'video',
        'project',
        'customer',
        'review',
        'follower',
    ];
}
