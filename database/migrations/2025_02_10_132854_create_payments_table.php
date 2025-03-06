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
        Schema::create('payments', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('internal_txn_id')->constrained('airtel_requests')->cascadeOnDelete();
            $table->foreignUlid('customer_id')->nullable()->constrained('customers')->cascadeOnDelete();
            $table->string('msisdn')->nullable();
            $table->string('external_id')->unique();
            $table->decimal('amount');
            $table->enum('status', ['Success', 'Failed', 'Received'])->default('Received');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
