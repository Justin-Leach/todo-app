<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        // Creates users
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Test 1',
            'email' => 'test_1@hotmail.com',
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Test 2',
            'email' => 'test_2@hotmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
