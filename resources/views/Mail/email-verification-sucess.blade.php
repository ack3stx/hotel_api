<!DOCTYPE html>
<html>
<head>
    <title>Verificación exitosa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        .success-icon {
            color: #4CAF50;
            font-size: 48px;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="success-icon">✓</div>
    
    <h1>¡Verificación exitosa!</h1>
    
    <p>{{ $message }}</p>
    
    <p>Bienvenido {{ $usuario->name }}, tu cuenta ha sido verificada correctamente.</p>
    
    <a href="{{ url('/login') }}" class="button">Iniciar sesión</a>
</body>
</html>