<?php

namespace Database\Seeders;

use App\Enums\Auth\Role;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmployeesForSameCompany extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::factory()
            ->has(User::factory(30))
            ->has(User::factory(1)->state(['role' => Role::Admin]))
            ->create();
    }
}
