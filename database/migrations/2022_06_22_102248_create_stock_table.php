<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('empresas_id')->unsigned();
            $table->bigInteger('productos_id')->unsigned();
            $table->bigInteger('almacenes_id')->unsigned();
            $table->decimal('pvp', 12, 2);
            $table->string('moneda');
            $table->decimal('stock_disponible', 12, 2)->nullable();
            $table->decimal('stock_comprometido', 12, 2)->nullable();
            $table->decimal('stock_vendido', 12, 2)->nullable();
            $table->integer('estatus')->default(0);
            $table->integer('oferta')->default(0);
            $table->decimal('descuento', 12,2)->nullable();
            $table->foreign('empresas_id')->references('id')->on('empresas')->cascadeOnDelete();
            $table->foreign('productos_id')->references('id')->on('productos')->cascadeOnDelete();
            $table->foreign('almacenes_id')->references('id')->on('almacenes')->cascadeOnDelete();
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
        Schema::dropIfExists('stock');
    }
}
