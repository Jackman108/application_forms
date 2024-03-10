<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_creates_profile_successfully()
    {
        Storage::fake('public');

        $payload = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'middle_name' => $this->faker->lastName,
            'birthdate' => $this->faker->date,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'country_code' => '+7',
            'marital_status' => 'single',
            'about' => $this->faker->paragraph,
            'agreed_to_terms' => '1',
            'files' => [UploadedFile::fake()->create('document.pdf', 5120)],
            'additional_phones' => [
                ['phone' => $this->faker->phoneNumber],
                ['phone' => $this->faker->phoneNumber],
            ],
        ];

        $response = $this->post(route('profile.store'), $payload);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Анкета успешно отправлена');

        $this->assertDatabaseHas('profiles', [
            'email' => $payload['email'],
        ]);
    }

    /** @test */
    public function it_fails_to_create_profile_due_to_validation_errors()
    {
        $payload = [
        ];

        $response = $this->post(route('profile.store'), $payload);

        $response->assertSessionHasErrors(['first_name', 'last_name', 'birthdate', 'agreed_to_terms']);
    }
}
