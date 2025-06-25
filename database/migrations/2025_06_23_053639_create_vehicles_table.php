<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('driver_id')->unique();
            $table->string('plate_number')->unique();
            $table->string('type');
            $table->string('model');
            $table->integer('capacity');
            $table->enum('status', ['available', 'maintenance', 'unavailable'])->default('available');
            $table->timestamps();

            $table->foreign('driver_id')
          ->references('user_id')
          ->on('driver_profiles')
          ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
