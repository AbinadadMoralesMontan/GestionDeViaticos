@extends('layouts.app')

@section('title', 'Agregar Producto')

@section('content')
    <div class="form-container">
        <h2>Agregar Nuevo Producto</h2>

        <form action="{{ route('productos.store') }}" method="POST" class="product-form">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
            </div>
            <div class="form-group button-group">
                <button type="submit" class="submit-button">Agregar Producto</button>
                <a href="{{ route('productos.index') }}" class="cancel-button">Cancelar</a>
            </div>
        </form>
    </div>
@endsection