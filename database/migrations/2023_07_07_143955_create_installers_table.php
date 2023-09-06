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
        Schema::create('installers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('telephone_number')->nullable();
            $table->string('house_name_or_number')->nullable();
            $table->string('street_name')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('address_line_3')->nullable();
            $table->string('post_code')->nullable();
            $table->string('work_in_postcodes')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_sort_code')->nullable();
            $table->string('company_registration_number')->nullable();
            $table->string('gas_safe_license_number')->nullable();
            $table->tinyInteger('registered_for_vat')->default(0);
            $table->string('company_vat_number')->nullable();
            $table->timestamp('gas_safe_expiry_date')->nullable();
            $table->timestamp('public_liability_expiry_date')->nullable();
            $table->timestamp('analyser_calibration_certification_expiry_date')->nullable();
            $table->timestamp('dbs_check_expiry_date')->nullable();
            $table->json('registered_for_vat_subject')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installers');
    }
};
