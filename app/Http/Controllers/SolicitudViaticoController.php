<?php

namespace App\Http\Controllers;

use App\Models\SolicitudViatico;
use App\Models\SolicitudComision;
use App\Models\AprobacionFiscalizacion;
use App\Models\AprobacionTesoreria;
use App\Models\ComprobanteEntregado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitudViaticoController extends Controller{

    public function index(){
        $user = auth()->user();

        if ($user->rol->nombre === 'Rectoria') {
            $viaticos = SolicitudViatico::with('solicitudComision')
                ->where('estado', 'Pendiente')
                ->paginate(10);
        } else {
            $viaticos = SolicitudViatico::with('solicitudComision')
                ->whereHas('solicitudComision', function ($query) use ($user) {
                    $query->where('responsable_id',  Auth::id());
                })
                ->paginate(10);
        }

        return view('solicitudes_viaticos.index', compact('viaticos'));
    }



    public function create(){
        $user = auth()->user();

        if ($user->rol->nombre === 'Rectoria') {
            $comisiones = SolicitudComision::select('id', 'fecha_solicitud', 'fecha_inicio', 'fecha_fin', 'motivo', 'destino', 'monto_hospedaje', 'monto_transporte', 'monto_alimentacion', 'monto_inscripcion', 'monto_otros')->get();
        } else {
            $comisionesQuery = SolicitudComision::select('id', 'fecha_solicitud', 'fecha_inicio', 'fecha_fin', 'motivo', 'destino', 'monto_hospedaje', 'monto_transporte', 'monto_alimentacion', 'monto_inscripcion', 'monto_otros')
                ->where('responsable_id', Auth::id());

            $comisiones = $comisionesQuery->get();
        }

        return view('solicitudes_viaticos.create', compact('comisiones'));
    }

    public function store(Request $request){
        $request->validate([
            'solicitud_comision_id' => 'required|exists:solicitudes_comision,id',
            'monto_solicitado' => 'required|numeric|min:0',
            'descripcion' => 'required|string|max:255',
            'estado' => 'required|in:Pendiente,Aprobada,Rechazada',
            'tipo' => 'required|in:Devengada,Anticipada',
        ]);

        $viatico = SolicitudViatico::create($request->all());

        // Insertar en aprobaciones_fiscalizacion
        AprobacionFiscalizacion::create([
            'solicitud_viatico_id' => $viatico->id,
            'estado' => 'Pendiente',
            'fiscalizador_id' => null,
        ]);

        // Insertar en aprobaciones_tesoreria
        AprobacionTesoreria::create([
            'solicitud_viaticos_id' => $viatico->id,
            'estado' => 'Pendiente',
            'monto_aprobado' => null,
        ]);

        ComprobanteEntregado::create([
            'solicitud_viaticos_id' => $viatico->id,
            'categoria_gasto' => $viatico-> categoria_gasto,
            'monto' => $viatico-> monto,
            'nombre_archivo' => $viatico-> nombre_archivo,
            'tipo_archivo' => $viatico-> tipo_archivo,
            'contenido' => $viatico-> contenido,
            'observaciones' => $viatico-> observaciones,
        ]);

        return redirect()->route('solicitudes_viaticos.index')->with('success', 'Solicitud de viáticos creada exitosamente.');
    }



    public function edit(SolicitudViatico $viatico){
        $user = auth()->user();
        if ($user->rol->nombre === 'Rectoria') {
            $comisiones = SolicitudComision::select('id', 'fecha_solicitud', 'fecha_inicio', 'fecha_fin', 'motivo')
                ->get();
        } else {
            $comisiones = SolicitudComision::select('id', 'fecha_solicitud', 'fecha_inicio', 'fecha_fin', 'motivo')
                ->where('responsable_id', Auth::id())
                ->get();
        }

        return view('solicitudes_viaticos.edit', compact('viatico', 'comisiones'));
    }

    public function update(Request $request, SolicitudViatico $viatico){
        $request->validate([
            'solicitud_comision_id' => 'required|exists:solicitudes_comision,id',
            'monto_solicitado' => 'required|numeric|min:0',
            'descripcion' => 'required|string|max:255',
            'estado' => 'required|in:Pendiente,Aprobada,Rechazada',
            'tipo' => 'required|in:Devengada,Anticipada',
        ]);

        $viatico->update($request->all());
        return redirect()->route('solicitudes_viaticos.index')->with('success', 'Solicitud de Viático actualizada exitosamente.');
    }

    public function destroy(SolicitudViatico $viatico){
        $viatico->delete();
        return redirect()->route('solicitudes_viaticos.index')->with('success', 'Solicitud de Viático eliminada exitosamente.');
    }
}
