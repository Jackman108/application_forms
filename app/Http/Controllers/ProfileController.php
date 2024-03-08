<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Validators\ProfileValidator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), ProfileValidator::getValidationRules());

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $profile = new Profile();
        $profile->fill($request->all());
        $profile->save();

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('public/files');
                $profile->files()->create(['path' => $path]);
            }
        }

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
