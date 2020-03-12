<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Demand extends Model
{
    use SoftDeletes;
    protected $fillable=[
        'service_id',
        'name',
        'email',
        'phone',
        'subject',
        'details',
        'status',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
