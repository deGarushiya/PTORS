<?php

namespace Database\Seeders;

use App\Models\Hospital;
use Illuminate\Database\Seeder;

class GeneralFundHospitalSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['MANAOAG COMMUNITY HOSPITAL', '2422-1061-14'],
            ['POZORRUBIO COMMUNITY HOSPITAL', '2422-1061-30'],
            ['DASOL COMMUNITY HOSPITAL', '2422-1061-06'],
            ['MANGATAREM DISTRICT HOSPITAL', '2422-1061-57'],
            ['URDANETA DISTRICT HOSPITAL', '2422-1060-76'],
            ['BAYAMBANG DISTRICT HOSPITAL', '2422-1060-41'],
            ['PANGASINAN PROVINCIAL HOSPITAL', '2422-1060-33'],
            ['BLOOD BANK', '2422-1077-73'],
            ['ASINGAN COMMUNITY HOSPITAL', '2422-1060-84'],
            ['BOLINAO COMMUNITY HOSPITAL', '2422-1060-92'],
            ['EASTERN PANGASINAN DISTRICT HOSPITAL', '2422-1060-50'],
            ['WESTERN PANGASINAN DISTRICT HOSPITAL', '1272-1016-60'],
            ['UMINGAN COMMUNITY HOSPITAL', '2422-1061-49'],
            ['MAPANDAN COMMUNITY HOSPITAL', '2422-1061-22'],
            ['LINGAYEN DISTRICT HOSPITAL', '2422-1060-68'],
        ];

        $maxOrder = Hospital::max('sort_order') ?? 0;
        foreach ($rows as $i => $row) {
            Hospital::updateOrCreate(
                ['name' => $row[0]],
                [
                    'general_account_code' => $row[1],
                    'sort_order' => $maxOrder + $i + 1,
                ]
            );
        }
    }
}

