@extends('layouts.app')

@section('title', 'Editar Comprobante')

@section('content')
<div class="form-container">
    <h1>Editar Comprobante</h1>
    <form action="{{ route('comprobantes.update', $comprobante->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    
        <label for="categoria_gasto">Categoría de Gasto:</label>
        <input type="text" id="categoria_gasto" name="categoria_gasto" class="form-control" value="{{ $comprobante->categoria_gasto }}" required>
    
        <label for="observaciones">Observaciones:</label>
        <textarea id="observaciones" name="observaciones" class="form-control">{{ $comprobante->observaciones }}</textarea>
    
        <label for="pdf">Archivo PDF:</label>
        <input type="file" id="pdf" name="pdf" class="form-control">
    
        <label for="xml">Archivo XML:</label>
        <input type="file" id="xml" name="xml" class="form-control">
    
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
    
</div>
@endsection