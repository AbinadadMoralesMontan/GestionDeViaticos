<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'idUsuario'; 
    protected $table = 'usuarios'; 

    protected $fillable = [
        'nombre',
        'apellido_paterno',  
        'apellido_materno',  
        'banco',             
        'numero_cuenta',     
        'correo',
        'contrasena',
        'idRol',
        'estatus',
        'area',              
    ];

    protected $hidden = [
        'contrasena',
        'remember_token',
    ];

    /**
     * Relación con el modelo Rol
     */
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'idRol');
    }

    /**
     * Relación con el modelo Movimiento
     */
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class, 'idUsuario');
    }
}