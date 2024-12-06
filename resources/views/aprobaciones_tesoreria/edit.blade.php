@extends('layouts.app')

@section('title', 'Editar Aprobación Tesorería')

@section('content')
<div class="form-container">
    <h1>Editar Aprobación Tesorería</h1>
    <form action="{{ route('aprobaciones_tesoreria.update', $aprobacion->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Estado -->
        <label for="estado">Estado:</label>
        <select id="estado" name="estado" class="form-control" required>
            <option value="Pendiente" {{ $aprobacion->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="Pagado" {{ $aprobacion->estado == 'Pagado' ? 'selected' : '' }}>Pagado</option>
        </select>

        <!-- Monto Aprobado -->
        <label for="monto_aprobado">Monto Aprobado:</label>
        <input type="number" id="monto_aprobado" name="monto_aprobado" class="form-control" min="0" step="0.01" value="{{ $aprobacion->monto_aprobado }}">

        <!-- Observaciones -->
        <label for="observaciones">Observaciones:</label>
        <textarea id="observaciones" name="observaciones" class="form-control" placeholder="Agregue observaciones">{{ $aprobacion->observaciones }}</textarea>

        <!-- Botón Guardar -->
        <button type="submit" class="btn btn-primary btn-block">Guardar Cambios</button>
    </form>
</div>
@endsection