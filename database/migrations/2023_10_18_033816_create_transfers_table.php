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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();

            $table->enum('transaction_type', ['supplier_to_factory', 'factory_to_branch']);

            // Origen de la transacción (puede ser un proveedor o una sucursal)
            //$table->unsignedBigInteger('from_id')->nullable();
            $table->foreignId('supplier_id')->constrained()->nullable();

            // Destino de la transacción (siempre será una sucursal o la fábrica)
            //$table->unsignedBigInteger('to_branch_id')->nullable();
            $table->foreignId('branch_id')->constrained()->nullable();

            //$table->unsignedBigInteger('product_id');
            $table->foreignId('product_id')->constrained();
            
            $table->integer('quantity');
            //$table->unsignedBigInteger('user_id'); // repartidor o empleado encargado de la transacción
            $table->foreignId('user_id')->constrained();

            $table->timestamps();

            /* Establecer relaciones
            $table->foreign('from_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('to_branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
            */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
