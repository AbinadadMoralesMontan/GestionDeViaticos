<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Movimiento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;


class MovimientoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Mostrar el historial de movimientos
    public function index(Request $request)
    {
        // Solo Rectoria puede ver el historial
        if (Auth::user()->id_rol != 1) {
            return redirect()->route('dashboard')->with('error', 'No tienes permiso para acceder al historial.');
        }

        $tipo = $request->tipo;

        $movimientos = Movimiento::with(['producto', 'usuario'])
            ->when($tipo, function($query, $tipo) {
                return $query->where('tipo', $tipo);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('movimientos.historial', compact('movimientos', 'tipo'));
    }

    // Mostrar formulario para salida de productos
    public function crearSalida()
    {
        // Solo Almacenista puede acceder
        if (Auth::user()->id_rol != 2) {
            return redirect()->route('dashboard')->with('error', 'No tienes permiso para realizar salidas.');
        }

        $productos = Producto::where('estatus', 1)->get();
        return view('movimientos.crear_salida', compact('productos'));
    }

    // Guardar salida de productos
    public function guardarSalida(Request $request)
    {
        // Solo Almacenista puede realizar
        if (Auth::user()->id_rol != 2) {
            return redirect()->route('dashboard')->with('error', 'No tienes permiso para realizar salidas.');
        }

        $request->validate([
            'idProducto' => 'required|exists:productos,idProducto',
            'cantidad' => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($request->idProducto);

        if ($producto->cantidad < $request->cantidad) {
            return back()->withErrors(['cantidad' => 'No puedes sacar una cantidad mayor a la existente en inventario.']);
        }

        // Actualizar cantidad
        $producto->cantidad -= $request->cantidad;
        $producto->save();

        // Registrar movimiento
        Movimiento::create([
            'idProducto' => $producto->idProducto,
            'id_usuario' => Auth::user()->id_usuario,
            'tipo' => 'salida',
            'cantidad' => $request->cantidad,
        ]);

        return redirect()->route('productos.index')->with('success', 'Salida de producto registrada exitosamente.');
    }
}
