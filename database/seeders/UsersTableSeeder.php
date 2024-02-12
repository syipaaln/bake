<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'syipaaln',
            'email' => 'syipa@gmail.com',
            'password' => bcrypt('syipa123'),
            'full_name' => 'Syipa Latipa',
            'avatar' => 'https://i.pinimg.com/564x/eb/99/a2/eb99a2736e6237c3668de38bbe3eec32.jpg'
        ]);
        User::create([
            'username' => 'moiz',
            'email' => 'moiz@gmail.com',
            'password' => bcrypt('moiz1234'),
            'full_name' => 'moizzzzz',
            'avatar' => 'https://i.pinimg.com/564x/3f/f0/18/3ff0182c281737ce1ac801e29d712d22.jpg'
        ]);
    }
}
