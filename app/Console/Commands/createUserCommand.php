<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class createUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insere usuários na base de dados';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::table('users')
        ->insert([
            [
                'name'=>'teste1',
                'email'=>'medico@gmail.com',
                'password'=>Hash::make('password'),
                'rule_id'=>3,
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
            [
                'name'=>'teste2',
                'email'=>'recepcionista@gmail.com',
                'password'=>Hash::make('password'),
                'rule_id'=>2,
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
            [
                'name'=>'teste3',
                'email'=>'cliente@gmail.com',
                'password'=>Hash::make('password'),
                'rule_id'=>1,
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]
        ]
        );
    }
}
