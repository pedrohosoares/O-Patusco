<?php

namespace Database\Factories\Animals;

use App\Models\Animals\Animal;
use App\Models\Animals\Race;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animals\Animal>
 */
class AnimalFactory extends Factory
{
    protected $model = Animal::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=> fake()->name(),
            'birthday'=> fake()->date('Y-m-d'),
            'observations'=> fake()->text(),
            'owner_id'=> User::factory(),
            'race_id'=> Race::factory()
        ];
    }
}
