<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\BankBranch;
use Illuminate\Database\Seeder;

class BankBranchSeeder extends Seeder
{
    /**
     * Banks with their branches.
     */
    protected array $banksWithBranches = [
        'Landbank' => [
            'Lingayen',
            'Dagupan',
            'Calasiao',
            'San Carlos City',
            'Mangaldan',
            'Mangatarem',
            'Binalonan',
            'Alaminos City',
            'Carmen',
            'Urdaneta City',
            'Tayug',
            'Laoac',
            'Bolinao',
        ],
        'BDO Unibank' => [
            'Alaminos City',
            'Lingayen',
            'Dagupan City (Tapuac)',
            'Dagupan City (Perez)',
            'Dagupan City (Fernandez)',
            'Dagupan City (Mayombo)',
            'Calasiao',
            'San Carlos City',
            'Mangaldan',
            'Malasiqui',
            'Bayambang',
            'Pozorrubio',
            'Urdaneta City',
            'Carmen',
            'Tayug',
        ],
        'BPI' => [
            'Alaminos City',
            'Dagupan City (Perez)',
            'Dagupan City (Arellano)',
            'Dagupan City (Lucao)',
            'Dagupan City (Caranglaan)',
            'San Carlos City',
            'Urdaneta City (Alexander)',
            'Urdaneta City (McArthur)',
            'Rosales',
            'Manaoag',
        ],
        'Metrobank' => [
            'Lingayen',
            'Alaminos City',
            'Mangatarem',
            'Dagupan City (Tapuac)',
            'Dagupan City (Perez)',
            'Dagupan City (Fernandez)',
            'Calasiao',
            'Bayambang',
            'Mangaldan',
            'Urdaneta City (Nancayasan)',
            'Urdaneta City (Alexander)',
            'Rosales',
            'Tayug',
        ],
    ];

    public function run(): void
    {
        if (!\Illuminate\Support\Facades\Schema::hasTable('bank_branches')) {
            return;
        }

        $bankOrder = 0;
        foreach ($this->banksWithBranches as $bankName => $branchNames) {
            $bank = Bank::firstOrCreate(
                ['name' => $bankName],
                ['sort_order' => ++$bankOrder]
            );

            $sortOrder = 0;
            foreach ($branchNames as $branchName) {
                BankBranch::updateOrCreate(
                    [
                        'bank_id' => $bank->id,
                        'name' => $branchName,
                    ],
                    ['sort_order' => ++$sortOrder]
                );
            }
        }
    }
}
