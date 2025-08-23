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
        Schema::table('realtime_data', function (Blueprint $table) {
            $table->dropColumn([
                'valve_status',
                'temperature',
                'class_mode',
                'day_read_time',
                'month_read_time', 'pay_mode', 'rssi', 'snr', 'day_consumption', 'month_consumption'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('realtime_data', function (Blueprint $table) {
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
        });
    }
};
