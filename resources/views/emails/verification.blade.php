<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifica tu cuenta</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .container {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
        }
        h1 {
            color: #2c3e50;
        }
        .code {
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 5px;
            background-color: #eaeaea;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
        }
        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 4px;
            font-weight: bold;
            margin: 20px 0;
        }
        .expiry {
            font-style: italic;
            color: #888;
            margin-top: 20px;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>¡Hola {{ $usuario->name }}!</h1>
        
        <p>Gracias por registrarte. Para activar tu cuenta, utiliza el siguiente código de verificación:</p>
        
        <div class="code">{{ $codigo }}</div>
        
        <p>O simplemente haz clic en el botón de abajo:</p>
        
        <a href="{{ $url }}" class="button">Activar mi cuenta</a>
        
        <p class="expiry">Este código y enlace expiran en 5 minutos.</p>
        
        <div class="footer">
            <p>Si no solicitaste esta cuenta, puedes ignorar este correo de forma segura.</p>
            <p>Si el botón no funciona, copia y pega esta URL en tu navegador: {{ $url }}</p>
        </div>
    </div>
</body>
</html>