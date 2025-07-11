<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('other_payments', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->decimal('amount');
            $table->string('msisdn');
            $table->string('reference');
            $table->string('operator');
            $table->string('utilityref')->nullable();
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
        Schema::dropIfExists('other_payments');
    }
};
