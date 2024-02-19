<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserAddressRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'label' => 'required|string|max:255|unique:user_addresses,label,' . $this->route('user_address')?->id . ',id,user_id,' . auth()->id(),
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'details' => 'nullable|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'is_primary' => 'required|boolean',
        ];
    }
}
