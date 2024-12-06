<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Movimiento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;


class ProductoController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        return view('productos.crear');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
        ]);

        Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'cantidad' => 0, // Cantidad inicial 0
            'estatus' => 1,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.editar', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
        ]);

        $producto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->estatus = $producto->estatus ? 0 : 1; // Alternar estatus
        $producto->save();

        return redirect()->route('productos.index')->with('success', 'Estatus del producto actualizado.');
    }

    /**
     * Mostrar el formulario para agregar inventario.
     */
    public function agregarInventario($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.agregar_inventario', compact('producto'));
    }

    /**
     * Procesar la solicitud para agregar inventario.
     */
    public function guardarInventario(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->cantidad += $request->cantidad;
        $producto->save();


        Movimiento::create([
            'idProducto' => $producto->idProducto,
            'idUsuario' => Auth::id(),
            'cantidad' => $request->cantidad,
            'tipo' => 'entrada',
        ]);

        return redirect()->route('productos.index')->with('success', 'Inventario aumentado exitosamente.');
    }
}