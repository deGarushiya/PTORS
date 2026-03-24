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
     * Run after: php artisan migrate:fresh --seed
     *
     * Hospital data comes only from HospitalFundAccountsSeeder (base hospitals +
     * hospital_trust_accounts with DM/PF/account_code + hospital_general_accounts).
     * HospitalSeeder, HospitalAccountSeeder, GeneralFundHospitalSeeder are legacy
     * and are NOT called here.
     */
    public function run(): void
    {
        $this->call(OfficeSeeder::class);
        $this->call(ParticularSeeder::class);
        $this->call(BankSeeder::class);
        if (\Illuminate\Support\Facades\Schema::hasTable('bank_branches')) {
            $this->call(BankBranchSeeder::class);
        }
        if (\Illuminate\Support\Facades\Schema::hasTable('payors')) {
            $this->call(PayorSeeder::class);
        }
        if (\Illuminate\Support\Facades\Schema::hasTable('hospitals')) {
            $this->call(HospitalFundAccountsSeeder::class);
        }

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

        $this->call(ReceiptSeeder::class);
    }
}
