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
        Schema::create('valve_controls', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->enum('source', ['Payment', 'Manual']);
            $table->foreignUlid('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignUlid('payment_id')->nullable()->constrained()->cascadeOnDelete();
            $table->boolean('state');
            $table->foreignUlid('customer_id')->constrained()->cascadeOnDelete();
            $table->string('error_code', length: 10)->nullable();
            $table->string('error_message')->nullable();
            $table->string('value_id', length: 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valve_controls');
    }
};
