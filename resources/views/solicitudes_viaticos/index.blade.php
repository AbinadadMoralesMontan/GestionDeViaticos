@extends('layouts.app')

@section('title', 'Solicitudes de Viáticos')

@section('content')
<div class="dashboard-container">
    <h1>Solicitudes de Viáticos</h1>

    <a href="{{ route('solicitudes_viaticos.create') }}" class="action-button">Nueva Solicitud de Viático</a>

    @if ($viaticos->isEmpty())
        <p>No hay solicitudes de viáticos registradas.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Comisión Asociada</th>
                    <th>Monto Solicitado</th>
                    <th>Estado</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($viaticos as $viatico)
                    <tr>
                        <td>{{ $viatico->solicitudComision->motivo ?? 'Sin Comisión' }}</td>
                        <td>${{ number_format($viatico->monto_solicitado, 2) }}</td>
                        <td>{{ $viatico->estado }}</td>
                        <td>{{ $viatico->tipo }}</td>
                        <td>
                            <a href="{{ route('solicitudes_viaticos.edit', $viatico->id) }}" class="action-button">Editar</a>
                            <form action="{{ route('solicitudes_viaticos.destroy', $viatico->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-button delete">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $viaticos->links() }}
    @endif
</div>
@endsection