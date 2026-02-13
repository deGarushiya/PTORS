<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $this->call(UserSeeder::class);
        // Admin
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        // Normal User
        User::create([
            'name' => 'User',
            'username' => 'alma',
            'password' => Hash::make('alma'),
            'role' => 'user',
        ]);
    }
}
