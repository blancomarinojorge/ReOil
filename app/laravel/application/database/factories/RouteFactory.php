<?php

namespace Database\Factories;

use App\Enums\Auth\Role;
use App\Enums\RouteState;
use App\Models\Truck;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Route>
 */
class RouteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'state' => $this->faker->randomElement(RouteState::cases()),
            'start_date' => $this->faker->dateTimeThisYear(),
            'description' => $this->faker->sentence(),
            'driver_id' => User::factory(['role' => Role::Driver]),
            'creator_id' => User::factory(['role' => Role::OfficeStaff]),
            'truck_id' => Truck::factory(),
        ];
    }
}
