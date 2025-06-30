<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryJob extends Model
{
    protected $fillable = ['client_id', 'driver_id', 'pickup_address', 'dropoff_address', 'status', 'pickup_time', 'delivery_time', 'notes'];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function locationUpdates()
    {
        return $this->hasMany(LocationUpdate::class);
    }
}
