<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            [
                'name' => 'Admin',
                'email' => 'test@ebo.co.ug',
                'password' => Hash::make('AdminPassword123'),
            ],
            [
                'name' => 'Admin EBO',
                'email' => 'admin@ebo.co.ug',
                'password' => Hash::make('ii7Ohbep4ua3'),
            ]
        ];

        foreach ($admins as $admin) {
            User::updateOrCreate(
                ['email' => $admin['email']], // unique key
                $admin
            );
        }
    }
}
