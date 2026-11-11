<?php

    $nombre = $_GET["nombre"] ?? "";
    $edad = $_GET["edad"] ?? "";

    echo "Nombre: " . htmlspecialchars($nombre);
    echo "<br>";
    echo "Edad: " . htmlspecialchars($edad);