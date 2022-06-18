<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Diego',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'admin'=> 1
        ]);
        DB::table('users')->insert([
            'name' => 'Luis carlos',
            'email' => 'provider@gmail.com',
            'password' => Hash::make('password'),
            'admin'=> 0
        ]);
    }
}