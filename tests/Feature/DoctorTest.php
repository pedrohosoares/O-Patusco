<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DoctorTest extends TestCase
{

    protected $token;

    protected function setUp(): void
    {
        parent::setUp();
        $this->get('/sanctum/csrf-cookie');
        $user = DB::table('users')->where('email','medico@gmail.com')->first();
        if(empty($user)){
            $this->artisan('insert:users');
        }
        $response = $this->post('/api/login',[
            'email'=>'medico@gmail.com',
            'password'=>'password'
        ]);
        $jsonResponse = $response->json();
        $this->token = $jsonResponse['data']['token']; 
    }

    //php artisan test --filter=test_list_schedula_recpcionista_doctor
    public function test_list_schedula_recpcionista_doctor(): void
    {
        $response = $this->get("/api/doctors/schedules",[
            'Authorization' => 'Bearer ' . $this->token,
        ]);
        $jsonResponse = $response->json();
        $this->assertArrayHasKey('data', $jsonResponse);
        $this->assertArrayHasKey('meta', $jsonResponse);
        $this->assertArrayHasKey('links', $jsonResponse);
        $response->assertStatus(200);
    }

    //php artisan test --filter=test_get_schedule_doctor
    public function test_get_schedule_doctor(): void
    {
        $schedule = DB::table('schedules')->first();
        $user = DB::table('users')->where('email','medico@gmail.com')->first();
        $relation = DB::table('schedule_doctor')->insert(['user_id'=>$user->id,'schedule_id'=>$schedule->id]);
        $response = $this->get("/api/doctors/schedules/show/{$schedule->id}",[
            'Authorization' => 'Bearer ' . $this->token,
        ]);
        $jsonResponse = $response->json();
        $this->assertArrayHasKey('data', $jsonResponse);
        $this->assertArrayHasKey('id', $jsonResponse['data'][0]);
        $this->assertArrayHasKey('meta', $jsonResponse);
        $this->assertArrayHasKey('links', $jsonResponse);
        $response->assertStatus(200);
    }
}
