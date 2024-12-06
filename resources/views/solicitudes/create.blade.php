@extends('layouts.app')

@section('title', 'Nueva Solicitud de Comisión')

@section('content')
    @include('solicitudes.form', ['solicitud' => null])
@endsection