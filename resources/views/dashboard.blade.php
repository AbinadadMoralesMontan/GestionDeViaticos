@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="dashboard-container">
        <h1>Bienvenido, {{ Auth::user()->nombre }} {{ Auth::user()->apellido_paterno }} {{ Auth::user()->apellido_materno }} </h1>

        <div class="dashboard-options">
            @foreach ($dashboardOptions as $option)
                <a href="{{ route($option['route']) }}" class="dashboard-option">{{ $option['label'] }}</a>
            @endforeach
        </div>
    </div>
@endsection
