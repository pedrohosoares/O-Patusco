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

    //php artisan test --filter=test_list_schedula_recpcionista_with_parameters
    public function test_list_schedula_recpcionista_with_parameters(): void
    {
        $schedule_with_date = DB::table('schedules')->first();
        $schedule_with_date = explode(' ',$schedule_with_date->date)[0];
        $response = $this->get("/api/receptionists/schedules?date_start={$schedule_with_date}&date_end={$schedule_with_date}",[
            'Authorization' => 'Bearer ' . $this->token,
        ]);
        $jsonResponse = $response->json();
        $this->assertArrayHasKey('data', $jsonResponse);
        $this->assertArrayHasKey('id', $jsonResponse['data'][0]);
        $this->assertArrayHasKey('meta', $jsonResponse);
        $this->assertArrayHasKey('links', $jsonResponse);
        $response->assertStatus(200);
    }

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
        $response->assertStatus(200);
        $response->assertJson(['success'=>true]);
        $jsonResponse = $response->json();
        $this->assertArrayHasKey('id', $jsonResponse['data']);
        $this->assertNotEmpty($jsonResponse['data']);
    }

    //php artisan test --filter=test_join_doctor_to_schedule
    public function test_join_doctor_to_schedule(): void
    {
        $doctorID = DB::table('users')->where('rule_id',3)->first();
        $scheduleID = DB::table('schedules')->first();
        $scheduleID = $scheduleID->id;
        $doctorID = $doctorID->id;
        $response = $this->post("/api/receptionists/schedules/join_doctor/{$scheduleID}/{$doctorID}",[],['Authorization' => 'Bearer ' . $this->token]);
        $response->assertStatus(200);
        $response->assertJson(['success'=>true]);
    }

    //php artisan test --filter=test_remove_doctor_to_schedule
    public function test_remove_doctor_to_schedule(): void
    {
        $doctorID = DB::table('users')->where('rule_id',3)->first();
        $scheduleID = DB::table('schedules')->first();
        $scheduleID = $scheduleID->id;
        $doctorID = $doctorID->id;
        $response = $this->post("/api/receptionists/schedules/remove_doctor/{$scheduleID}/{$doctorID}",[],['Authorization' => 'Bearer ' . $this->token]);
        $response->assertStatus(200);
        $response->assertJson(['success'=>true]);
    }

    //php artisan test --filter=test_show_schedule
    public function test_show_schedule(): void
    {
        $scheduleID = DB::table('schedules')->first();
        $scheduleID = $scheduleID->id;
        $response = $this->get("/api/receptionists/schedules/show/{$scheduleID}",[],['Authorization' => 'Bearer ' . $this->token]);
        $response->assertStatus(200);
        $response->assertJson(['success'=>true]);
        $jsonResponse = $response->json();
        $this->assertArrayHasKey('id', $jsonResponse['data']);
    }


    //php artisan test --filter=test_delete_schedule
    public function test_delete_schedule(): void
    {
        $scheduleID = DB::table('schedules')->first();
        $scheduleID = $scheduleID->id;
        $response = $this->delete("/api/receptionists/schedules/{$scheduleID}",[],['Authorization' => 'Bearer ' . $this->token]);
        $response->assertStatus(200);
        $response->assertJson(['success'=>true]);
        $response->assertJson(['data'=>true]);
    }

    //php artisan test --filter=test_show_doctors
    public function test_show_doctors(): void
    {
        $response = $this->get("/api/doctors",[],['Authorization' => 'Bearer ' . $this->token]);
        $response->assertStatus(200);
        $jsonResponse = $response->json();
        $this->assertArrayHasKey('current_page', $jsonResponse);
        $this->assertNotEmpty($jsonResponse['data']);
    }
}
