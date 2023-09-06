<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'amount' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'payment_method_id' => ['required', 'string'],

            'boilerId' => ['required', 'integer'],
            'installation_date' => ['required', 'date'],
            'installation_address.email' => ['required', 'email'],
            'installation_address.first_name' => ['required', 'string'],
            'installation_address.last_name' => ['required', 'string'],
            'installation_address.address1' => ['required', 'string'],
            'installation_address.address2' => ['required', 'string'],
            'installation_address.city' => ['required', 'string'],
            'installation_address.state' => ['required', 'string'],
            'installation_address.zip_code' => ['required', 'string'],
            'installation_address.phone' => ['required', 'string'],
            'products' => ['array'],
            'products.*.id' => ['numeric'],
            'products.*.count' => ['numeric'],
        ];
    }
}
