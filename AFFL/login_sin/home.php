<?php
    session_start();

    if(!isset($_SESSION["usuario"])){ //si no se ha iniciado sesion, te manda al index
        header("Location: index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
</head>
<body>
    <h1>Bienvenido <?= htmlspecialchars($_SESSION["usuario"]); ?></h1>
    <p>Has iniciado sesión correctamente.</p>

    <div>
        <a href="logout.php">Cerrar Sesión</a>
    </div>
</body>
</html>