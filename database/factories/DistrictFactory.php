<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\District;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<District>
 */
class DistrictFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'code' => fake()->unique()->randomAscii(),
            'country_id' => fake(Country::class),
            'region_id' => fake(Region::class),
        ];
    }
}
