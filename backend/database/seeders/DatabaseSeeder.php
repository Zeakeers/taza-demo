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
        \App\Models\User::updateOrCreate(
            ['email' => 'dev@tamanzakat.org'],
            [
                'name' => 'Dev Admin',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'dev',
            ]
        );

        // User Markom
        \App\Models\User::updateOrCreate(
            ['email' => 'markom@tamanzakat.org'],
            [
                'name' => 'Markom Admin',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'markom',
            ]
        );

        // User Program
        \App\Models\User::updateOrCreate(
            ['email' => 'program@tamanzakat.org'],
            [
                'name' => 'Program Admin',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'program',
            ]
        );

        $this->call([
            ProvinceSeeder::class,
        ]);
    }
}
