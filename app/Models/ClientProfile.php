<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientProfile extends Model
{
    protected $fillable = [
        'user_id',
        'address',
    ];

    public function jobs()
    {
        return $this->hasMany(DeliveryJob::class, 'client_id');
    }

}