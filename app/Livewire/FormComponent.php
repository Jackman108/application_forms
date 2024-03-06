<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\Profile;
use Livewire\WithFileUploads;

class FormComponent extends Component
{
    use WithFileUploads;

    #[Validate('required')]
    public string $first_name;
    #[Validate('required')]
    public string $last_name;
    #[Validate('required')]
    public ?string $middle_name;
    #[Validate('required')]
    public string $birthdate;
    #[Validate('required')]
    public ?string $email;
    public ?string $country_code;
    #[Validate('required')]
    public ?string $phone;
    #[Validate('required')]
    public ?string $marital_status;
    #[Validate('required')]
    public ?string $about;
    public array $files = [];
    public int $additional_phones_count = 0;
    public array $additional_phones = [['phone' => '']];



    /**
     * @throws ValidationException
     */

    public function submitForm(): void
    {
         $profile = new Profile([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'birthdate' => $this->birthdate,
            'email' => $this->email,
            'phone' => $this->phone,
            'country_code' => $this->country_code,
            'marital_status' => $this->marital_status,
            'about' => $this->about,
            'files.*' => $this->files,
            'additional_phones.*.phone' => $this->additional_phones,
        ]);

        $profile->save();

        foreach ($this->files as $file) {
            $path = $file->store('public/files');
            $profile->files()->create(['path' => $path]);
        }

        foreach ($this->additional_phones as $additionalPhone) {
            if (!empty($additionalPhone['phone'])) {
                $profile->addAdditionalPhone()->create(['phone' => $additionalPhone['phone']]);
            }
        }

        session()->flash('success', 'Анкета успешно отправлена');

        $this->reset();
    }

    public function render(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.form-component');
    }
}
