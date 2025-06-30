<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationUpdate extends Model
{
    protected $fillable = ['delivery_job_id', 'latitude', 'longitude', 'timestamp'];

    public function driver()
    {
        return $this->belongsTo(DriverProfile::class, 'driver_id');
    }

    public function deliveryJob()
    {
        return $this->belongsTo(DeliveryJob::class);
    }
}
