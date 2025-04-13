<!DOCTYPE html>
<html>
<head>
    <title>Error de verificación</title>
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
        .error-icon {
            color: #f44336;
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
    <div class="error-icon">✗</div>
    
    <h1>Error de verificación</h1>
    
    <p>{{ $message }}</p>
    
    <p>Por favor, solicita un nuevo enlace de verificación.</p>
    
    <a href="{{ url('/resend-verification') }}" class="button">Solicitar nuevo enlace</a>
</body>
</html>