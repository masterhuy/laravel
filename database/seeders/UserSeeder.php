<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table("users")->insert([
            "username" => "admin",
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "password" => \Hash::make("123456789"),
            "department_id" => "1",
            "status_id" => "1"
        ]);
    }
}
