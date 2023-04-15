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
        Schema::create('vendedores', function (Blueprint $table){
            $table->increments('id_vendedor');
            $table->string('nombre', 50);
            $table->string('apellido_p', 50);
            $table->string('apellido_m', 50);
            $table->string('domicilio', 100);
            $table->string('ciudad', 100);

            $table->integer('id_estado')->unsigned();
            $table->foreign('id_estado')->references('id_estado')->on('estados');
            $table->string('curp', 18);
            $table->date('fecha_nacimiento');
            $table->string('sexo', 15);

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
        Schema::drop('vendedor');
    }
};
