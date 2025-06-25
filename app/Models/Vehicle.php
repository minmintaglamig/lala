<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'id', 'driver_id', 'plate_number', 'type', 'model', 'capacity', 'status'
    ];
}