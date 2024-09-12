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
        Schema::create('gtin_numbers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id'); // Multi-tenant association
            $table->string('gtin')->unique(); // Storing GTINs from GS1 DB
            $table->datetime('expires_on')->nullable(); // Storing GTINs from GS1 DB
            $table->enum('status', ['active', 'used', 'expired', 'invalid'])->default('active');
            $table->timestamps();

            $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gtin_numbers');
    }
};
