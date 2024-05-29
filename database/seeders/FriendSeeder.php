<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FriendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Mohamed Mohamed',
                'email' => 'mohamed@gmail.com',
                'password' => bcrypt('password'),
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'Ahmed Ali',
                'email' => 'ahmed@gmail.com',
                'password' => bcrypt('password'),
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),

            ],
            [
                'name' => 'Yasser ali',
                'email' => 'yasser@gmail.com',
                'password' => bcrypt('password'),
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),

            ],
            [
                'name' => 'Sayed Mohamed',
                'email' => 'Sayed@gmail.com',
                'password' => bcrypt('password'),
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),

            ],
            [
                'name' => 'Fatma Reda',
                'email' => 'fatma@gmail.com',
                'password' => bcrypt('password'),
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),

            ],
        ]);
    }
}
