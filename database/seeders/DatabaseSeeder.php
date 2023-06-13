<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Patient;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Doctor;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@test.com',
            'role' => 'admin'
        ]);

        $doctor = User::factory()->create([
            'name' => 'Test Doctor',
            'email' => 'doctor@test.com',
            'role' => 'doctor'
        ])->doctor()->update(Doctor::factory()->make()->toArray());

        User::factory()->create([
            'name' => 'Test Patient',
            'email' => 'patient@test.com',
            'role' => 'patient'
        ]);

        User::factory(10000)->create()->each(function ($user) {
            if ($user->role == 'doctor') {
                $user->doctor()->update(Doctor::factory()->make()->toArray());
            }

            if ($user->role == 'patient') {
                $user->patient()->update(Patient::factory()->make()->toArray());
            }
        });
    }
}
