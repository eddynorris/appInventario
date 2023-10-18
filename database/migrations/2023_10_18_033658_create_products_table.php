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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('category_id');
            //$table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('supplier_id')->constrained()->nullable();

            $table->string('name');
            $table->text('description')->nullable();
            $table->string('units');
            $table->decimal('measures', 10, 2);
            $table->decimal('price', 10, 2);
            $table->timestamps();
            


            //$table->foreign('category_id')->references('id')->on('categories');
            //$table->foreign('supplier_id')->references('id')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
