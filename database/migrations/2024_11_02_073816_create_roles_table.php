<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(){
        Schema::create('roles', function (Blueprint $table) {
            $table->unsignedInteger('id_rol')->autoIncrement();
            $table->string('nombre', 50);
            $table->timestamps();
        });

        // Insertar roles por defecto
        DB::table('roles')->insert([
            ['id_rol' => 1, 'nombre' => 'rectoria', 'created_at' => now(), 'updated_at' => now()],
            ['id_rol' => 2, 'nombre' => 'Almacenista', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(){
        Schema::dropIfExists('roles');
    }
};
