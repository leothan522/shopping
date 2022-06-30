<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveryCamposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliverys', function (Blueprint $table) {
            $table->bigInteger('mensajeros_id')->after('pedidos_id')->unsigned()->nullable();
            $table->foreign('mensajeros_id')->references('id')->on('mensajeros')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deliverys', function (Blueprint $table) {
            //
        });
    }
}
