<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('receipts', function (Blueprint $table) {
            $table->string('check_bank_name')->nullable()->after('payment_method');
            $table->string('check_number')->nullable()->after('check_bank_name');
            $table->date('check_date')->nullable()->after('check_number');
        });
    }

    public function down(): void
    {
        Schema::table('receipts', function (Blueprint $table) {
            $table->dropColumn(['check_bank_name', 'check_number', 'check_date']);
        });
    }
};
