<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Rabbi Sheikh','email' => 'rabbi@gmail.com','password' => '123456'],
            ['name' => 'Siam Sheikh','email' => 'siam@gmail.com','password' => '123456'],
            ['name' => 'Samia Khanom','email' => 'samia@gmail.com','password' => '123456'],
        ];

        User::insert($users);
    }
}
