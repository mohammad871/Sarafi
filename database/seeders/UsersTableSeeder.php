<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'noor mohammad',
            'password' => Hash::make('123123'),
            'profile_photo_path'=> null
        ]);
        DB::table('users')->insert([
            'name' => 'admin',
            'password' => Hash::make('123123'),
            'profile_photo_path'=> null
        ]);
        DB::table('users')->insert([
            'name' => 'user',
            'password' => Hash::make('123123'),
            'profile_photo_path'=> null
        ]);
        DB::table('users')->insert([
            'name' => 'mohammad.alamkhil',
            'password' => Hash::make('12345'),
            'profile_photo_path'=> null
        ]);
    }
}
