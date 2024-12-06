@extends('layouts.app')

@section('title', 'Registrar Salida de Producto')

@section('content')
    <div class="form-container">
        <h2>Registrar Salida de Producto</h2>
        <!-- Formulario de Agregar Salida -->
        <form action="{{ route('movimientos.guardarSalida') }}" method="POST" class="product-form confirm-form" data-title="Confirmar Registro de Salida" data-text="¿Estás seguro de registrar esta salida de producto?">
            @csrf
            <div class="form-group">
                <label for="idProducto">Producto:</label>
                <select name="idProducto" id="idProducto" class="form-control" required>
                    <option value="">Seleccionar Producto</option>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->idProducto }}" {{ old('idProducto') == $producto->idProducto ? 'selected' : '' }}>
                            {{ $producto->nombre }} (Cantidad: {{ $producto->cantidad }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad a Sacar:</label>
                <input type="number" id="cantidad" name="cantidad" class="form-control" min="1" required value="{{ old('cantidad') }}">
            </div>
            <div class="form-group">
                <button type="submit" class="submit-button">Registrar Salida</button>
            </div>
        </form>
    </div>
@endsection