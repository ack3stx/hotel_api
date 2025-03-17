<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hola {{$name }}</h1>
    <h2>Aqui esta el enlace de confirmacion que volvio a solicitar </h2>
    <h1>Ingrese a este link para activar su cuenta tiene 5 Minutos</h1>
    <a href="{{ $urlFirmada }}">
    <button type="button">Confirmar</button>
</a>
</body>
</html>