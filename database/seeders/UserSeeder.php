<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Student',
                'email'=> 'student@gmail.com',
                'password'=> bcrypt('password'),
                'role' => 'student',
                'created_at' => Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],
            [
                'name' => 'Instructor',
                'email'=> 'instructor@gmail.com',
                'password'=> bcrypt('password'),
                'role' => 'instructor',
                'created_at' => Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],
        ];

        User::insert($users);
    }
}
