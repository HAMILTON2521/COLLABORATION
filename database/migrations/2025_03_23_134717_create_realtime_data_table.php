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
        Schema::create('realtime_data', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->enum('source', ['Manual', 'System']);
            $table->foreignUlid('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('status', ['New', 'Pending', 'Failed', 'Success']);
            $table->decimal('balance')->nullable();
            $table->string('battery')->nullable();
            $table->string('energy_type')->nullable();
            $table->timestamp('read_time')->nullable();
            $table->foreignUlid('imei')->nullable()->constrained('customers', 'imei')->nullOnDelete();
            $table->string('margin')->nullable();
            $table->string('leakage_mark')->nullable();
            $table->decimal('reading')->nullable();
            $table->boolean('valve_state')->nullable();
            $table->string('valve_status')->nullable();
            $table->string('temperature')->nullable();
            $table->string('class_mode')->nullable();
            $table->string('day_read_time')->nullable();
            $table->string('month_read_time')->nullable();
            $table->string('pay_mode')->nullable();
            $table->decimal('rssi')->nullable();
            $table->decimal('snr')->nullable();
            $table->string('day_consumption')->nullable();
            $table->string('month_consumption')->nullable();
            $table->string('error_code', length: 10)->nullable();
            $table->string('error_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realtime_data');
    }
};
