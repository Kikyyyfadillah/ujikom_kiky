<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = [
            [
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('adminkiky23'),
                'level' => 1
            ],
            [
                'name' => 'Kasir',
                'email' => 'kasir@gmail.com',
                'password' => bcrypt('kasirkiky24'),
                'level' => 2
            ],
            [
                'name' => 'Owner',
                'email' => 'owner@gmail.com',
                'password' => bcrypt('ownerkiky25'),
                'level' => 3
            ],

        ];

        foreach ($user as $key => $val) {
            User::create($val);
        }
    }
}
