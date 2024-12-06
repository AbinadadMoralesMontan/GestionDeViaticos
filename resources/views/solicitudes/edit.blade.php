@extends('layouts.app')

@section('title', 'Editar Solicitud de Comisión')

@section('content')
    @include('solicitudes.form', ['solicitud' => $solicitud])
@endsection