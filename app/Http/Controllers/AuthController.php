<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function mostrarFormularioLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'contrasena' => 'required',
        ]);

        $credentials = [
            'correo' => $request->correo,
            'contrasena' => $request->contrasena,
            'estatus' => 1,
        ];

        // Intentar autenticar
        $user = Usuario::where('correo', $request->correo)->first();

        if ($user && Hash::check($request->contrasena, $user->contrasena) && $user->estatus == 1) {
            Auth::login($user);
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'correo' => 'Las credenciales proporcionadas no son correctas o el usuario está inactivo.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}