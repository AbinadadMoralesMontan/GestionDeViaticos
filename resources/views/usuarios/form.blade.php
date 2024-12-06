<div class="form-container">
    <h1>{{ isset($usuario) ? 'Editar Usuario' : 'Crear Usuario' }}</h1>
    <form action="{{ isset($usuario) ? route('usuarios.update', $usuario->idUsuario) : route('usuarios.store') }}" method="POST">
        @csrf
        @if (isset($usuario))
            @method('PUT')
        @endif

        <!-- Nombre -->
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" class="form-control" required value="{{ old('nombre', $usuario->nombre ?? '') }}">

        <!-- Apellido Paterno -->
        <label for="apellido_paterno">Apellido Paterno:</label>
        <input type="text" id="apellido_paterno" name="apellido_paterno" class="form-control" required value="{{ old('apellido_paterno', $usuario->apellido_paterno ?? '') }}">

        <!-- Apellido Materno -->
        <label for="apellido_materno">Apellido Materno:</label>
        <input type="text" id="apellido_materno" name="apellido_materno" class="form-control" required value="{{ old('apellido_materno', $usuario->apellido_materno ?? '') }}">

        <!-- Correo -->
        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" class="form-control" required value="{{ old('correo', $usuario->correo ?? '') }}">

        <!-- Contraseña (Solo en creación) -->
        @if (!isset($usuario))
            <label for="contrasena">Contraseña:</label>
            <div class="input-group mb-3">
                <input type="password" id="contrasena" name="contrasena" class="form-control" placeholder="Ingrese su contraseña" required>
                <div class="input-group-append">
                    <button type="button" class="btn btn-info" onclick="togglePassword('contrasena', this)">
                        <i class="fa fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
            </div>
        @endif

        <!-- Banco -->
        <label for="banco">Banco:</label>
        <select id="banco" name="banco" class="form-control" required>
            <option value="">Seleccione un banco</option>
            <option value="BBVA" {{ old('banco', $usuario->banco ?? '') == 'BBVA' ? 'selected' : '' }}>BBVA</option>
            <option value="Banamex" {{ old('banco', $usuario->banco ?? '') == 'Banamex' ? 'selected' : '' }}>Banamex</option>
            <option value="Santander" {{ old('banco', $usuario->banco ?? '') == 'Santander' ? 'selected' : '' }}>Santander</option>
            <option value="HSBC" {{ old('banco', $usuario->banco ?? '') == 'HSBC' ? 'selected' : '' }}>HSBC</option>
            <option value="Scotiabank" {{ old('banco', $usuario->banco ?? '') == 'Scotiabank' ? 'selected' : '' }}>Scotiabank</option>
            <option value="Banorte" {{ old('banco', $usuario->banco ?? '') == 'Banorte' ? 'selected' : '' }}>Banorte</option>
            <option value="Inbursa" {{ old('banco', $usuario->banco ?? '') == 'Inbursa' ? 'selected' : '' }}>Inbursa</option>
            <option value="Banco Azteca" {{ old('banco', $usuario->banco ?? '') == 'Banco Azteca' ? 'selected' : '' }}>Banco Azteca</option>
            <option value="Otros" {{ old('banco', $usuario->banco ?? '') == 'Otros' ? 'selected' : '' }}>Otros</option>
        </select>

        <!-- Número de Cuenta -->
        <label for="numero_cuenta">Número de Cuenta:</label>
        <input type="text" id="numero_cuenta" name="numero_cuenta" class="form-control" value="{{ old('numero_cuenta', $usuario->numero_cuenta ?? '') }}" placeholder="Ingrese el número de cuenta">

        <!-- Área -->
        <label for="area">Área:</label>
        <select id="area" name="area" class="form-control" required>
            <option value="Empleado" {{ old('area', $usuario->area ?? '') == 'Empleado' ? 'selected' : '' }}>Empleado</option>
            <option value="Fiscalizacion" {{ old('area', $usuario->area ?? '') == 'Fiscalizacion' ? 'selected' : '' }}>Fiscalización</option>
            <option value="Tesoreria" {{ old('area', $usuario->area ?? '') == 'Tesoreria' ? 'selected' : '' }}>Tesorería</option>
        </select>

        <!-- Rol -->
        <label for="idRol">Rol:</label>
        <select id="idRol" name="idRol" class="form-control" required>
            @foreach ($roles as $rol)
                <option value="{{ $rol->idRol }}" {{ old('idRol', $usuario->idRol ?? '') == $rol->idRol ? 'selected' : '' }}>
                    {{ $rol->nombre }}
                </option>
            @endforeach
        </select>

        <!-- Botón Guardar -->
        <button type="submit" class="btn btn-primary btn-block">{{ isset($usuario) ? 'Actualizar' : 'Guardar' }}</button>
    </form>
</div>

<script>
    function togglePassword(fieldId, button) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById('toggleIcon');
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
