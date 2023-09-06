<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Installer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'telephone_number',
        'house_name_or_number',
        'street_name',
        'address_line_2',
        'address_line_3',
        'post_code',
        'work_in_postcodes',
        'bank_account_number',
        'bank_sort_code',
        'company_registration_number',
        'gas_safe_license_number',
        'registered_for_vat',
        'company_vat_number',
        'gas_safe_card_front_picture',
        'gas_safe_card_back_picture',
        'gas_safe_expiry_date',
        'photo_id',
        'selfie_headshot',
        'public_liability_insurance',
        'public_liability_expiry_date',
        'latest_acs_certificate',
        'analyser_calibration_certification',
        'analyser_calibration_certification_expiry_date',
        'dbs_check',
        'dbs_check_expiry_date',
        'registered_for_vat_subject',
    ];

    /**
     * @return MorphMany
     */
    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
