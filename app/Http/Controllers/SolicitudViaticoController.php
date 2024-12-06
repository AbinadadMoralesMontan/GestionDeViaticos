<?php

namespace App\Http\Controllers;

use App\Models\SolicitudViatico;
use App\Models\SolicitudComision;
use App\Models\AprobacionFiscalizacion;
use App\Models\AprobacionTesoreria;
use App\Models\ComprobanteEntregado;

use Illuminate\Http\Request;

class SolicitudViaticoController extends Controller
{
    public function index(){
        $viaticos = SolicitudViatico::with('solicitudComision')->paginate(10);
        return view('solicitudes_viaticos.index', compact('viaticos'));
    }

    public function create(){
        $comisiones = SolicitudComision::all(); // Cargar comisiones para asociar
        return view('solicitudes_viaticos.create', compact('comisiones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'solicitud_comision_id' => 'required|exists:solicitudes_comision,id',
            'monto_solicitado' => 'required|numeric|min:0',
            'descripcion' => 'required|string|max:255',
            'estado' => 'required|in:Pendiente,Aprobada,Rechazada',
            'tipo' => 'required|in:Devengada,Anticipada',
        ]);

        // Crear la solicitud de viático
        $viatico = SolicitudViatico::create($request->all());

        // Insertar en aprobaciones_fiscalizacion
        AprobacionFiscalizacion::create([
            'solicitud_viatico_id' => $viatico->id,
            'estado' => 'Pendiente',
            'fiscalizador_id' => null, // Será asignado posteriormente
        ]);

        // Insertar en aprobaciones_tesoreria
        AprobacionTesoreria::create([
            'solicitud_viaticos_id' => $viatico->id,
            'estado' => 'Pendiente',
            'monto_aprobado' => null, // Será asignado posteriormente
        ]);

        // Insertar un comprobante vacío inicial (opcional)
        ComprobanteEntregado::create([
            'solicitud_viaticos_id' => $viatico->id,
            'categoria_gasto' => 'Sin Categoría', // Predeterminado
            'nombre_archivo' => null, // Se asignará posteriormente
            'tipo_archivo' => null, // Se asignará posteriormente
            'contenido' => null, // Se asignará posteriormente
            'observaciones' => null, // Opcional
        ]);

        return redirect()->route('solicitudes_viaticos.index')->with('success', 'Solicitud de viáticos creada exitosamente.');
    }



    public function edit(SolicitudViatico $viatico)
    {
        $comisiones = SolicitudComision::all();
        return view('solicitudes_viaticos.edit', compact('viatico', 'comisiones'));
    }

    public function update(Request $request, SolicitudViatico $viatico)
    {
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

    public function destroy(SolicitudViatico $viatico)
    {
        $viatico->delete();
        return redirect()->route('solicitudes_viaticos.index')->with('success', 'Solicitud de Viático eliminada exitosamente.');
    }
}