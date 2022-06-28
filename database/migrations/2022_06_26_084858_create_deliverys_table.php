<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliverysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliverys', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('users_id')->unsigned();
            $table->bigInteger('zonas_id')->unsigned()->nullable();
            $table->integer('estatus')->default(0);
            $table->decimal('precio_dolar')->nullable();
            $table->decimal('precio_delivery')->nullable();
            $table->decimal('bs')->nullable();
            $table->string('nombre')->nullable()->nullable();
            $table->foreign('users_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('zonas_id')->references('id')->on('zonas')->nullOnDelete();
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
        Schema::dropIfExists('deliverys');
    }
}
