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
            $table->decimal('subtotal', 12, 2);
            $table->decimal('iva', 12, 2);
            $table->decimal('delivery', 12, 2);
            $table->decimal('total', 12, 2);
            $table->decimal('bs', 12, 2);
            $table->bigInteger('users_id')->unsigned();
            $table->bigInteger('deliverys_id')->unsigned()->nullable();
            $table->foreign('users_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('deliverys_id')->references('id')->on('deliverys')->nullOnDelete();
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
