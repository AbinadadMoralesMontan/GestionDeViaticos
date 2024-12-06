<?php

namespace App\Http\Controllers;

use App\Models\AprobacionTesoreria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AprobacionTesoreriaController extends Controller
{
    public function index(){
        $aprobaciones = AprobacionTesoreria::with('tesorero')->paginate(10);
        return view('aprobaciones_tesoreria.index', compact('aprobaciones'));
    }

    public function edit($id){
        $aprobacion = AprobacionTesoreria::findOrFail($id);
        return view('aprobaciones_tesoreria.edit', compact('aprobacion'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'estado' => 'required|in:Pendiente,Pagado',
            'monto_aprobado' => 'nullable|numeric|min:0',
            'observaciones' => 'nullable|string|max:255',
        ]);

        $aprobacion = AprobacionTesoreria::findOrFail($id);
        $aprobacion->update([
            'estado' => $request->estado,
            'monto_aprobado' => $request->monto_aprobado,
            'observaciones' => $request->observaciones,
            'tesorero_id' => Auth::id(),
        ]);

        return redirect()->route('aprobaciones_tesoreria.index')->with('success', 'Aprobación actualizada exitosamente.');
    }
}