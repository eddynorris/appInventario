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
        Schema::create('branch_inventory', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('branch_id');
            //$table->unsignedBigInteger('product_id');
            $table->foreignId('branch_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->integer('stock')->default(0);
            $table->timestamps();
        

            //$table->foreign('branch_id')->references('id')->on('branches');
            //$table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_inventory');
    }
};
