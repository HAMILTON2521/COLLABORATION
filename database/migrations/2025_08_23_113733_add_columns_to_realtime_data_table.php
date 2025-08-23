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
            $table->string('remaining_flow')->after('day_consumption')->nullable();
            $table->string('latitude')->after('remaining_flow')->nullable();
            $table->string('longitude')->after('latitude')->nullable();
            $table->string('customer_name')->after('longitude')->nullable();
            $table->string('customer_address')->after('customer_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('realtime_data', function (Blueprint $table) {
            $table->dropColumn('remaining_flow');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
            $table->dropColumn('customer_name');
            $table->dropColumn('customer_address');
        });
    }
};
