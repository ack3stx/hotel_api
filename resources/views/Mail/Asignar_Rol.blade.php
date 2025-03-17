<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso</title>
</head>
<body>
    <h1>Hola Admin</h1>
    <h2>Un nuevo usuario se ah registrado a la plataforma</h2>
    <P>Nombre de usuario Registrado {{$name }}</P>
    <h1>Ingrese a este link Para Confirmar El Registro Del Nuevo Usuario</h1>
    <a href="{{ $urlFirmada }}">
    <button type="button">Confirmar</button>
</a>
</body>
</html>