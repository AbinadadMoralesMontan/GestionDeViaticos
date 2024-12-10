<?php

namespace App\Http\Controllers;

use App\Models\SolicitudComision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitudComisionController extends Controller
{
    public function index(){
        if (auth()->user()->rol->nombre === 'Rectoria') {
            $solicitudes = SolicitudComision::where('estado', 'Pendiente')->paginate(10);
        } else {
            $solicitudes = SolicitudComision::where('responsable_id', Auth::id())->paginate(10);
        }

        return view('solicitudes.index', compact('solicitudes'));
    }


    public function create(){
        return view('solicitudes.create');
    }

    public function store(Request $request){
        $request->validate([
            'fecha_inicio' => 'required|date|after_or_equal:fecha_solicitud',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'motivo' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'monto_hospedaje' => 'nullable|numeric|min:0',
            'monto_transporte' => 'nullable|numeric|min:0',
            'monto_alimentacion' => 'nullable|numeric|min:0',
            'monto_inscripcion' => 'nullable|numeric|min:0',
            'monto_otros' => 'nullable|numeric|min:0',
            'observaciones' => 'nullable|string',
        ]);

        SolicitudComision::create([
            'responsable_id' => Auth::id(),
            'fecha_solicitud' => now(),
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'motivo' => $request->motivo,
            'destino' => $request->destino,
            'monto_hospedaje' => $request->monto_hospedaje,
            'monto_transporte' => $request->monto_transporte,
            'monto_alimentacion' => $request->monto_alimentacion,
            'monto_inscripcion' => $request->monto_inscripcion,
            'monto_otros' => $request->monto_otros,
            'estado' => 'Pendiente', // Por defecto
            'observaciones' => $request->observaciones,
        ]);

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud creada exitosamente.');
    }

    public function show(SolicitudComision $solicitud){
        return view('solicitudes.show', compact('solicitud'));
    }

    public function edit($id){
        $solicitud = SolicitudComision::find($id);

        if (!$solicitud) {
            abort(404, 'Solicitud no encontrada');
        }

        return view('solicitudes.edit', compact('solicitud'));
    }


    public function update(Request $request, $id)
    {
        $solicitud = SolicitudComision::find($id);

        if (!$solicitud) {
            abort(404, 'Solicitud no encontrada');
        }

        $request->validate([
            'fecha_inicio' => 'required|date|after_or_equal:fecha_solicitud',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'motivo' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'monto_hospedaje' => 'nullable|numeric|min:0',
            'monto_transporte' => 'nullable|numeric|min:0',
            'monto_alimentacion' => 'nullable|numeric|min:0',
            'monto_inscripcion' => 'nullable|numeric|min:0',
            'monto_otros' => 'nullable|numeric|min:0',
            'observaciones' => 'nullable|string',
        ]);

        $data = $request->only([
            'fecha_inicio',
            'fecha_fin',
            'motivo',
            'destino',
            'monto_hospedaje',
            'monto_transporte',
            'monto_alimentacion',
            'monto_inscripcion',
            'monto_otros',
            'observaciones',
        ]);

        if (auth()->user()->rol->nombre === 'Rectoria' && $request->has('estado')) {
            $data['estado'] = $request->estado;
        }

        $solicitud->update($data);

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud actualizada exitosamente.');
    }

    public function destroy($id){
        $solicitud = SolicitudComision::find($id);

        if (!$solicitud) {
            abort(404, 'Solicitud no encontrada');
        }

        $solicitud->delete();

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud eliminada exitosamente.');
    }

}
