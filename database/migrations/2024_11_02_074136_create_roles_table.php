<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id_usuario');
            $table->string('nombre', 100);
            $table->string('correo', 50)->unique();
            $table->string('contrasena', 255); // Usaremos bcrypt, así que aumenta el tamaño
            $table->unsignedInteger('id_rol');
            $table->boolean('estatus')->default(1); // 1 activo, 0 inactivo
            $table->rememberToken();
            $table->timestamps();

            // Clave foránea
            $table->foreign('id_rol')->references('id_rol')->on('roles');
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};
