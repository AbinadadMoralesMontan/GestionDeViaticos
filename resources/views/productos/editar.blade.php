@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')
    <div class="form-container">
        <h2>Editar Producto</h2>

        <form action="{{ route('productos.update', $producto->idProducto) }}" method="POST" class="product-form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion">{{ old('descripcion', $producto->descripcion) }}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="submit-button">Actualizar Producto</button>
            </div>
        </form>
    </div>
@endsection