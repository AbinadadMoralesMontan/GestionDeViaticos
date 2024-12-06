<div class="form-container">
    <h1>{{ isset($solicitud) ? 'Editar Solicitud de Comisión' : 'Nueva Solicitud de Comisión' }}</h1>
    <form action="{{ isset($solicitud) ? route('solicitudes.update', $solicitud) : route('solicitudes.store') }}" method="POST">
        @csrf
        @if (isset($solicitud))
            @method('PUT')
        @endif

        <!-- Fecha de Solicitud -->
        <label for="fecha_solicitud">Fecha de Solicitud:</label>
        <input type="date" id="fecha_solicitud" name="fecha_solicitud" class="form-control" required value="{{ old('fecha_solicitud', $solicitud->fecha_solicitud ?? '') }}">

        <!-- Fecha de Salida -->
        <label for="fecha_salida">Fecha de Salida:</label>
        <input type="date" id="fecha_salida" name="fecha_salida" class="form-control" required value="{{ old('fecha_salida', $solicitud->fecha_salida ?? '') }}">

        <!-- Fecha de Regreso -->
        <label for="fecha_regreso">Fecha de Regreso:</label>
        <input type="date" id="fecha_regreso" name="fecha_regreso" class="form-control" required value="{{ old('fecha_regreso', $solicitud->fecha_regreso ?? '') }}">

        <!-- Motivo -->
        <label for="motivo">Motivo:</label>
        <input type="text" id="motivo" name="motivo" class="form-control" required value="{{ old('motivo', $solicitud->motivo ?? '') }}" placeholder="Describa el motivo de la comisión">

        <!-- Observaciones -->
        <label for="observaciones">Observaciones:</label>
        <textarea id="observaciones" name="observaciones" class="form-control" placeholder="Ingrese observaciones adicionales">{{ old('observaciones', $solicitud->observaciones ?? '') }}</textarea>

        <!-- Estado (Solo para Administradores y en modo edición) -->
        @if (isset($solicitud) && auth()->user()->rol->nombre === 'Administrador')
            <label for="estado">Estado:</label>
            <select id="estado" name="estado" class="form-control">
                <option value="Pendiente" {{ old('estado', $solicitud->estado ?? '') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="Aprobada" {{ old('estado', $solicitud->estado ?? '') == 'Aprobada' ? 'selected' : '' }}>Aprobada</option>
                <option value="Rechazada" {{ old('estado', $solicitud->estado ?? '') == 'Rechazada' ? 'selected' : '' }}>Rechazada</option>
            </select>
        @endif

        <!-- Botón Guardar -->
        <button type="submit" class="btn btn-primary btn-block">{{ isset($solicitud) ? 'Actualizar' : 'Guardar' }}</button>
    </form>
</div>
