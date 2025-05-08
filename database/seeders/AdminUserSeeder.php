<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'user_firstname' => 'Admin',
            'user_lastname' => 'User',
            'user_password' => bcrypt('admin123'),
            'user_role' => 'admin',
            'date_created' => now(),
            'last_login' => null
        ]);
    }
}
