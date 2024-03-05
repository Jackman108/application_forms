<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfileFile extends Model
{
    use HasFactory;

    protected $fillable = ['profile_id', 'path'];

    // Отношение к модели Profile
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }
}
