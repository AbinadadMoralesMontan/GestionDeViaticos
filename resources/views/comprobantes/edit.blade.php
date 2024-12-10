@extends('layouts.app')

@section('title', 'Modificar Comprobante de Viáticos')

@section('content')
<div class="form-container">
    <h1>Modificar Comprobante de Viático</h1>
    <form action="{{ route('comprobantes.update', $comprobante->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Categoria -->
        <label for="categoria_gasto">Categoría:</label>
        <select id="categoria_gasto" name="categoria_gasto" class="form-control" required>
            <option value="Hospedaje" {{ old('categoria_gasto', $comprobante->categoria_gasto ?? '') == 'Hospedaje' ? 'selected' : '' }}>Hospedaje</option>
            <option value="Trasporte" {{ old('categoria_gasto', $comprobante->categoria_gasto ?? '') == 'Trasporte' ? 'selected' : '' }}>Trasporte</option>
            <option value="Alimentación" {{ old('categoria_gasto', $comprobante->categoria_gasto ?? '') == 'Alimentación' ? 'selected' : '' }}>Alimentación</option>
            <option value="Inscripción" {{ old('categoria_gasto', $comprobante->categoria_gasto ?? '') == 'Inscripción' ? 'selected' : '' }}>Inscripción</option>
            <option value="Otros" {{ old('categoria_gasto', $comprobante->categoria_gasto ?? '') == 'Otros' ? 'selected' : '' }}>Otros</option>
        </select>

        <!-- Monto -->
        <label for="monto">Monto:</label>
        <input type="number" id="monto" name="monto" class="form-control" min="0" step="0.01" value="{{ $comprobante->monto ?? 0 }}">


        <label for="observaciones">Observaciones:</label>
        <textarea id="observaciones" name="observaciones" class="form-control">{{ $comprobante->observaciones }}</textarea>

        <label for="pdf">Archivo PDF:</label>
        <input type="file" id="pdf" name="pdf" class="form-control">

        <label for="xml">Archivo XML:</label>
        <input type="file" id="xml" name="xml" class="form-control">

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>

</div>
@endsection
