<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('idProducto');
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->integer('cantidad')->default(0);
            $table->boolean('estatus')->default(1); // 1 activo, 0 inactivo
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
