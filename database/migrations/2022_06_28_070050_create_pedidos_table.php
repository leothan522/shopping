<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique()->nullable();
            $table->date('fecha');
            $table->decimal('precio_dolar', 12, 2);
            $table->decimal('subtotal', 12, 2)->nullable();
            $table->decimal('iva', 12, 2)->nullable();
            $table->decimal('delivery', 12, 2)->nullable();
            $table->decimal('total', 12, 2)->nullable();
            $table->decimal('bs', 12, 2)->nullable();
            $table->bigInteger('users_id')->unsigned();
            $table->integer('estatus')->default(0);
            $table->foreign('users_id')->references('id')->on('users')->cascadeOnDelete();
            $table->softDeletes();
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
        Schema::dropIfExists('pedidos');
    }
}
