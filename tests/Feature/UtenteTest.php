<?php

namespace Tests\Feature;

use Tests\TestCase;

class UtenteTest extends TestCase
{
    //php artisan test --filter=test_insert_new_schedule
    public function test_insert_new_schedule(): void
    {
        $response = $this->post('/api/clients/orders',[
            'user'=>[
                'name'=>fake()->name(),
                'email'=>fake()->email(),
            ],
            'animal'=>[
                'name'=>fake()->name(),
                'birthday'=>fake()->date(),
            ],
            'race'=>[
                'name'=>fake()->name(),
            ],
            'order'=>[
                'symptoms'=>fake()->text(),
            ],
            'schedule'=>[
                'date'=>fake()->date(),
                'time'=>fake()->randomElement(['am','pm'])
            ]
        ]);
        $response->assertStatus(200);
        $response->assertJson(['success'=>true]);
    }
}
