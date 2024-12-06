<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudViatico extends Model
{
    use HasFactory;

    protected $table = 'solicitudes_viaticos';

    protected $fillable = [
        'solicitud_comision_id',
        'monto_solicitado',
        'descripcion',
        'estado',
        'tipo',
    ];



    public function solicitudComision()
{
    return $this->belongsTo(SolicitudComision::class, 'solicitud_comision_id');
}

}
