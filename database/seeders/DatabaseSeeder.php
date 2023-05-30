<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'name' => 'Amirul',
            'email' => 'amirulfcso@gmail.com',
            'role' => 'admin'
        ]);

        User::factory(100)->create()->each(function ($user) {
            if ($user->role == 'doctor') {
                $user->doctor()->update(Doctor::factory()->make()->toArray());
            }
        });

    }
}
