<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'birthdate' => 'required|date',
            'email' => 'nullable|email|required_without:phone',
            'phone' => 'nullable|string|required_without:email',
            'country_code' => 'nullable|string',
            'marital_status' => 'nullable|string',
            'about' => 'nullable|string|max:1000',
            'files.*' => 'nullable|file|max:5120|mimes:jpg,png,pdf',
            'additional_phones.*.phone' => 'nullable|string',
        ]);

        $profile = Profile::create($validatedData);

        // Обработка и сохранение файлов, если они есть
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('public/files');
                $profile->files()->create(['path' => $path]);
            }
        }

        // Обработка и сохранение дополнительных телефонных номеров, если они есть
        if ($additionalPhones = $request->input('additional_phones')) {
            foreach ($additionalPhones as $phone) {
                if (!empty($phone)) {
                    $profile->additionalPhones()->create(['phone' => $phone]);
                }
            }
        }

        return redirect()->back()->with('success', 'Анкета успешно отправлена');
    }
}
