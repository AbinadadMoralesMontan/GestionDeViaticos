<?php

namespace App\Http\Controllers;

use App\Models\SolicitudComision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitudComisionController extends Controller
{
    public function index(){
        if (auth()->user()->rol->nombre === 'Administrador') {
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
            'fecha_solicitud' => 'required|date',
            'fecha_salida' => 'required|date|after_or_equal:fecha_solicitud',
            'fecha_regreso' => 'required|date|after_or_equal:fecha_salida',
            'motivo' => 'required|string|max:255',
            'observaciones' => 'nullable|string',
        ]);

        SolicitudComision::create([
            'responsable_id' => Auth::id(),
            'fecha_solicitud' => $request->fecha_solicitud,
            'fecha_salida' => $request->fecha_salida,
            'fecha_regreso' => $request->fecha_regreso,
            'motivo' => $request->motivo,
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
            'fecha_solicitud' => 'required|date',
            'fecha_salida' => 'required|date|after_or_equal:fecha_solicitud',
            'fecha_regreso' => 'required|date|after_or_equal:fecha_salida',
            'motivo' => 'required|string|max:255',
            'observaciones' => 'nullable|string',
        ]);
    
        $data = $request->only([
            'fecha_solicitud',
            'fecha_salida',
            'fecha_regreso',
            'motivo',
            'observaciones',
        ]);
    
        if (auth()->user()->rol->nombre === 'Administrador' && $request->has('estado')) {
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