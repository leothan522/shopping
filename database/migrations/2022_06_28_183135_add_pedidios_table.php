<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPedidiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->string('cedula')->nullable()->after('estatus');
            $table->string('nombre')->nullable()->after('cedula');
            $table->string('telefono')->nullable()->after('nombre');
            $table->text('direccion_1')->nullable()->after('telefono');
            $table->text('direccion_2')->nullable()->after('direccion_1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            //
        });
    }
}
