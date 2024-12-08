@extends('layouts.app')

@section('title', isset($usuario) ? 'Modificar Empleado' : 'Registrar Empleado')

@section('content')
    @include('usuarios.form', ['usuario' => $usuario ?? null])
@endsection
