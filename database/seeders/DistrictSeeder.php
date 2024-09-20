<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        District::factory()->create([
            'name' => 'Агрыз',
            'code' => 'agriz',
            'country_id' => 1,
            'region_id' => 1,
        ]);
    }
}
