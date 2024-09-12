<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('gtin')->nullable();
            $table->integer('stock_quantity');
            $table->integer('seller_identifier')->unique();
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('seller_id');
            $table->decimal('cost_price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->string('weight_unit_of_measure')->default('oz');
            $table->string('dimension_unit_of_measure')->default('oz');
            $table->decimal('weight', 8, 2)->nullable();
            $table->json('dimensions')->nullable(); // Array [l,w,h]
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parts');
    }
};
