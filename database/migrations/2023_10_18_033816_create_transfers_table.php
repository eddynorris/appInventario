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

            $table->boolean('transaction_type')->default(false);

            $table->string('from_id');
            $table->foreignId('branch_id')->constrained();

            //$table->unsignedBigInteger('product_id');
            $table->foreignId('product_id')->constrained();
            
            $table->integer('quantity');
            //$table->unsignedBigInteger('user_id'); // repartidor o empleado encargado de la transacción
            $table->foreignId('user_id')->constrained();

            $table->timestamps();
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
