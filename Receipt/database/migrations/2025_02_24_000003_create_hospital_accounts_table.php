<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hospital_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');           // e.g. "WESTERN PANGASINAN DISTRICT HOSPITAL - DM"
            $table->string('account_code');  // e.g. "001272-1051-00"
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hospital_accounts');
    }
};
