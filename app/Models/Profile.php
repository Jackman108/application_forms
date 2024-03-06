<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'birthdate',
        'email',
        'phone',
        'country_code',
        'marital_status',
        'about',
    ];



    // Метод для сохранения файлов
    public function saveFiles(array $files): void
    {
        foreach ($files as $file) {
            $path = $file->store('files');
            // Сохраняем путь к файлу в базе данных
            $this->files()->create(['path' => $path]);
        }
    }

    public function additionalPhones(): HasMany
    {
        return $this->hasMany(AdditionalPhone::class);
    }

    // Отношение "один-ко-многим" с моделью File
    public function files(): HasMany
    {
        return $this->hasMany(ProfileFile::class);
    }
}
