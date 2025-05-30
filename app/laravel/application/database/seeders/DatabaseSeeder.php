<?php

namespace Database\Seeders;

use App\Enums\Auth\Role;
use App\Models\User;
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
        User::factory(20)->create([
            'role' => Role::Admin,
            'password' => Hash::make('abc123.')
        ]);
    }
}
