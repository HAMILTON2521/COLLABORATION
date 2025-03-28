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
        Schema::create('push_requests', function (Blueprint $table) {
            $table->ulid('id')->primary()->unique();
            $table->foreignUlid('customer_id')->constrained()->cascadeOnDelete();
            $table->string('phone', length: 10);
            $table->unsignedInteger('amount');
            $table->enum('channel', ['Airtel', 'Vodacom', 'Yas']);
            $table->enum('status', ['New', 'Pending', 'Success', 'Failed']);
            $table->string('mno_response_code')->nullable();
            $table->string('mno_error_code')->nullable();
            $table->string('mno_status')->nullable();
            $table->string('mno_result_code')->nullable();
            $table->string('mno_message')->nullable();
            $table->string('mno_txn_id')->nullable();
            $table->timestamp('mno_response_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('push_requests');
    }
};
