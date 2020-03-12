<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meta extends Model
{
    use SoftDeletes;
    protected $fillable=[
        'title',
        'keyword',
        'description',
    ];
}
