<?php

namespace Database\Seeders;

use App\Models\Hospital;
use App\Models\HospitalGeneralAccount;
use App\Models\HospitalTrustAccount;
use Illuminate\Database\Seeder;

class HospitalFundAccountsSeeder extends Seeder
{
    public function run(): void
    {
        $baseHospitalNames = [
            'MANAOAG COMMUNITY HOSPITAL',
            'POZORRUBIO COMMUNITY HOSPITAL',
            'DASOL COMMUNITY HOSPITAL',
            'MANGATAREM DISTRICT HOSPITAL',
            'URDANETA DISTRICT HOSPITAL',
            'BAYAMBANG DISTRICT HOSPITAL',
            'PANGASINAN PROVINCIAL HOSPITAL',
            'BLOOD BANK',
            'ASINGAN COMMUNITY HOSPITAL',
            'BOLINAO COMMUNITY HOSPITAL',
            'EASTERN PANGASINAN DISTRICT HOSPITAL',
            'WESTERN PANGASINAN DISTRICT HOSPITAL',
            'UMINGAN COMMUNITY HOSPITAL',
            'MAPANDAN COMMUNITY HOSPITAL',
            'LINGAYEN DISTRICT HOSPITAL',
        ];

        $generalRows = [
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

        $trustRows = [
            ['WESTERN PANGASINAN DISTRICT HOSPITAL - DM', '001272-1051-00'],
            ['WESTERN PANGASINAN DISTRICT HOSPITAL - PF', '001272-1051-34'],
            ['ASINGAN COMMUNITY HOSPITAL - DM', '000112-1155-52'],
            ['ASINGAN COMMUNITY HOSPITAL - PF', '000112-1155-36'],
            ['BOLINAO COMMUNITY HOSPITAL - DM', '001272-1050-53'],
            ['BOLINAO COMMUNITY HOSPITAL - PF', '001272-1050-61'],
            ['LINGAYEN DISTRICT HOSPITAL- DM', '002422-1045-88'],
            ['LINGAYEN DISTRICT HOSPITAL- PF', '002422-1045-96'],
            ['MAPANDAN COMMUNITY HOSPITAL - DM', '002422-1034-41'],
            ['MAPANDAN COMMUNITY HOSPITAL - PF', '002422-1078-11'],
            ['EASTERN PANGASINAN DISTRICT HOSPITAL- DM', '002142-1029-97'],
            ['EASTERN PANGASINAN DISTRICT HOSPITAL- PF', '002142-1030-04'],
            ['UMINGAN COMMUNITY HOSPITAL - DM NEW', '004432-1016-87'],
            ['UMINGAN COMMUNITY HOSPITAL - PF NEW', '004432-1016-95'],
            ['WESTERN PANGASINAN DISTRICT HOSPITAL - DM ACPS', '1272-1050-29'],
            ['WESTERN PANGASINAN DISTRICT HOSPITAL - PF ACPS', '1272-1050-37'],
            ['ASINGAN COMMUNITY HOSPITAL - DM ACPS', '1121-155-10'],
            ['ASINGAN COMMUNITY HOSPITAL - PF ACPS', '1121-155-28'],
            ['BOLINAO COMMUNITY HOSPITAL - DM ACPS', '1272-1050-70'],
            ['BOLINAO COMMUNITY HOSPITAL - PF ACPS', '1272-1050-96'],
            ['LINGAYEN DISTRICT HOSPITAL- DM ACPS', '2422-1045-29'],
            ['LINGAYEN DISTRICT HOSPITAL- PF ACPS', '2422-1045-37'],
            ['BAYAMBANG DISTRICT HOSPITAL - DM', '001342-1046-96'],
            ['BAYAMBANG DISTRICT HOSPITAL - PF', '001342-1046-88'],
            ['URDANETA DISTRICT HOSPITAL - DM', '000112-1154-55'],
            ['URDANETA DISTRICT HOSPITAL - PF', '000112-1154-63'],
            ['PANGASINAN PROVINCIAL HOSPITAL - DM', '001342-1013-79'],
            ['PANGASINAN PROVINCIAL HOSPITAL - PF', '001342-1013-52'],
            ['PANGASINAN PROVINCIAL HOSPITAL - XRAY', '001342-1045-99'],
            ['PANGASINAN PROVINCIAL HOSPITAL - DIALYSIS', '001342-1043-35'],
            ['DASOL COMMUNITY HOSPITAL - DM/PF', '001272-1050-45'],
            ['MANGATAREM DISTRICT HOSPITAL - DM', '002422-1026-66'],
            ['MANGATAREM DISTRICT HOSPITAL - PF', '002422-1026-74'],
            ['MANAOAG COMMUNITY HOSPITAL - DM', '002422-1038-24'],
            ['MANAOAG COMMUNITY HOSPITAL - PF', '002422-1078-46'],
            ['MANAOAG COMMUNITY HOSPITAL - TB DOTS', '002422-1183-68'],
            ['POZORRUBIO COMMUNITY HOSPITAL - DM/PF', '002422-1046-26'],
            ['BAYAMBANG DISTRICT HOSPITAL - DM', '2422-1044-80'],
            ['BAYAMBANG DISTRICT HOSPITAL - PF', '2422-1044-99'],
            ['URDANETA DISTRICT HOSPITAL - DM', '0112-1153-74'],
            ['URDANETA DISTRICT HOSPITAL - PF', '0112-1153-82'],
            ['PANGASINAN PROVINCIAL HOSPITAL - DM', '1342-1046-10'],
            ['PANGASINAN PROVINCIAL HOSPITAL - PF', '1342-1046-29'],
            ['DASOL COMMUNITY HOSPITAL - DM', '1272-1051-18'],
            ['DASOL COMMUNITY HOSPITAL - PF', '1272-1051-26'],
            ['MANGATAREM DISTRICT HOSPITAL - DM', '2422-1045-10'],
            ['MANGATAREM DISTRICT HOSPITAL - PF', '2422-1045-02'],
            ['MANAOAG COMMUNITY HOSPITAL - DM', '2422-1045-45'],
            ['MANAOAG COMMUNITY HOSPITAL - PF', '2422-1045-53'],
            ['POZORRUBIO COMMUNITY HOSPITAL - DM', '2422-1045-70'],
            ['POZORRUBIO COMMUNITY HOSPITAL - PF', '2422-1045-61'],
            ['MAPANDAN COMMUNITY HOSPITAL - DM ACPS', '2422-1044-64'],
            ['MAPANDAN COMMUNITY HOSPITAL - PF ACPS', '2422-1044-72'],
            ['EASTERN PANGASINAN DISTRICT HOSPITAL- DM ACPS', '2142-1029-46'],
            ['EASTERN PANGASINAN DISTRICT HOSPITAL- PF ACPS', '2142-1029-54'],
            ['UMINGAN COMMUNITY HOSPITAL - DM NEW ACPS', '4432-1017-09'],
            ['UMINGAN COMMUNITY HOSPITAL - PF NEW ACPS', '4432-1017-17'],
        ];

        $maxOrder = Hospital::max('sort_order') ?? 0;
        foreach ($baseHospitalNames as $i => $name) {
            Hospital::firstOrCreate(
                ['name' => $name],
                ['sort_order' => $maxOrder + $i + 1]
            );
        }

        $hospitals = Hospital::orderByRaw('LENGTH(name) DESC')->get();

        foreach ($generalRows as $i => $row) {
            $hospital = Hospital::where('name', $row[0])->first();
            if ($hospital) {
                HospitalGeneralAccount::updateOrCreate(
                    ['hospital_id' => $hospital->id],
                    ['account_code' => $row[1], 'sort_order' => $i + 1]
                );
            }
        }

        $sortOrder = 0;
        foreach ($trustRows as $row) {
            $displayName = $row[0];
            $accountCode = $row[1];
            $hospital = $hospitals->first(function ($h) use ($displayName) {
                $n = $h->name;
                return str_starts_with($displayName, $n . ' ') || str_starts_with($displayName, $n . '-') || $displayName === $n;
            });
            if ($hospital) {
                HospitalTrustAccount::updateOrCreate(
                    ['hospital_id' => $hospital->id, 'name' => $displayName],
                    ['account_code' => $accountCode, 'sort_order' => ++$sortOrder]
                );
            }
        }
    }
}
