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
        Schema::create('customers', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('ref', 20)->unique();
            $table->string('imei', length: 24)->unique()->index();
            $table->string('phone')->unique();
            $table->string('email')->nullable();
            $table->foreignUlid('region_id')->constrained();
            $table->foreignUlid('district_id')->constrained();
            $table->string('street');
            $table->boolean('is_active')->default(1);
            $table->boolean('is_assigned')->default(0);
            $table->foreignUlid('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
