<?php

namespace Database\Seeders;

use App\Models\Office;
use App\Models\Receipt;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReceiptSeeder extends Seeder
{
    // seeder sample lang yna. for testing lang
    public function run(): void
    {
        $office = Office::first();
        $user = User::first();
        if (! $office || ! $user) {
            return;
        }

        $samples = [
            [
                'receipt_number' => '1001001',
                'payer_name' => 'Sample Payor One',
                'amount' => 1500.00,
                'payment_method' => 'Cash',
                'description' => 'Maip',
                'receipt_date' => now()->subDays(2),
            ],
            [
                'receipt_number' => '1001002',
                'payer_name' => 'Sample Payor Two',
                'amount' => 2500.50,
                'payment_method' => 'Cash',
                'description' => 'Payment of 25% Government LGU Share',
                'receipt_date' => now()->subDay(),
            ],
            [
                'receipt_number' => '1001003',
                'payer_name' => 'Sample Payor Three',
                'amount' => 5000.00,
                'payment_method' => 'Cash',
                'description' => 'Remittance of Banaan Provincial Museum Shop Sale',
                'receipt_date' => now(),
            ],
        ];

        foreach ($samples as $data) {
            Receipt::firstOrCreate(
                [
                    'receipt_number' => $data['receipt_number'],
                    'office_id' => $office->id,
                ],
                [
                    'issued_by' => $user->id,
                    'payer_name' => $data['payer_name'],
                    'amount' => $data['amount'],
                    'payment_method' => $data['payment_method'],
                    'description' => $data['description'],
                    'receipt_date' => $data['receipt_date'],
                    'status' => 'active',
                ]
            );
        }
    }
}
