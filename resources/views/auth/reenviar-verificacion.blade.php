<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reenviar código de verificación</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.5;
            padding: 20px;
            max-width: 500px;
            margin: 0 auto;
            text-align: center;
            background-color: #f8f9fa;
        }
        .container {
            background-color: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2d6ca2;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #336699;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #bed3ea;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        button {
            background-color: #3383cc;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        button:hover {
            background-color: #2d6ca2;
        }
        .alert {
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: left;
        }
        .alert-success {
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .alert-warning {
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #e8f1f8;
            color: #336699;
            text-decoration: none;
            border-radius: 4px;
        }
        .back-button:hover {
            background-color: #d1e5f5;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Reenviar código de verificación</h1>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
                <script>
                    setTimeout(function() {
                        window.location.href = 'http://localhost:4200/login';
                    }, 3000);
                </script>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        @if(session('warning'))
            <div class="alert alert-warning" id="warningAlert">
                @if(strpos(session('warning'), 'Debes esperar 0 minutos') !== false)
                    El enlace ya está disponible para reenviar. <a href="javascript:document.getElementById('reenvioForm').submit();" style="color: #0c5460; text-decoration: underline;">Haz clic aquí para reenviar ahora</a>.
                @else
                    {{ session('warning') }}
                @endif
            </div>
        @endif
        
        <form action="{{ route('reenviar.codigo') }}" method="POST" id="reenvioForm">
            @csrf
            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required placeholder="ejemplo@correo.com" value="{{ old('email') }}">
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit">Enviar enlace de verificación</button>
        </form>
        
        <a href="http://localhost:4200/login" class="back-button">Volver a inicio de sesión</a>
    </div>
</body>
</html>