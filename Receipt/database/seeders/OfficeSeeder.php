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
            ['code' => 'TREASURY'],
            [
                'name' => 'Provincial Treasury Office',
                'address' => null,
                'contact' => null,
                'is_active' => true,
            ]
        );
    }
}
