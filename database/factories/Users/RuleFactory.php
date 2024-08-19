<?php

namespace Database\Factories\Users;

use App\Models\Users\Rule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Users\Rule>
 */
class RuleFactory extends Factory
{

    protected $model = Rule::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_type'=> fake()->name()
        ];
    }
}
