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
        Schema::create('contractor_signoffs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('work_order_line_item_id');
            $table->unsignedBigInteger('contractor_id');
            $table->unsignedBigInteger('seller_id');

            $table->integer('quantity_signed');
            $table->timestamp('signed_at');
            $table->timestamps();
            $table->foreign('work_order_line_item_id')->references('id')->on('work_order_line_items')->onDelete('cascade');
            $table->foreign('contractor_id')->references('id')->on('contractors')->onDelete('cascade');
            $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contractor_signoffs');
    }
};
