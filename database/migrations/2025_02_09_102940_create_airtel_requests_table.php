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
        Schema::create('airtel_requests', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('type', length: 20)->nullable();
            $table->enum('request', ['Validate', 'Process', 'Enquiry']);
            $table->string('customer_msisdn', length: 12);
            $table->string('merchant_msisdn', length: 12)->nullable();
            $table->decimal('amount')->nullable();
            $table->string('user_name', length: 32)->nullable();
            $table->string('password')->nullable();
            $table->string('pin')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('reference')->nullable();
            $table->string('reference_1')->nullable();
            $table->string('reference_2')->nullable();
            $table->string('enquiry_txn_id')->nullable();
            $table->enum('status', ['Success', 'Failed', 'Not Found'])->default('Failed');
            $table->string('error_message')->nullable()->default('Validation failed');
            $table->json('error_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airtel_requests');
    }
};
