<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class RecepcionistaTest extends TestCase
{

    protected $token;

    protected function setUp(): void
    {
        parent::setUp();
        $this->get('/sanctum/csrf-cookie');
        $user = DB::table('users')->where('email','recepcionista@gmail.com')->first();
        if(empty($user)){
            $this->artisan('insert:users');
        }
        $response = $this->post('/api/login',[
            'email'=>'recepcionista@gmail.com',
            'password'=>'password'
        ]);
        $jsonResponse = $response->json();
        $this->token = $jsonResponse['data']['token']; 
    }

    /**
     * A basic feature test example.
     */
    //php artisan test --filter=test_list_schedula_recpcionista
    public function test_list_schedula_recpcionista(): void
    {
        $response = $this->get('/api/receptionists/schedules',[
            'Authorization' => 'Bearer ' . $this->token,
        ]);
        $jsonResponse = $response->json();
        $this->assertArrayHasKey('data', $jsonResponse);
        $this->assertArrayHasKey('meta', $jsonResponse);
        $this->assertArrayHasKey('links', $jsonResponse);
        $response->assertStatus(200);
    }

    //php artisan test --filter=test_login_application
    public function test_login_application(): void
    {
        $response = $this->post('/api/login',[
            'email'=>'recepcionista@gmail.com',
            'password'=>'password'
        ]);
        $response->assertStatus(200);
        $response->assertJson(['success'=>true]);
        $jsonResponse = $response->json();
        $this->assertArrayHasKey('token', $jsonResponse['data']);
        $this->assertNotEmpty($jsonResponse['data']['token']);
    }

    //php artisan test --filter=test_post_new_schedule
    public function test_post_new_schedule(): void
    {
        $response = $this->post('/api/receptionists/schedules/store',[
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
        ],['Authorization' => 'Bearer ' . $this->token]);
        dd($response->json());
        $response->assertStatus(200);
        $response->assertJson(['success'=>true]);
        //$this->assertArrayHasKey('token', $jsonResponse['data']);
        //$this->assertNotEmpty($jsonResponse['data']['token']);
    }
}
