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
            $table->foreignUlid('internal_txn_id')->constrained('incoming_requests')->cascadeOnDelete();
            $table->foreignUlid('customer_id')->nullable()->constrained('customers')->cascadeOnDelete();
            $table->string('msisdn')->nullable();
            $table->string('channel');
            $table->string('external_id')->unique();
            $table->decimal('amount');
            $table->decimal('accumulated_volume')->nullable();
            $table->enum('status', [
                'Success',
                'Failed',
                'Received',
                'Recharged'
            ])->default('Received');
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
