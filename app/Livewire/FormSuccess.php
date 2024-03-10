<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class FormSuccess extends Component
{
    public string $first_name;
    public string $last_name;

    public function mount(): void
    {
        $this->first_name = session('first_name');
        $this->last_name = session('last_name');
    }

    public function render(): Factory|View
    {
        return view('livewire.form-success', [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
        ]);
    }
}
