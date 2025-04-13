<!DOCTYPE html>
<html>
<head>
    <title>Verificación de cuenta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: white !important;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <h2>Hola {{ $usuario->name }}</h2>
    
    <p>Gracias por registrarte en nuestra plataforma. Por favor, verifica tu cuenta haciendo clic en el siguiente enlace:</p>
    
    <a href="{{ $verificationUrl }}" class="button">Verificar mi cuenta</a>
    
    <p>Este enlace expirará en 5 minutos.</p>
    
    <p>Si no creaste una cuenta, puedes ignorar este correo.</p>
    
    <div class="footer">
        <p>Si el botón no funciona, copia y pega este enlace en tu navegador:</p>
        <p>{{ $verificationUrl }}</p>
    </div>
</body>
</html>