@extends('layouts.app')

@section('title', 'Agregar Inventario')

@section('content')
    <div class="form-container">
        <h2>Agregar Inventario para: {{ $producto->nombre }}</h2>

        <form action="{{ route('productos.guardarInventario', $producto->idProducto) }}" method="POST" class="product-form">
            @csrf

            <div class="form-group">
                <label for="cantidad">Cantidad a Agregar:</label>
                <input type="number" id="cantidad" name="cantidad" class="form-control" min="1" required value="{{ old('cantidad') }}">
            </div>

            <div class="form-group button-group">
                <button type="submit" class="submit-button">Agregar Inventario</button>
                <a href="{{ route('productos.index') }}" class="cancel-button">Cancelar</a>
            </div>
        </form>
    </div>
@endsection