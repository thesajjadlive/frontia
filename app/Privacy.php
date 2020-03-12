<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Privacy extends Model
{
    use SoftDeletes;
    protected $fillable=[
        'faq',
        'privacy',
        'terms',
        'cookie',
    ];
}
