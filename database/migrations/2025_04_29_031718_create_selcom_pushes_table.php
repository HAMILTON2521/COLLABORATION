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
        Schema::create('selcom_pushes', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('selcom_order_id')->nullable()->constrained()->cascadeOnDelete();
            $table->enum('status', ['Success', 'Failed', 'Paid']);
            $table->string('reference')->nullable();
            $table->string('resultcode')->nullable();
            $table->string('result')->nullable();
            $table->string('message')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->decimal('amount_paid')->nullable();
            $table->string('external_id')->nullable();
            $table->string('payment_result_code')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_reference')->nullable();
            $table->string('channel')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selcom_pushes');
    }
};
