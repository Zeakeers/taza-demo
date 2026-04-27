<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User Dev
        \App\Models\User::create([
            'name' => 'Dev Admin',
            'email' => 'dev@tamanzakat.org',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'dev',
        ]);

        // User Content Manager
        \App\Models\User::create([
            'name' => 'Content Manager',
            'email' => 'content@tamanzakat.org',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'content_manager',
        ]);

        // User Reviewer
        \App\Models\User::create([
            'name' => 'Reviewer Form',
            'email' => 'reviewer@tamanzakat.org',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'reviewer',
        ]);
    }
}
