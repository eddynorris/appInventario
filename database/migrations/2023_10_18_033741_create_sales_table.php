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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('branch_id');
            //$table->unsignedBigInteger('user_id'); // empleado que realizó la venta
            //$table->foreignId('branch_id')->constrained();
            $table->foreignId('user_id')->constrained();
            
            $table->string('document')->nullable();
            $table->string('client')->nullable();
            $table->text('address')->nullable();
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->decimal('total_weight', 10, 2)->default(0);
            $table->integer('duration');
            $table->timestamps();
            

            //$table->foreign('branch_id')->references('id')->on('branches');
            //$table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
