<?php

namespace Database\Seeders;

use App\Models\Particular;
use Illuminate\Database\Seeder;

class ParticularSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            ['name' => 'Settlement of Cash Advance', 'modal_type' => 'settlement', 'sort_order' => 1],
            ['name' => 'Liquidation of Cash Advance', 'modal_type' => 'liquidation', 'sort_order' => 2],
            ['name' => 'Remittance of Banaan Provincial Museum Shop Sale', 'modal_type' => null, 'sort_order' => 3],
            ['name' => 'Payment of 25% Government LGU Share', 'modal_type' => null, 'sort_order' => 4],
            ['name' => 'Refund of Unexpected Cash Advance', 'modal_type' => null, 'sort_order' => 5],
            ['name' => 'Maip', 'modal_type' => null, 'sort_order' => 6],
        ];

        foreach ($defaults as $item) {
            Particular::firstOrCreate(
                ['name' => $item['name']],
                ['modal_type' => $item['modal_type'], 'sort_order' => $item['sort_order'], 'is_active' => true]
            );
        }
    }
}
