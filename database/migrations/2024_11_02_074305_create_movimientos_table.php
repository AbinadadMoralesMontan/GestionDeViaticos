<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->increments('idMovimiento');
            $table->unsignedInteger('idProducto');
            $table->unsignedInteger('id_usuario');
            $table->enum('tipo', ['entrada', 'salida']);
            $table->integer('cantidad');
            $table->timestamps();

            // Claves foráneas
            $table->foreign('idProducto')->references('idProducto')->on('productos');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios');
        });
    }

    public function down()
    {
        Schema::dropIfExists('movimientos');
    }
};
