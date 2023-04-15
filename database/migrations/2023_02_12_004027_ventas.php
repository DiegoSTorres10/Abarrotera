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
        Schema::create('ventas', function (Blueprint $table){
            $table->increments('id_venta');

            $table->integer('id_vendedor')->unsigned();
            $table->foreign('id_vendedor')->references('id_vendedor')->on('vendedors');

            $table->integer('id_cliente')->unsigned();
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes');

            $table->date('fecha');
            $table->double('monto_pagar');

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
        Schema::drop('venta');
    }
};