@extends('layouts.app')

@section('title', 'Aprobaciones Fiscalización')

@section('content')
<div class="dashboard-container">
    <h1>Aprobaciones Fiscalización</h1>

    @if ($aprobaciones->isEmpty())
        <p>No hay registros disponibles.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Solicitud Viático ID</th>
                    <th>Estado</th>
                    <th>Usuario</th>
                    <th>Observaciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($aprobaciones as $aprobacion)
                    <tr>
                        <td>{{ $aprobacion->solicitud_viatico_id }}</td>
                        <td>{{ $aprobacion->estado }}</td>

                        <td>
                            @if ($aprobacion->fiscalizador)
                                {{ $aprobacion->fiscalizador->nombre }} 
                                {{ $aprobacion->fiscalizador->apellido_paterno }} 
                                {{ $aprobacion->fiscalizador->apellido_materno }}
                            @else
                                Sin Asignar
                            @endif
                        </td>
                        

                        <td>{{ $aprobacion->observaciones }}</td>
                        <td>
                            <a href="{{ route('aprobaciones_fiscalizacion.edit', $aprobacion->id) }}" class="action-button">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $aprobaciones->links() }}
    @endif
</div>
@endsection