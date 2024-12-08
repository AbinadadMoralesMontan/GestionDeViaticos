@extends('layouts.app')

@section('title', 'Registro de Salida por Comisión')

@section('content')
    @include('solicitudes.form', ['solicitud' => null])
@endsection
