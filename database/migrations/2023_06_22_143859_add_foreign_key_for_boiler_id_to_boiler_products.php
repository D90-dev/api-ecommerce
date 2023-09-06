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
        Schema::table('boiler_products', function (Blueprint $table) {
            $table->BigInteger('boiler_id')->unsigned()->change();
            $table->foreign('boiler_id')
                ->on('boilers')
                ->references('id')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('boiler_products', function (Blueprint $table) {
            //
        });
    }
};
