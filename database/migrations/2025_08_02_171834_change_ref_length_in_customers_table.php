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
        Schema::table('customers', function (Blueprint $table) {
            $table->dropUnique(['ref']);               // Step 1: Drop unique index
            $table->string('ref', 20)->change();       // Step 2: Change length
            $table->unique('ref');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropUnique(['ref']);               // Drop 20-char unique index
            $table->string('ref', 6)->change();        // Change back to 6
            $table->unique('ref');
        });
    }
};
