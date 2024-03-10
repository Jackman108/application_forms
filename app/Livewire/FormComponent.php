<?php

namespace App\Livewire;

use App\Models\AdditionalPhone;
use App\Models\ProfileFile;
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
    public ?string $country_code = '';
    public ?string $phone = null;
    public ?string $marital_status = null;
    public ?string $about = null;
    public array $files = [];
    public array $additional_phones = [['phone' => '']];
    public bool $agreed_to_terms = false;
    public bool $success = false;

    protected array $rules = [];

    protected function rules(): array
    {
        $rules = ProfileValidator::getValidationRules();
        $rules['phone'] .= '|digits_between:9,10';
        $rules['phone'] .= '|required_without:email';
        $rules['email'] .= '|required_without:phone';
        $rules['country_code'] .= '|required_with:phone';
        return $rules;
    }


    public function submitForm(): void
    {
        $validatedData = $this->validate();
        $this->handleRequiredContactField();

        $profile = new Profile($validatedData);
        $profile->save();
        $this->storeFiles($profile);
        $this->storeAdditionalPhones($profile);

        $this->sessionFormState();
        $this->reset();
        session()->flash('message', 'Успешно.');

        $this->success = true;
    }

    private function handleRequiredContactField(): void
    {
        if (empty($this->email) && empty($this->phone)) {
            $this->addError('email', 'Введите почту или телефон');
            $this->addError('phone', 'Введите почту или телефон');
        }
    }

    private function sessionFormState(): void
    {
        session([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
        ]);
    }

    private function storeFiles(Profile $profile): void
    {
        foreach ($this->files as $file) {
            $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/files', $filename);
            $profileFile = new ProfileFile([
                'path' => $path,
                'profile_id' => $profile->getAttribute('id')
            ]);
            $profileFile->save();
        }
    }

    private function storeAdditionalPhones(Profile $profile): void
    {
        foreach ($this->additional_phones as $additionalPhone) {
            if (!empty($additionalPhone['phone'])) {
                $additionalPhoneModel = new AdditionalPhone([
                    'phone' => $additionalPhone['phone'],
                    'profile_id' => $profile->getAttribute('id')
                ]);
                $additionalPhoneModel->save();

            }
        }
    }

    public function addAdditionalPhone(): void
    {
        if (count($this->additional_phones) < 5) {
            $this->additional_phones[] = ['phone' => ''];
        }
    }

    public function allFieldsFilled(): bool
    {
        return $this->first_name
            && $this->last_name
            && $this->birthdate
            && ($this->email || $this->phone)
            && $this->agreed_to_terms;
    }

    public function render(): Factory|View
    {
        return $this->success ?
            view('livewire.form-success') :
            view('livewire.form-component');
    }
}
