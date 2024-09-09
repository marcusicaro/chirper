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
        Schema::dropIfExists('flights');
        Schema::create('flights', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('destination');
            $table->string('departure');
            $table->decimal('price', 8, 2)->default(0);
            $table->decimal('discount', 8, 2)->default(0);
            $table->json('options')->nullable();
            $table->timestamp('arrived_at')->nullable();
            $table->foreignId('destination_id')->constrained()->nullable();
            $table->boolean('delayed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
