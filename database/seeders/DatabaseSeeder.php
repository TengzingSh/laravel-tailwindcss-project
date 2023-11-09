<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'firstName' => $_ENV['ADMIN_FIRSTNAME'] != "" ? $_ENV['ADMIN_FIRSTNAME'] : "",
            'lastName' => $_ENV['ADMIN_LASTNAME'] != "" ? $_ENV['ADMIN_LASTNAME'] : "",
            'email' => $_ENV['ADMIN_EMAIL'] != "" ? $_ENV['ADMIN_EMAIL'] : 'admin@admin.com',
            'password' => Hash::make($_ENV['ADMIN_PASSWORD'] != "" ? $_ENV['ADMIN_PASSWORD'] : 'admin123'),
            'type' => true
        ]);
    }
}
