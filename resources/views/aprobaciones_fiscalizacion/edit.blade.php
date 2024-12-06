@extends('layouts.app')

@section('title', 'Editar Aprobación Fiscalización')

@section('content')
<div class="form-container">
    <h1>Editar Aprobación Fiscalización</h1>
    <form action="{{ route('aprobaciones_fiscalizacion.update', $aprobacion->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Estado -->
        <label for="estado">Estado:</label>
        <select id="estado" name="estado" class="form-control" required>
            <option value="Pendiente" {{ $aprobacion->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="Aprobada" {{ $aprobacion->estado == 'Aprobada' ? 'selected' : '' }}>Aprobada</option>
            <option value="Rechazada" {{ $aprobacion->estado == 'Rechazada' ? 'selected' : '' }}>Rechazada</option>
        </select>

        <!-- Observaciones -->
        <label for="observaciones">Observaciones:</label>
        <textarea id="observaciones" name="observaciones" class="form-control" placeholder="Agregue observaciones">{{ $aprobacion->observaciones }}</textarea>

        <!-- Botón Guardar -->
        <button type="submit" class="btn btn-primary btn-block">Guardar Cambios</button>
    </form>
</div>
@endsection