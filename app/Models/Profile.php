<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
/**
 * @method static \Illuminate\Database\Eloquent\Builder|Profile where(string $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @method static Profile create(array $attributes = [])
 */
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
        'agreed_to_terms',
    ];

    public function additionalPhones(): HasMany
    {
        return $this->hasMany(AdditionalPhone::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(ProfileFile::class);
    }
}
