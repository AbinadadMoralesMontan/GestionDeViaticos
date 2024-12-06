<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $primaryKey = 'idMovimiento';
    protected $table = 'movimientos';
    protected $fillable = [
        'idProducto',
        'idUsuario',
        'tipo',
        'cantidad',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idProducto');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario');
    }
}