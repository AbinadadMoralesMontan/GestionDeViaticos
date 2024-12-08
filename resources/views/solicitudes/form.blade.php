<div class="form-container">
    <h1>{{ isset($solicitud) ? 'Modificar Solicitud de Salida por Comisión' : 'Registrar Solicitud de Salida Comisión' }}</h1>
    <form action="{{ isset($solicitud) ? route('solicitudes.update', $solicitud) : route('solicitudes.store') }}" method="POST">
        @csrf
        @if (isset($solicitud))
            @method('PUT')
        @endif

        <!-- Fecha de Solicitud -->
        <label for="fecha_solicitud">Fecha de Solicitud:</label>
        <input type="date" id="fecha_solicitud" name="fecha_solicitud" class="form-control" value="{{ old('fecha_solicitud', $solicitud->fecha_solicitud ?? now()->format('Y-m-d')) }}" disabled>

        <!-- Fecha de Salida -->
        <label for="fecha_inicio">Fecha de Inicio:</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required value="{{ old('fecha_inicio', $solicitud->fecha_inicio ?? '') }}">

        <!-- Fecha de Regreso -->
        <label for="fecha_fin">Fecha de Fin:</label>
        <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" required value="{{ old('fecha_fin', $solicitud->fecha_fin ?? '') }}">

        <!-- Motivo -->
        <label for="motivo">Motivo:</label>
        <input type="text" id="motivo" name="motivo" class="form-control" required value="{{ old('motivo', $solicitud->motivo ?? '') }}" placeholder="Describa el motivo de la salida por comisión">

        <!-- Destino -->
        <label for="destino">Destino:</label>
        <input type="text" id="destino" name="destino" class="form-control" required value="{{ old('motivo', $solicitud->destino ?? '') }}" placeholder="Indique el destino">

        <!-- Monto de Hospedaje -->
        <label for="monto_hospedaje">Monto de Hospedaje:</label>
        <input type="number" id="monto_hospedaje" name="monto_hospedaje" class="form-control" min="0" step="0.01" value="{{ $solicitud->monto_hospedaje ?? 0 }}">

        <!-- Monto de Trasporte -->
        <label for="monto_transporte">Monto de Trasporte:</label>
        <input type="number" id="monto_transporte" name="monto_transporte" class="form-control" min="0" step="0.01" value="{{ $solicitud->monto_transporte ?? 0 }}">

        <!-- Monto de Trasporte -->
        <label for="monto_alimentacion">Monto de Alimentación:</label>
        <input type="number" id="monto_alimentacion" name="monto_alimentacion" class="form-control" min="0" step="0.01" value="{{ $solicitud->monto_alimentacion ?? 0 }}">

        <!-- Monto de Trasporte -->
        <label for="monto_inscripcion">Monto de Inscripción:</label>
        <input type="number" id="monto_inscripcion" name="monto_inscripcion" class="form-control" min="0" step="0.01" value="{{ $solicitud->monto_inscripcion ?? 0 }}">

        <!-- Monto de Otros Gastos -->
        <label for="monto_otros">Monto de Otros Gastos:</label>
        <input type="number" id="monto_otros" name="monto_otros" class="form-control" min="0" step="0.01" value="{{ $solicitud->monto_otros ?? 0 }}">

        <!-- Observaciones -->
        <label for="observaciones">Observaciones:</label>
        <textarea id="observaciones" name="observaciones" class="form-control" placeholder="Ingrese observaciones adicionales">{{ old('observaciones', $solicitud->observaciones ?? '') }}</textarea>

        <!-- Estado (Solo para Rectoria y en modo edición) -->
        @if (isset($solicitud) && auth()->user()->rol->nombre === 'Rectoria')
            <label for="estado">Estado:</label>
            <select id="estado" name="estado" class="form-control">
                <option value="Pendiente" {{ old('estado', $solicitud->estado ?? '') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="Aprobada" {{ old('estado', $solicitud->estado ?? '') == 'Aprobada' ? 'selected' : '' }}>Aprobada</option>
                <option value="Rechazada" {{ old('estado', $solicitud->estado ?? '') == 'Rechazada' ? 'selected' : '' }}>Rechazada</option>
            </select>
        @endif

        <hr>
        <!-- Botón Guardar -->
        <button type="submit" class="btn btn-primary btn-block">Guardar</button>
    </form>
</div>
