<!-- resources/views/partials/navbar.blade.php -->

<nav class="navbar">
    <ul class="navbar-menu">
        <li class="navbar-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
        <li class="navbar-item"><a href="{{ route('productos.index') }}">Inventario</a></li>
        @if(Auth::user()->idRol == 1)
            <li class="navbar-item"><a href="{{ route('movimientos.historial') }}">Historial</a></li>
        @endif
        @if(Auth::user()->idRol == 2)
            <li class="navbar-item"><a href="{{ route('movimientos.salida') }}">Salida de Productos</a></li>
        @endif
        <li class="navbar-item">
            <form method="POST" action="{{ route('logout') }}" class="navbar-logout-form">
                @csrf
                <button type="submit" class="navbar-logout-button">Cerrar Sesión</button>
            </form>
        </li>
    </ul>
</nav>