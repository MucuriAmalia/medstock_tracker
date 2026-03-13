<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Aron Ndungu',
                'email' => 'aron@medstock.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Grace Wanjiru',
                'email' => 'grace.pharmacy@medstock.com',
                'password' => Hash::make('password'),
                'role' => 'pharmacist',
            ],
            [
                'name' => 'James Mutiso',
                'email' => 'james.store@medstock.com',
                'password' => Hash::make('password'),
                'role' => 'storekeeper',
            ],
            [
                'name' => 'Mercy Atieno',
                'email' => 'mercy.nurse@medstock.com',
                'password' => Hash::make('password'),
                'role' => 'staff',
            ],
            [
                'name' => 'Peter Kamau',
                'email' => 'peter.clinic@medstock.com',
                'password' => Hash::make('password'),
                'role' => 'staff',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }
    }
}