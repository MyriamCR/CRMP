<?php

//los datos para conectar con MySQL:

$servidor = "localhost";
$puerto = 3308;
$basedatos = "biblioteca_digital";
$usuario = "root";
$contrasena = "";

// establecer la conexion
try {

    $conexion = new PDO(
        "mysql:host=$servidor;port=$puerto;dbname=$basedatos;charset=utf8mb4",
        $usuario,
        $contrasena
    );

    //configurar PDO para mostrar errores de SQL
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    die("Error al conectar con la base de datos.");

}
?>
