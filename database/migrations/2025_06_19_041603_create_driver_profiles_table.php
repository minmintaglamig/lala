<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('driver_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('driver_id')->nullable();
            $table->string('name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('emergency_contact')->nullable();


            // License
            $table->string('license_number')->nullable();
            $table->date('license_expiry')->nullable();
            $table->string('license_type')->nullable();
            $table->string('additional_permits')->nullable();
            $table->string('license_image')->nullable();

            // Work
            $table->string('driver_status')->nullable();
            $table->date('hire_date')->nullable();
            $table->string('vehicle_assigned')->nullable();
            $table->string('route_assigned')->nullable();

            // Health
            $table->string('medical_cert_file')->nullable();
            $table->string('drug_test_file')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('driver_profiles');
    }
};
// This migration creates the driver_profiles table with various fields for personal, license, work, and health information.