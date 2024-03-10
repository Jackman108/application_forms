<?php

namespace Tests\Unit;

use App\Validators\ProfileValidator;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class ProfileValidatorTest extends TestCase
{
    public function test_validation_rules(): void
    {
        $validator = Validator::make([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'birthdate' => '1990-01-01',
            'country_code' => '+375',
            'phone' => '123456789',
            'agreed_to_terms' => true
        ], ProfileValidator::getValidationRules());

        $this->assertFalse($validator->fails());
    }

    public function test_validation_rules_with_empty_data(): void
    {
        $validator = Validator::make([], ProfileValidator::getValidationRules());

        $this->assertTrue($validator->fails());
    }
}
