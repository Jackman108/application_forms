<?php

namespace App\Validators;

class ProfileValidator
{
    public static function getValidationRules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'birthdate' => 'required|date',
            'email' => 'nullable|email',
            'phone' => 'nullable|digits_between:9,10',
            'country_code' => 'nullable|string',
            'marital_status' => 'nullable|string',
            'about' => 'nullable|string|max:1000',
            'files.*' => 'nullable|file|max:5120|mimes:jpg,png,pdf',
            'additional_phones.*.phone' => 'nullable|digits_between:9,10',
            'agreed_to_terms' => 'required|accepted',
        ];
    }
}
