<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Andrey',
            'email' => 'ais.alifirenko@gmail.com',
            'password' => Hash::make('123456'),
            'api_token' => Str::random(60),
            'role_id' => 1,
        ]);
    }
}
