<?php

namespace Database\Factories\Animals;

use App\Models\Animals\Race;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animals\Race>
 */
class RaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Race::class;

    public function definition(): array
    {
        return [
            'name'=> fake()->name()
        ];
    }
}
