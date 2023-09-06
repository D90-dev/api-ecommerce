<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InstallerStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'firstName' => ['required', 'string'],
            'lastName' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('installers', 'email')],
            'telephoneNumber' => ['required', 'string'],
            'houseNameOrNumber' => ['required', 'string'],
            'streetName' => ['required', 'string'],
            'addressLine2' => ['string', 'nullable'],
            'addressLine3' => ['string', 'nullable'],
            'postcode' => ['required', 'string'],
            'workInPostcodes' => ['required', 'string'],
            'bankAccountNumber' => ['required', 'string'],
            'bankSortCode' => ['required', 'string'],
            'companyRegistrationNumber' => ['required', 'string'],
            'gasSafeLicenseNumber' => ['required', 'string'],
            'registeredForVat' => ['bool'],
            'companyVatNumber' => ['required_if:registeredForVat,1', 'string', 'nullable'],
            'gasSafeCardFrontPicture.*' => ['mimes:jpg,png,pdf', 'max:10000'],
            'gasSafeCardBackPicture.*' => ['mimes:jpg,png,pdf', 'max:10000'],
            'gasSafeExpiryDate' => ['required', 'date'],
            'photoId.*' => ['mimes:jpg,png,pdf', 'max:10000'],
            'selfieHeadshot.*' => ['mimes:jpg,png,pdf', 'max:10000'],
            'publicLiabilityInsurance.*' => ['mimes:jpg,png,pdf', 'max:10000'],
            'publicLiabilityExpiryDate' => ['required', 'date'],
            'latestAcsCertificate.*' => ['mimes:jpg,png,pdf', 'max:10000'],
            'analyserCalibrationCertification.*' => ['mimes:jpg,png,pdf', 'max:10000'],
            'analyserCalibrationCertificationExpiryDate' => ['required', 'date'],
            'dbsCheck.*' => ['file', 'mimes:jpg,png,pdf','max:10000'],
            'dbsCheckExpiryDate' => ['required', 'date'],
            'registeredForVatSubject' => ['required'],
        ];
    }
}
