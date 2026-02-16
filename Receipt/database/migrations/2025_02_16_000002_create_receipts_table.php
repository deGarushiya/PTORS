<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->string('receipt_number')->unique();
            $table->foreignId('office_id')->constrained('offices')->cascadeOnDelete();
            $table->foreignId('issued_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('payer_name');
            $table->decimal('amount', 12, 2);
            $table->string('payment_method')->nullable();
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->date('receipt_date');
            $table->timestamps();

            $table->index(['office_id', 'receipt_date']);
            $table->index('receipt_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
