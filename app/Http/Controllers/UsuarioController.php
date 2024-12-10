<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::with('rol')
            ->where('id_rol', '<>', 1)
            ->paginate(10); // Trae usuarios con su rol
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Rol::all();
        return view('usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'apellido_paterno' => 'required|max:100',
            'apellido_materno' => 'required|max:100',
            'correo' => 'required|email|unique:usuarios,correo',
            'contrasena' => 'required|min:6',
            'id_rol' => 'required|exists:roles,id_rol',
            'banco' => 'nullable|string|max:100',
            'numero_cuenta' => 'nullable|string|max:50',
            'departamento' => 'required|string|max:50',
            'cargo' => 'required|string|max:50',
        ]);

        Usuario::create([
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'correo' => $request->correo,
            'contrasena' => bcrypt($request->contrasena),
            'id_rol' => $request->id_rol,
            'departamento' => $request->id_rol,
            'cargo' => $request->id_rol,
            'estatus' => 1,
            'banco' => $request->banco ?? 'Sin Banco', // Valor predeterminado
            'numero_cuenta' => $request->numero_cuenta ?? '00000000', // Valor predeterminado
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function edit(Usuario $usuario)
    {
        $roles = Rol::all();
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'apellido_paterno' => 'required|max:100',
            'apellido_materno' => 'required|max:100',
            'cargo' => 'required|max:100',
            'departamento' => 'required|max:100',
            'correo' => 'required|email|unique:usuarios,correo,' . $usuario->id_usuario . ',id_usuario',
            'id_rol' => 'required|exists:roles,id_rol',
        ]);

        $usuario->update([
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'cargo' => $request->cargo,
            'departamento' => $request->departamento,
            'correo' => $request->correo,
            'id_rol' => $request->id_rol,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function activate($id_usuario){
        $usuario = Usuario::findOrFail($id_usuario);
        $usuario->update(['estatus' => 1]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario reactivado exitosamente.');
    }


    public function destroy(Usuario $usuario)
    {
        $usuario->update(['estatus' => 0]);
        return redirect()->route('usuarios.index')->with('success', 'Usuario desactivado exitosamente.');
    }
}
