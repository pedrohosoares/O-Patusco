<?php

namespace Database\Factories\Services;

use App\Models\Services\Order;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Services\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date'=> fake()->date(),
            'time'=> fake()->randomElement(['am','pm']),
            'order_id'=> Order::factory(),
            'completed'=> fake()->randomElement([0,1])
        ];
    }
}
