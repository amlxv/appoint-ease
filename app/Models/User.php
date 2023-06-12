<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Manage users respective to their role
     *
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        /**
         * Create if not exist.
         *
         * @param User $user
         * @return void
         */
        static::created(function (User $user): void {
            if ($user->isDoctor()) {
                $user->doctor()->create();
            } else if ($user->isPatient()) {
                $user->patient()->create();
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'address',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var string[] $attributes
     */
    protected $attributes = [
        'role' => 'patient',
    ];

    /**
     * Check the users role
     *
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Check if the users is a admin
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * Check if the users is a doctor
     *
     * @return bool
     */
    public function isDoctor(): bool
    {
        return $this->hasRole('doctor');
    }

    /**
     * Check if the users is a patient
     *
     * @return bool
     */
    public function isPatient(): bool
    {
        return $this->hasRole('patient');
    }

    /**
     * Relationship for patient
     */
    public function patient(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Patient::class);
    }

    /**
     * Relationship for doctor
     */
    public function doctor(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Doctor::class);
    }

    /**
     * Check the users required data
     */
    public function hasRequiredData(): bool
    {
        return ($this->name && $this->email && $this->phone_number && $this->address);
    }
}
