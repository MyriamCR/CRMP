<?php

    require "conexion.php";

    //recibir datos del formulario
    $usuario = trim($_POST["usuario"] ?? "");
    $password = $_POST["password"] ?? "";

    // validar campos vacios
    if ($usuario == "" || $password == "") {
        exit("Debes llenar todos los campos.");
    }

    try {

        // comprobar si el usuario ya existe
        $sql = "SELECT * FROM usuarios WHERE usuario = ?";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([$usuario]);

        $datos = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($datos) {
            exit("El nombre de usuario ya existe.");
        }

        //encriptamos la contraseña
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // insertar nuevo usuario en la tablla
        $sql = "INSERT INTO usuarios (usuario, password)
                VALUES (?, ?)";

        $consulta = $conexion->prepare($sql);
        $consulta->execute([$usuario, $passwordHash]);

        echo "Usuario registrado correctamente!";


    } catch (PDOException $e) {

        echo "Error al registrar el usuario.";

    }


