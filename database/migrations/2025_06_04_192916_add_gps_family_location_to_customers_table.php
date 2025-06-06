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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('ward')->after('district_id')->nullable();
            $table->string('house_number')->after('ward')->nullable();
            $table->string('family_size')->after('house_number')->nullable();
            $table->enum('current_energy_source', ['Electricity', 'Firewood', 'Charcoal', 'Gas', 'Mixture'])->after('family_size')->nullable();
            $table->string('occupation')->after('last_name')->nullable();
            $table->smallInteger('cooks_per_day')->after('occupation')->nullable();
            $table->string('alternative_phone_number')->after('phone')->nullable();
            $table->string('latitude')->after('occupation')->nullable();
            $table->string('longitude')->after('latitude')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn([
                'ward',
                'house_number',
                'family_size',
                'current_energy_source',
                'occupation',
                'cooks_per_day',
                'alternative_phone_number',
                'latitude',
                'longitude'
            ]);
        });
    }
};
