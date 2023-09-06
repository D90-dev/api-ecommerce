<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('boiler_services', function (Blueprint $table) {
            $table->id();
            $table->integer('boiler_id')->nullable();
            $table->integer('service_id')->nullable();
            $table->boolean('is_free')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boiler_services');
    }
};
