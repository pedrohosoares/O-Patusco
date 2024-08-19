<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Animals\Animal;
use App\Models\Animals\Race;
use App\Models\Services\Order;
use App\Models\Services\Schedule;
use App\Models\Users\Rule;
use App\Models\Users\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Rule::factory(3)->sequence(
            ['id' => 1,'name_type'=>'cliente'],
            ['id' => 2,'name_type'=>'recepcionista'],
            ['id' => 3,'name_type'=>'medico'],
        )->create();
        User::factory(4)->create();
        Race::factory(10)->create();
        Animal::factory(10)->create();
        Order::factory(11)->create();
        Schedule::factory(6)->create();
    }
}
