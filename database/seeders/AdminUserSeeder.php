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
                'name' => 'Admin Two',
                'email' => 'admin2@ebo.co.ug',
                'password' => Hash::make('AdminPassword123'),
            ],
            [
                'name' => 'Admin Three',
                'email' => 'admin3@ebo.co.ug',
                'password' => Hash::make('AdminPassword123'),
            ],
        ];

        foreach ($admins as $admin) {
            User::updateOrCreate(
                ['email' => $admin['email']], // unique key
                $admin
            );
        }
    }
}
