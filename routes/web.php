<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\FormComponent;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/form',
    FormComponent::class);

Route::post('/submit-form',
    [FormComponent::class, 'submitForm'])->name('submit.form');

Route::post('/submit-form', [ProfileController::class, 'store'])->name('submit.form');
