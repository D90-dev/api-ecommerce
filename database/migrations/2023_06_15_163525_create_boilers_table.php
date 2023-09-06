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
        Schema::create('boilers', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->float('price')->nullable();
            $table->text('additional_info')->nullable()->comment('Specification. Admin should be able to add it manualy via editor');
            $table->float('old_price')->nullable();
            $table->integer('radiators_count')->nullable();
            $table->float('hot_water_flow_rate')->nullable();
            $table->float('heating_output')->nullable();
            $table->float('warranty')->nullable();
            $table->float('efficiency')->nullable();
            $table->float('height')->nullable();
            $table->float('width')->nullable();
            $table->float('depth')->nullable();
            $table->boolean('hydrogen_blend')->nullable();
            $table->boolean('best_seller')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boilers');
    }
};
