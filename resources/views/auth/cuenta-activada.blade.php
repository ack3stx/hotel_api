<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuenta Activada</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }
        .container {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .success-icon {
            font-size: 60px;
            color: #4CAF50;
            margin-bottom: 20px;
        }
        h1 {
            color: #333;
        }
        .button {
            display: inline-block;
            background-color: #2196F3;
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 4px;
            margin-top: 20px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #0b7dda;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="success-icon">✓</div>
        <h1>¡Cuenta Activada Exitosamente!</h1>
        <p>Hola {{ $usuario->name }}, tu cuenta ha sido verificada y activada correctamente.</p>
        <p>Ahora puedes acceder a todas las funcionalidades de nuestra plataforma.</p>
        
        <a href="http://localhost:4200/login" class="button">Iniciar Sesión</a>
    </div>
</body>
</html>