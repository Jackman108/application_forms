<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\FormComponent;


Route::get('/home', function () {
    return view('welcome');
});

Route::get('/', FormComponent::class)->name('form');

Route::post('/submit-form', [ProfileController::class, 'store'])->name('submit.form');
