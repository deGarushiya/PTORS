<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(OfficeSeeder::class);
        $this->call(ParticularSeeder::class);
        $this->call(BankSeeder::class);

        // User::factory(10)->create();
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Alma', 'role' => 'user', 'password' => \Illuminate\Support\Facades\Hash::make('password')]
        );
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin', 'role' => 'admin', 'password' => \Illuminate\Support\Facades\Hash::make('password')]
        );
        User::where('email', 'admin@example.com')->update(['role' => 'admin']);
    }
}
