<?php
    session_start(); //usar esto siempre en la primera linea en una variable de sesion
    
    require "conexion.php";


    $usuario = trim($_POST["usuario"] ?? "");
    $password = trim($_POST["password"] ?? "");

    if($usuario == "" || $password == "") {
        exit ("Debes llenar todos los campos.");
    }
    
    $sql = "SELECT * FROM usuarios WHERE usuario = ?";
    $consulta = $conexion->prepare($sql);
    $consulta-> execute([$usuario]);

    $datos = $consulta->fetch(PDO::FETCH_ASSOC);

    if($datos && password_verify($password, $datos["password"])){
            //yupiiiii
            $_SESSION["usuario"] = $datos ["usuario"];
            header("Location: home.php");
            exit;
    }else{
        echo "Usuario o contraseña incorrecta";
    }