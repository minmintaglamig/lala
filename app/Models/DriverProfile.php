<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverProfile extends Model
{
    protected $fillable = [
        'user_id',
        'driver_id',
        'last_name',
        'first_name',
        'middle_name',
        'suffix',
        'contact_number',
        'email',
        'address',
        'date_of_birth',
        'gender',
        'emergency_contact',
        'license_number',
        'license_expiry',
        'license_type',
        'additional_permits',
        'license_image',
        'driver_status',
        'hire_date',
        'vehicle_assigned',
        'route_assigned',
        'medical_cert_file',
        'drug_test_file'
        
    ];
}