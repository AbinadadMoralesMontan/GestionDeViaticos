<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AprobacionFiscalizacion extends Model
{
    use HasFactory;

    protected $table = 'aprobaciones_fiscalizacion';

    protected $fillable = [
        'solicitud_viatico_id',
        'fiscalizador_id',
        'estado',
        'observaciones',
    ];

    public function solicitudViatico(){
        return $this->belongsTo(SolicitudViatico::class, 'solicitud_viatico_id');
    }

    public function fiscalizador(){
        return $this->belongsTo(Usuario::class, 'fiscalizador_id');
    }

}