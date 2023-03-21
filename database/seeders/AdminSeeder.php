<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Admin',
            'description' => 'Administrator',
        ]);

        DB::table('roles')->insert([
            'name' => 'Staff',
            'description' => 'Management Staff',
        ]);

        DB::table('roles')->insert([
            'name' => 'Trainer',
            'description' => 'Intructor of the topic',
        ]);

        DB::table('roles')->insert([
            'name' => 'Trainee',
            'description' => 'Student that learning courses',
        ]);

        DB::table('human_resources')->insert([
            'username' => 'admin',
            'password' => Hash::make('123'),
            'role_id' => '1',
        ]);
    }
}
