<?php

namespace Database\Seeders;

use App\Enums\Auth\Role;
use App\Models\Client;
use App\Models\Company;
use App\Models\Truck;
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
        Company::factory(20)->create()->each(function (Company $company) {
            User::factory(3)->create(['company_id' => $company->id, 'role' => Role::Admin]);
            User::factory(30)->create(['company_id' => $company->id]);
            Truck::factory(30)->create(['company_id' => $company->id]);
            Client::factory(200)->create(['company_id' => $company->id]);
        });
    }
}
