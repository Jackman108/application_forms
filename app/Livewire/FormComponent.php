<?php

namespace App\Livewire;

use App\Validators\ProfileValidator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Profile;
use Livewire\WithFileUploads;

class FormComponent extends Component
{
    use WithFileUploads;

    public string $first_name = '';
    public string $last_name = '';
    public ?string $middle_name = null;
    public string $birthdate = '';
    public ?string $email = null;
    public ?string $country_code = null;
    public ?string $phone = null;
    public ?string $marital_status = null;
    public ?string $about = null;
    public array $files = [];
    public array $additional_phones = [['phone' => '']];
    public bool $agreed_to_terms = false;

    protected array $rules = [];

    public function mount(): void
    {
        $this->rules = ProfileValidator::getValidationRules();
        $this->rules['phone'] .= '|required_without:email';
        $this->rules['email'] .= '|required_without:phone';
    }

    public function submitForm(): void
    {

        $this->validate(ProfileValidator::getValidationRules());

        if (empty($this->email) && empty($this->phone)) {
            $this->addError('email', 'Введите почту или телефон');
            $this->addError('phone', 'Введите почту или телефон');
            return;
        }

        $profile = new Profile([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'birthdate' => $this->birthdate,
            'email' => $this->email,
            'country_code' => $this->country_code,
            'phone' => $this->phone,
            'marital_status' => $this->marital_status,
            'about' => $this->about,
            'agreed_to_terms' => $this->agreed_to_terms,
        ]);
        $profile->save();

        if (!empty($this->files)) {
            foreach ($this->files as $file) {
                $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('public/files', $filename);
                $profile->files()->create(['path' => $path]);
            }
        }

        foreach ($this->additional_phones as $additionalPhone) {
            if (!empty($additionalPhone['phone'])) {
                $profile->additionalPhones()->create(['phone' => $additionalPhone['phone']]);
            }
        }

        $this->reset();
        session()->flash('message', 'Профиль успешно создан.');
    }

    public function addAdditionalPhone(): void
    {
        if (count($this->additional_phones) < 5) {
            $this->additional_phones[] = ['phone' => ''];
        }
    }

    public function render(): Factory|View
    {
        return view('livewire.form-component');
    }
}
