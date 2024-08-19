<?php

namespace Database\Factories\Services;

use App\Models\Animals\Animal;
use App\Models\Services\Order;
use App\Models\Users\User;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Services\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id'=> User::factory(),
            'animal_id'=> Animal::factory(),
            'symptoms'=> fake()->text()
        ];
    }
}
