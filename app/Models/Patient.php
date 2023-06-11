<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gender',
        'blood_type',
        'medical_records',
        'allergies',
    ];

    /**
     * Cast Gender attribute when called and set
     *
     * @return Attribute
     */
    protected function gender(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Str::title($value),
        );
    }

    /**
     * Cast Allergies attribute when called and set
     *
     * @return Attribute
     */
    protected function allergies(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Str::title($value),
        );
    }

    /**
     * Cast Medical Records attribute when called and set
     *
     * @return Attribute
     */
    protected function medicalRecords(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Str::title($value),
        );
    }

    /**
     * Relation to User model
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
