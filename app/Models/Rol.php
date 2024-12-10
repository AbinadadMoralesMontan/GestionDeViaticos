<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_rol';
    protected $table = 'roles';
    protected $fillable = ['nombre'];

    /**
     * Relación con el modelo Usuario
     */
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'id_rol');
    }
}
