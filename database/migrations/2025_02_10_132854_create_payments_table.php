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
            $table->id();
            $table->uuid('internal_txn_id');
            $table->foreign('internal_txn_id')->references('txn_id')->on('airtel_requests')->onDelete('cascade');
            $table->foreignId('customer_id')->nullable()->constrained('customers');
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
