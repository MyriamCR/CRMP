<?php

    // Datos de conexion 
    $servidor = "localhost";
    $puerto = 3308;
    $basedatos = "dummy";
    $usuario = "root";
    $contrasena = "";

    try{
        $conexion = new PDO(
            "mysql:host=$servidor;port=$puerto;dbname=$basedatos;charset=utf8mb4",
            $usuario,
            $contrasena
        );

        //configurar el manejo de errores 
        $conexion->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );

        //echo "Conexión creada con éxito";

    }catch(PDOException $e){
        die("Error al conectar con la base de datos.");
    }