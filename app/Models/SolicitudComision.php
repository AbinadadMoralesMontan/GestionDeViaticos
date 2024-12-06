<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudComision extends Model
{
    use HasFactory;

    protected $table = 'solicitudes_comision';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'responsable_id',
        'fecha_solicitud',
        'fecha_salida',
        'fecha_regreso',
        'motivo',
        'estado',
        'observaciones',
    ];

    public function responsable(){
        return $this->belongsTo(Usuario::class, 'responsable_id', 'idUsuario');
    }

    public function solicitudesViaticos(){
        return $this->hasMany(SolicitudViatico::class, 'solicitud_comision_id');
    }


    public function usuario(){
        return $this->belongsTo(Usuario::class, 'responsable_id');
    }

}
