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
        Schema::create('lorawan_recharge_requests', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('payment_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ['New', 'Pending', 'Sent', 'Failed', 'Success'])->default('New');
            $table->decimal('topup_amount');
            $table->decimal('topup_to_device_amount');
            $table->string('error_code')->nullable();
            $table->string('error_message')->nullable();
            $table->string('order_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lorawan_recharge_requests');
    }
};
