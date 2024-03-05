<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\FormComponent;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/form-component',
    FormComponent::class);

Route::post('/submit-form',
    [FormComponent::class, 'submitForm'])->name('submit.form');
