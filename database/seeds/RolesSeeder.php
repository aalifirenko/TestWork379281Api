<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'student',
        ]);

        DB::table('roles')->insert([
            'name' => 'teacher',
        ]);

        DB::table('roles')->insert([
            'name' => 'involved parent',
        ]);

        DB::table('roles')->insert([
            'name' => 'parent',
        ]);
    }
}
