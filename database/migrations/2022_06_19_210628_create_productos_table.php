<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->bigInteger('categorias_id')->unsigned();
            $table->string('sku')->nullable();
            $table->text('imagen')->nullable();
            $table->text('miniatura')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('referencia')->nullable();
            $table->string('unidad')->nullable();
            $table->integer('decimales')->default(0);
            $table->integer('impuesto')->default(1);
            $table->integer('individual')->default(0);
            $table->integer('estatus')->default(1);
            $table->foreign('categorias_id')->references('id')->on('categorias')->cascadeOnDelete();
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
        Schema::dropIfExists('productos');
    }
}
