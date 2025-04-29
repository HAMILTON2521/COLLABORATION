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
        Schema::create('selcom_orders', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('customer_id')->constrained()->cascadeOnDelete();
            $table->string('phone', length: 10);
            $table->decimal('amount');
            $table->enum('status', ['New', 'Success', 'Failed'])->default('New');
            $table->string('reference')->nullable();
            $table->string('resultcode')->nullable();
            $table->string('result')->nullable();
            $table->string('message')->nullable();
            $table->string('payment_token')->nullable();
            $table->text('payment_gateway_url')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->foreignUlid('payment_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selcom_orders');
    }
};
