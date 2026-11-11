<?php
    $rol= "admin";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEST</title>
</head>
<body>
    <h1>Administrador de libros</h1>
    <h6>Rol: <?= $rol; ?></h6>
    <!-- Soy un Comentario -->

    <?php if($rol == "admin"): ?>
    <button>Eliminar libro</button>
    <?php
    endif;
    ?>

    <?php 
    $num1 = 3; 
    $num2 = 4; 
    $resultado = $num1 * $num2;
    ?>
</body>
</html>