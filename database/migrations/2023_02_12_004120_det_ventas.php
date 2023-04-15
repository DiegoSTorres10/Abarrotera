<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det_ventas', function (Blueprint $table){
            $table->increments('id_detventas');

            $table->integer('id_venta')->unsigned();
            $table->foreign('id_venta')->references('id_venta')->on('venta');

            $table->integer('id_producto')->unsigned();
            $table->foreign('id_producto')->references('id_producto')->on('productos');

            $table->integer('cantidad')->unsigned();
            $table->double('costo');

            $table->rememberToken();
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
        Schema::drop('det_ventas');
    }
};
