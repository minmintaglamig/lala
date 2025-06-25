<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('delivery_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('client_id')->nullable();
            $table->foreignId('driver_id')->nullable()->constrained('driver_profiles')->onDelete('set null');
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles')->onDelete('set null');
            $table->string('vehicle_type')->nullable();
            $table->string('pickup_address');
            $table->string('dropoff_address');
            $table->text('package_description');
            $table->dateTime('scheduled_time');
            $table->enum('delivery_status', ['pending', 'in_progress', 'delivered', 'cancelled'])->default('pending');
            $table->string('client_name');
            $table->string('client_contact');
            $table->float('distance')->nullable();
            $table->float('price')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_jobs');
    }
};
