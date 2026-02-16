<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Seed default office(s) for the receipting system.
     */
    public function run(): void
    {
        Office::firstOrCreate(
            ['code' => 'MAIN'],
            [
                'name' => 'Main Office',
                'address' => null,
                'contact' => null,
                'is_active' => true,
            ]
        );
    }
}
