<?php

namespace Database\Factories;

use App\Enums\Unit;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContainerType>
 */
class ContainerTypeFactory extends Factory
{
    public function definition(): array
    {
        $length = $this->faker->randomFloat(2, 10, 200);
        $width = $this->faker->randomFloat(2, 10, 200);
        $height = $this->faker->randomFloat(2, 10, 200);

        return [
            'name' => $this->faker->unique()->words(2, true),
            'unit' => $this->faker->randomElement(Unit::cases()),
            'capacity' => $this->faker->randomFloat(2, 1, 500),
            'un_code' => $this->faker->optional()->bothify('UN###'),
            'length_cm' => $length,
            'width_cm' => $width,
            'height_cm' => $height,
            'company_id' => Company::factory(),
        ];
    }
}
