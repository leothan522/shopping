<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAjustesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ajustes', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->bigInteger('empresas_id')->unsigned();
            $table->bigInteger('stock_id')->unsigned();
            $table->decimal('cantidad', 12, 2);
            $table->integer('band')->default(0);
            $table->foreign('empresas_id')->references('id')->on('empresas')->cascadeOnDelete();
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
        Schema::dropIfExists('ajustes');
    }
}
