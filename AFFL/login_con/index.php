<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login sin DB</title>
</head>
<body>
    <h1>Inicio de sesión</h1>
    <hr>
    <form action="procesar.php" method="post">

    <label>Usuario</label>
    <input type="text" name="usuario">
    <br><br>
    <label>Contraseña</label>
    <input type="password" name="password">
    <br><br>
    <button type="submit">Ingresar</button>

    </form>
</body>
</html>