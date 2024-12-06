@extends('layouts.app')

@section('title', isset($usuario) ? 'Editar Usuario' : 'Crear Usuario')

@section('content')
    @include('usuarios.form', ['usuario' => $usuario ?? null])
@endsection