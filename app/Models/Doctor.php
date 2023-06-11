<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialization',
        'qualification',
        'experience',
        'status',
    ];

    /**
     * Ensure the status returns a boolean value
     *
     * @return Attribute
     */
//    protected function status(): Attribute
//    {
//        return Attribute::make(
//            get: fn($value) => $value == 'active',
//            set: fn($value) => 'active' ?? 'inactive'
//        );
//    }

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
