<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarritoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrito', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('users_id')->unsigned();
            $table->bigInteger('stock_id')->unsigned();
            $table->decimal('cantidad', 12, 2);
            $table->integer('estatus')->default(0);
            $table->foreign('users_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('stock_id')->references('id')->on('stock')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carrito');
    }
}
