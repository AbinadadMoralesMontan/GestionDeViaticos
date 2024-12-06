<?php

namespace App\Http\Controllers;

use App\Models\AprobacionFiscalizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AprobacionFiscalizacionController extends Controller
{
    public function index(){
        $aprobaciones = AprobacionFiscalizacion::with('fiscalizador')->paginate(10);
        return view('aprobaciones_fiscalizacion.index', compact('aprobaciones'));
    }

    public function edit($id)
    {
        $aprobacion = AprobacionFiscalizacion::findOrFail($id);
        return view('aprobaciones_fiscalizacion.edit', compact('aprobacion'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:Pendiente,Aprobada,Rechazada',
            'observaciones' => 'nullable|string|max:255',
        ]);

        $aprobacion = AprobacionFiscalizacion::findOrFail($id);
        $aprobacion->update([
            'estado' => $request->estado,
            'observaciones' => $request->observaciones,
            'fiscalizador_id' => Auth::id(),
        ]);

        return redirect()->route('aprobaciones_fiscalizacion.index')->with('success', 'Aprobación actualizada exitosamente.');
    }
}