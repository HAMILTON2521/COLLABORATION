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
        Schema::create('message_activities', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('activity')->unique();
            $table->string('description')->nullable();
            $table->foreignUlid('message_template_id')->nullable()->constrained('message_templates')->nullOnDelete();
            $table->boolean('send_message')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_activities');
    }
};
