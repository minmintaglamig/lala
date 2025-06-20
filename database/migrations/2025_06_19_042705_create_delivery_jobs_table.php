<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('delivery_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained('driver_profiles')->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
            $table->string('pickup_address');
            $table->string('dropoff_address');
            $table->text('package_description');
            $table->timestamp('scheduled_time');
            $table->enum('delivery_status', ['pending', 'in_progress', 'delivered', 'cancelled'])->default('pending');
            $table->string('client_name');
            $table->string('client_contact');
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_jobs');
    }
};
