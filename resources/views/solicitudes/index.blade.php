@extends('layouts.app')

@section('title', 'Solicitudes de Comisión')

@section('content')
<div class="dashboard-container">
    <h1>Mis Solicitudes de Salida de Comisión</h1>

    <a href="{{ route('solicitudes.create') }}" class="action-button">Registrar Solicitud</a>

    @if ($solicitudes->isEmpty())
        <p>No tienes solicitudes registradas en este momento.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Fecha de Solicitud</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Fin</th>
                    <th>Motivo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($solicitudes as $solicitud)
                    <tr>
                        <td>{{ $solicitud->fecha_solicitud }}</td>
                        <td>{{ $solicitud->fecha_inicio }}</td>
                        <td>{{ $solicitud->fecha_fin }}</td>
                        <td>{{ $solicitud->motivo }}</td>
                        <td>{{ $solicitud->estado }}</td>
                        <td>
                            <a href="{{ route('solicitudes.show', $solicitud->id) }}" class="action-button">Ver</a>
                            <a href="{{ route('solicitudes.edit', $solicitud->id) }}" class="action-button">Modificar</a>
                            <form action="{{ route('solicitudes.destroy', $solicitud->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-button delete">Eliminar</button>
                            </form>
                        </td>


                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $solicitudes->links() }}
    @endif
</div>
@endsection
