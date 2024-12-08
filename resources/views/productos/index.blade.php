@extends('layouts.app')

@section('title', 'Inventario de Productos')

@section('content')
    <div class="dashboard-container">
        <h2>Inventario de Productos</h2>

        @if(Auth::user()->id_rol == 1)
            <a href="{{ route('productos.create') }}" class="add-button">Agregar Nuevo Producto</a>
        @endif

        <table id="productos-table" class="product-table display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Estatus</th>
                    @if(Auth::user()->id_rol == 1)
                        <th>Acciones</th>
                        <th>Inventario</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                    @if($producto->estatus == 1 & Auth::user()->id_rol == 2)
                        <tr>
                                <td>{{ $producto->idProducto }}</td>
                                <td>{{ $producto->nombre }}</td>
                                <td>{{ $producto->descripcion }}</td>
                                <td>{{ $producto->cantidad }}</td>
                                <td>{{ $producto->estatus ? 'Activo' : 'Inactivo' }}</td>

                            @if(Auth::user()->id_rol == 1)
                                <td>
                                    <a href="{{ route('productos.edit', $producto->idProducto) }}" class="edit-button">Editar</a>
                                    <form action="{{ route('productos.destroy', $producto->idProducto) }}" method="POST" class="inline-form delete-form" data-title="¿Cambiar Estatus?" data-text="¿Quieres cambiar el estatus de este producto?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-button">
                                            {{ $producto->estatus ? 'Dar de Baja' : 'Reactivar' }}
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('productos.agregarInventario', $producto->idProducto) }}" class="add-inventory-button">Agregar Inventario</a>
                                </td>
                            @endif
                        </tr>
                    @elseif (Auth::user()->id_rol == 1)
                        <tr>
                            <td>{{ $producto->idProducto }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->descripcion }}</td>
                            <td>{{ $producto->cantidad }}</td>
                            <td>{{ $producto->estatus ? 'Activo' : 'Inactivo' }}</td>

                        @if(Auth::user()->id_rol == 1)
                            <td>
                                <a href="{{ route('productos.edit', $producto->idProducto) }}" class="edit-button">Editar</a>
                                <form action="{{ route('productos.destroy', $producto->idProducto) }}" method="POST" class="inline-form delete-form" data-title="¿Cambiar Estatus?" data-text="¿Quieres cambiar el estatus de este producto?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-button">
                                        {{ $producto->estatus ? 'Dar de Baja' : 'Reactivar' }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('productos.agregarInventario', $producto->idProducto) }}" class="add-inventory-button">Agregar Inventario</a>
                            </td>
                        @endif
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
