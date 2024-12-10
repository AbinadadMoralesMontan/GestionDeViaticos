@extends('layouts.app')

@section('title', 'Comprobantes de Víáticos')

@section('content')
<div class="dashboard-container">
    <h1>Comprobantes de Viáticos</h1>

    <a href="{{ route('comprobantes.create') }}" class="action-button">Entregar Comprobante</a>

    @if ($comprobantes->isEmpty())
        <p>No hay comprobantes entregados registrados.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Categoría de Gasto</th>
                    <th>Observaciones</th>
                    <th>Fecha de Entrega</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comprobantes as $comprobante)
                    <tr>
                        <td>{{ $comprobante->categoria_gasto }}</td>
                        <td>{{ $comprobante->observaciones }}</td>
                        <td>{{ $comprobante->fecha_entrega }}</td>
                        <td>
                            @if ($comprobante->pdf)
                                <a href="{{ route('comprobantes.downloadPdf', $comprobante->id) }}" class="action-button">Descargar PDF</a>
                                <a href="{{ route('comprobantes.viewPdf', $comprobante->id) }}" class="action-button" target="_blank">Visualizar PDF</a>
                            @endif

                            @if ($comprobante->xml)
                                <a href="{{ route('comprobantes.downloadXml', $comprobante->id) }}" class="action-button">Descargar XML</a>
                            @endif

                            <a href="{{ route('comprobantes.edit', $comprobante->id) }}" class="action-button">Modificar</a>
                                <form action="{{ route('comprobantes.destroy', $comprobante->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-button delete">Eliminar</button>
                                </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $comprobantes->links() }}
    @endif
</div>
@endsection
