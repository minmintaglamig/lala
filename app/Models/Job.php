<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Job extends Model
{
    protected $table = 'delivery_jobs';

    protected $fillable = [
        'id',
        'driver_id',
        'vehicle_id',
        'client_id',
        'vehicle_type',
        'pickup_address',
        'dropoff_address',
        'package_description',
        'scheduled_time',
        'delivery_status',
        'client_name',
        'client_contact',
        'distance',
        'price',
            'pickup_latitude',
    'pickup_longitude',
    'dropoff_latitude',
    'dropoff_longitude',
    ];

public function driver()
{
    return $this->belongsTo(User::class, 'driver_id');
}

}


