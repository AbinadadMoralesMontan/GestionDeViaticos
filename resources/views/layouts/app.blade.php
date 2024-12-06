<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="header">
        <div>
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
        </div>
        <h1>Universidad Politécnica de Tulancingo</h1>
    </div>
    
    <main>
        @yield('content')
    </main>

    <div class="footer">
        <h1>Universidad Politécnica de Tulancingo &copy; 2024</h1>
    </div>
</body>
</html>
