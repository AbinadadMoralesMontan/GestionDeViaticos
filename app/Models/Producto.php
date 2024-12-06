<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $primaryKey = 'idProducto';
    protected $table = 'productos';
    protected $fillable = [
        'nombre',
        'descripcion',
        'cantidad',
        'estatus',
    ];

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class, 'idProducto');
    }
}