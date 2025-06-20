<?php

namespace Database\Factories;

use App\Models\Container;
use App\Models\Residue;
use App\Models\RoutePickup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PickupResidueContainer>
 */
class PickupResidueContainerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'route_pickup_id' => RoutePickup::factory(),
            'residue_id' => Residue::factory(),
            'container_id' => Container::factory(),
            'quantity' => $this->faker->randomFloat(2, 1, 2000),
            'notes' =>  $this->faker->sentence(),
            'should_pickup_container' => $this->faker->boolean(),
        ];
    }
}
