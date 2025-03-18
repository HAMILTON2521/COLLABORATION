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
        Schema::create('contact_us', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('first_name', 32);
            $table->string('last_name', 32);
            $table->string('phone', 10);
            $table->string('email')->nullable();
            $table->string('subject');
            $table->text('message')->nullable();
            $table->enum('status', ['New', 'Processed'])->default('New');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_us');
    }
};
