<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('location_updates', function (Blueprint $table) {
            $table->id();

            $table->foreignId('delivery_job_id')
                ->constrained('delivery_jobs')
                ->onDelete('cascade');

            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->timestamp('timestamp')->useCurrent();

            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('location_updates');
    }
};
