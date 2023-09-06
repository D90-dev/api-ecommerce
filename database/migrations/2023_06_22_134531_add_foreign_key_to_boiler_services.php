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
        Schema::table('boiler_services', function (Blueprint $table) {
            $table->BigInteger('service_id')->unsigned()->change();
            $table->foreign('service_id')
                ->on('services')
                ->references('id')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('boiler_services', function (Blueprint $table) {
            //
        });
    }
};
