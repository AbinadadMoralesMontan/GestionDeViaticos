<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background-color: #730f25; /* Fondo general */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100vh;
        }

        .header,
        .footer {
            background-color: #f9c42b; /* Fondo amarillo */
            color: #730f25; /* Texto color burdeos */
            text-align: left;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header img,
        .footer img {
            height: 40px;
            margin-right: 15px;
        }

        .header h1,
        .footer h1 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
        }

        .login-container {
            background-color: #730f25; /* Fondo del contenedor central */
            color: white;
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3); /* Sombra más pronunciada */
            border: 2px solid #f9c42b; /* Borde amarillo para resaltar */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            margin: auto;
        }


        .login-container h2 {
            margin-bottom: 20px;
            color: white;
            font-size: 24px;
        }

        .login-container label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
            color: white;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: none;
            font-size: 16px;
        }

        .login-container input:focus {
            outline: 2px solid #f9c42b;
        }

        .login-container button {
            width: 100%;
            background-color: #f9c42b;
            color: #730f25;
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-container button:hover {
            background-color: #d4a920;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 20px;
            }

            .header h1,
            .footer h1 {
                font-size: 16px;
            }

            .login-container h2 {
                font-size: 20px;
            }

            .login-container button {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
        </div>
    </div>

    <div class="login-container">
        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <label for="correo">Usuario:</label>
            <input type="email" id="correo" name="correo" value="{{ old('correo') }}" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>

    <div class="footer">
        <h1>Universidad Politécnica de Tulancingo &copy; 2024</h1>
    </div>
</body>
</html>
