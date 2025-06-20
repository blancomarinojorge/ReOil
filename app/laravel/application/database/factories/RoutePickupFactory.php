<?php

namespace Database\Factories;

use App\Enums\PickupState;
use App\Models\Client;
use App\Models\Route;
use App\Models\RoutePickup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoutePickup>
 */
class RoutePickupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'state' => $this->faker->randomElement(PickupState::cases()),
            'delivery_note_notes' => $this->faker->sentence(),
            'observations' => $this->faker->sentence(),
            'order' =>  $this->faker->randomNumber(),
            'client_id' => Client::factory(),
            'route_id' => Route::factory(),
        ];
    }
}
