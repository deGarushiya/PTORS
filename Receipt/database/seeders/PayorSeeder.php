<?php

namespace Database\Seeders;

use App\Models\Payor;
use Illuminate\Database\Seeder;

class PayorSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Sample Payor',
            'Provincial Government of Pangasinan',
            'Provincial Treasurer of Pangasinan',
            'Marpe F. Sison',
            'Private Individual',
        ];
        foreach ($names as $i => $name) {
            Payor::firstOrCreate(
                ['name' => $name],
                ['sort_order' => $i + 1]
            );
        }
    }
}
