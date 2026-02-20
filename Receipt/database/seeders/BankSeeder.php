<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    public function run(): void
    {
        $banks = [
            'BDO Unibank',
            'BPI',
            'Metrobank',
            'Landbank',
            'UnionBank',
            'PNB',
            'Security Bank',
            'RCBC',
            'Chinabank',
            'Maybank',
            'Development Bank of the Philippines',
            'UCPB',
            'East West Bank',
            'Other',
        ];
        foreach ($banks as $i => $name) {
            Bank::firstOrCreate(
                ['name' => $name],
                ['sort_order' => $i + 1]
            );
        }
    }
}
