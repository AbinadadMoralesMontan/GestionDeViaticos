<div class="form-container">
    <h1>{{ isset($viatico) ? 'Modificar Solicitud de Pago de Viáticos' : 'Registrar Solicitud de Pago de Viáticos' }}</h1>
    <form action="{{ isset($viatico) ? route('solicitudes_viaticos.update', $viatico->id) : route('solicitudes_viaticos.store') }}" method="POST">
        @csrf
        @if (isset($viatico))
            @method('PUT')
        @endif

        <label for="solicitud_comision_id">Proyecto Asociado:</label>
        <select id="solicitud_comision_id" name="solicitud_comision_id" class="form-control" required>
            <option value="">Seleccione una comisión</option>
            @foreach ($comisiones as $comision)
                <option value="{{ $comision->id }}"
                    {{ old('solicitud_comision_id', $viatico->solicitud_comision_id ?? '') == $comision->id ? 'selected' : '' }}>
                    {{ $comision->fecha_solicitud }} - {{ $comision->motivo }}
                </option>
            @endforeach
        </select>

        <label for="monto_solicitado">Monto Solicitado:</label>
        <input type="number" id="monto_solicitado" name="monto_solicitado" class="form-control" required value="{{ old('monto_solicitado', $viatico->monto_solicitado ?? '') }}" step="0.01">

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" class="form-control" required>{{ old('descripcion', $viatico->descripcion ?? '') }}</textarea>

        <label for="tipo">Tipo:</label>
        <select id="tipo" name="tipo" class="form-control" required>
            <option value="Devengada" {{ old('tipo', $viatico->tipo ?? '') == 'Devengada' ? 'selected' : '' }}>Devengada</option>
            <option value="Anticipada" {{ old('tipo', $viatico->tipo ?? '') == 'Anticipada' ? 'selected' : '' }}>Anticipada</option>
        </select>

        <button type="submit" class="btn btn-primary btn-block">Guardar</button>
    </form>
</div>
