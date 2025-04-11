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
        Schema::create('households', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('name');
            $table->integer('household_number')->nullable()->unique();
            $table->integer('area_id')->nullable();
            $table->string('phone', 10);
            $table->string('address');
            $table->string('serial_number')->nullable();
            $table->integer('fee')->unsigned()->nullable();
            $table->integer('warn_money')->unsigned()->nullable();
            $table->foreignUlid('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('password')->nullable();
            $table->enum('status', ['Pending', 'Completed'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('households');
    }
};
