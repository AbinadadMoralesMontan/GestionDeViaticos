@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
<div class="dashboard-container">
    <h1>Usuarios</h1>
    <a href="{{ route('usuarios.create') }}" class="dashboard-option">Agregar Usuario</a>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->nombre }}</td>
                <td>{{ $usuario->correo }}</td>
                <td>{{ $usuario->rol->nombre }}</td>
                <td>{{ $usuario->estatus ? 'Activo' : 'Inactivo' }}</td>
                <td>
                    <a href="{{ route('usuarios.edit', $usuario->idUsuario) }}" class="action-button">Editar</a>
                    @if ($usuario->estatus)
                        <form action="{{ route('usuarios.destroy', $usuario->idUsuario) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-button delete">Desactivar</button>
                        </form>
                    @else
                        <form action="{{ route('usuarios.activate', $usuario->idUsuario) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="action-button activate">Reactivar</button>

                        </form>
                    @endif
                </td>
                
                
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $usuarios->links() }}
</div>
@endsection