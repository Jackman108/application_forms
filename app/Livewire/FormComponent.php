<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\Profile;
use Livewire\WithFileUploads;

class FormComponent extends Component
{
    use WithFileUploads;

    #[Validate('required')]
    public string $first_name = '';
    #[Validate('required')]
    public string $last_name = '';
    #[Validate('required')]
    public ?string $middle_name = null;
    #[Validate('required')]
    public string $birthdate = '';
    #[Validate('required')]
    public ?string $email = null;
    #[Validate('required')]
    public ?string $phone = null;
    #[Validate('required')]
    public ?string $country_code = null;
    #[Validate('required')]
    public ?string $marital_status = null;
    #[Validate('required')]
    public ?string $about = null;
    public array $files = [];

    protected function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'birthdate' => 'required|date',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'country_code' => 'nullable|string',
            'marital_status' => 'nullable|string',
            'about' => 'nullable|string|max:1000',
            'files.*' => 'nullable|file|max:5120|mimes:jpg,png,pdf',
        ];
    }

    public function submitForm(): void
    {
        $this->validate($this->rules());

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
        ]);

        $profile->save();

        if (!empty($this->files)) {
            $profile->saveFiles($this->files);
        }

        session()->flash('success', 'Анкета успешно отправлена');

        $this->reset(['first_name', 'last_name', 'middle_name', 'birthdate', 'email', 'phone', 'country_code', 'marital_status', 'about', 'files']);
    }

    public function render(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.form-component');
    }
}
