@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="dashboard-container">
        <h1>Bienvenido, {{ Auth::user()->nombre }}</h1>

        <div class="dashboard-options">
            <a href="{{ route('usuarios.index') }}" class="dashboard-option">USUARIOS</a>
            <a href="{{ route('solicitudes.index') }}" class="dashboard-option">SOLICITUDES</a>
            <a href="{{ route('solicitudes_viaticos.index') }}" class="dashboard-option">SOLICITUDES DE VIATICOS</a>

        </div>
    </div>
@endsection