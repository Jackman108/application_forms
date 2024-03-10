<?php

namespace Tests\Unit;

use App\Livewire\FormComponent;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class FormComponentTest extends TestCase
{
    use DatabaseTransactions;

    public function test_submit_form(): void
    {
        Storage::fake('public');

        Livewire::test(FormComponent::class)
            ->set('first_name', 'John')
            ->set('last_name', 'Doe')
            ->set('birthdate', '1990-01-01')
            ->set('country_code', '+375')
            ->set('phone', '123456789')
            ->set('agreed_to_terms', 1)
            ->set('files', [
                UploadedFile::fake()->create('document.pdf')
            ])
            ->call('submitForm')
            ->assertSet('success', 1);

        $this->assertDatabaseHas('profiles', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'birthdate' => '1990-01-01',
            'country_code' => '+375',
            'phone' => '123456789',
        ]);
    }
}
