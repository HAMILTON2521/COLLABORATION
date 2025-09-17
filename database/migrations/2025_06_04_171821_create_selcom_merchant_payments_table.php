<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('selcom_merchant_payments', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->decimal('amount');
            $table->string('msisdn');
            $table->string('reference');
            $table->string('operator');
            $table->foreignUlid('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->string('transid');
            $table->enum('status', ['Received', 'Failed', 'Success'])->default('Received');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selcom_merchant_payments');
    }
};
