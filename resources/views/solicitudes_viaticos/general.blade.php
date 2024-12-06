@extends('layouts.app')

@section('title', 'Todas las Solicitudes de Viáticos')

@section('content')
<div class="dashboard-container">
    <h1>Solicitudes de Viáticos</h1>

    @if ($solicitudesViaticos->isEmpty())
        <p>No hay solicitudes de viáticos registradas.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Monto Solicitado</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th>Comisión Asociada</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($solicitudesViaticos as $viatico)
                    <tr>
                        <td>{{ $viatico->descripcion }}</td>
                        <td>${{ number_format($viatico->monto_solicitado, 2) }}</td>
                        <td>{{ $viatico->tipo }}</td>
                        <td>{{ $viatico->estado }}</td>
                        <td>{{ $viatico->solicitudComision->motivo ?? 'Sin Comisión Asociada' }}</td>
                        <td>
                            <a href="{{ route('solicitudes_viaticos.edit', [$viatico->solicitud_comision_id, $viatico->id]) }}" class="action-button">Editar</a>
                            <form action="{{ route('solicitudes_viaticos.destroy', [$viatico->solicitud_comision_id, $viatico->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-button delete">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection