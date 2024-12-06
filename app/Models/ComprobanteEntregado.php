<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComprobanteEntregado extends Model
{
    use HasFactory;

    protected $table = 'comprobantes_entregados';

    protected $fillable = [
        'solicitud_viaticos_id',
        'categoria_gasto',
        'nombre_archivo',
        'tipo_archivo',
        'contenido',
        'observaciones',
    ];

    public $timestamps = false;

}