<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Verificación de Correo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .codigo {
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 4px;
            margin: 20px 0;
            letter-spacing: 4px;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hola {{ $usuario->name }}</h2>
        <p>Gracias por registrarte. Tu código de verificación es:</p>
        
        <div class="codigo">{{ $codigo_verificacion }}</div>
        
        <p>Para completar tu registro, haz clic en el siguiente enlace:</p>
        <a href="{{ $url }}" class="button">Verificar mi cuenta</a>
        
        <p>Si no solicitaste esta verificación, puedes ignorar este correo.</p>
        
        <p>El código expirará en 10 minutos.</p>
    </div>
</body>
</html>