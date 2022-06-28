<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carrito', function (Blueprint $table) {
            $table->bigInteger('pedidos_id')->after('subtotal')->unsigned()->nullable();
            $table->foreign('pedidos_id')->references('id')->on('pedidos')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carrito', function (Blueprint $table) {
            //
        });
    }
}
