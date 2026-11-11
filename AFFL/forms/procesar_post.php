<?php

    $nombre = trim($_POST["nombre"] ?? "");
    $edad = trim($_POST["edad"] ?? "");

    if($nombre != "" && $edad != "") {
        echo "Bienvenido: " . htmlspecialchars($nombre);
        echo "<br>";
        echo "Tu edad es: " . htmlspecialchars($edad);
    } else{
        echo "Todos los campos son obligatorios!";
    }
