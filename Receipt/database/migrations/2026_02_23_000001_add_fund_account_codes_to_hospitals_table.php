<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hospitals', function (Blueprint $table) {
            $table->string('trust_account_code', 100)->nullable()->after('account_code');
            $table->string('general_account_code', 100)->nullable()->after('trust_account_code');
        });
    }

    public function down(): void
    {
        Schema::table('hospitals', function (Blueprint $table) {
            $table->dropColumn(['trust_account_code', 'general_account_code']);
        });
    }
};

