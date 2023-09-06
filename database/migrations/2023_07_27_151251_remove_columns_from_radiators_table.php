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
        Schema::table('radiators', function (Blueprint $table) {
            $table->dropColumn(['length', 'height', 'type', 'price', 'warranty', 'lockshield_included']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('radiators', function (Blueprint $table) {
            $table->float('length')->nullable();
            $table->float('height')->nullable();
            $table->string('type')->nullable();
            $table->integer('price')->nullable();
            $table->float('warranty')->nullable();
            $table->boolean('lockshield_included');
        });
    }
};
