<?php

use App\Models\Radiator;
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
        Schema::create('radiator_models', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Radiator::class)->constrained()->cascadeOnDelete();
            $table->string('type');
            $table->float('height');
            $table->float('length');
            $table->float('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('radiator_models');
    }
};
