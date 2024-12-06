<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AprobacionTesoreria extends Model
{
    use HasFactory;

    protected $table = 'aprobaciones_tesoreria';

    protected $fillable = [
        'solicitud_viaticos_id',
        'tesorero_id',
        'estado',
        'monto_aprobado',
        'observaciones',
    ];

    public function solicitudViatico(){
        return $this->belongsTo(SolicitudViatico::class, 'solicitud_viatico_id');
    }

    public function tesorero(){
        return $this->belongsTo(Usuario::class, 'tesorero_id');
    }

}