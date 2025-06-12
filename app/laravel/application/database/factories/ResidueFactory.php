<?php

namespace Database\Factories;

use App\Enums\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Residue>
 */
class ResidueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Used Engine Oil',
                'Oil Filters',
                'Brake Fluid',
                'Transmission Fluid',
                'Coolant/Antifreeze',
                'Grease',
                'Battery Acid',
                'Air Filters',
                'Fuel Filters',
                'Solvent Waste',
                'Rags Contaminated with Oil',
                'Contaminated Fuel',
                'Empty Oil Containers',
                'Windshield Washer Fluid',
                'Tires',
                'Used Brake Pads',
                'Used Brake Discs',
                'Aerosol Cans',
                'Waste Paint',
                'Absorbent Materials'
            ]),
            'unit' => $this->faker->randomElement(Unit::cases()),
        ];
    }
}
