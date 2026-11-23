<?php
// Iniciar sesion si todavia no esta iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// definir la ruta principal del proyecto:
if (!defined("BASE_URL")) {
    define("BASE_URL", "/biblioteca/");
}

// Comprobar si existe una sesion iniciada
$sesionIniciada = isset($_SESSION["usuario"]);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mi Biblioteca Digital</title>

  
    <link rel="stylesheet" href="/Biblioteca/assets/css/estilos.css">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe"
    crossorigin="anonymous">
</head>

<body>


    <nav class="navbar sm:navbar-expand bg-1 fg-2">

        <div class="container-fluid">

            <a class="navbar-brand" href="<?= BASE_URL ?>index.php">
                Mi Biblioteca Digital
            </a>

            <!--enlaces de menu-->
            <div class="nav nav-pills navbar-nav">
                <!--menu paro las sesiones iniciadas-->
                <?php if ($sesionIniciada): ?>

                    <a class="nav-link"
                        href="<?= BASE_URL ?>dashboard.php">
                        Detalles
                    </a>

                    <a class="nav-link"
                        href="<?= BASE_URL ?>libros/index.php">
                        Libros
                    </a>

                    <a class="nav-link"
                        href="<?= BASE_URL ?>logout.php">
                        Cerrar sesión
                    </a>

                    <!--menu para login o registro-->
                <?php else: ?>

                    <a class="nav-link"
                        href="<?= BASE_URL ?>login.php">
                        Iniciar sesión
                    </a>

                    <a class="nav-link"
                        href="<?= BASE_URL ?>registro.php">
                        Registrarse
                    </a>
                <?php endif; ?>

            </div>

        </div>

    </nav>

    
    <main class="container">
