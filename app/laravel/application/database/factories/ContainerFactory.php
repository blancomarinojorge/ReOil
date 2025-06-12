<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\ContainerType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Container>
 */
class ContainerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'observations' => $this->faker->text(),
            'container_type_id' => ContainerType::factory(),
        ];
    }
}
