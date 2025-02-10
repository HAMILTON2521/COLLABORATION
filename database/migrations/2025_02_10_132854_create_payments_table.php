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
            $table->foreignId('customer_id')->nullable()->constrained('customers');
            $table->string('msisdn', length: 12);
            $table->string('reference')->nullable();
            $table->string('payer_name')->nullable();
            $table->decimal('amount');
            $table->uuid('internal_txn_id')->unique();
            $table->string('merchant');
            $table->string('external_id')->unique();
            $table->string('external_reference')->nullable();
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
