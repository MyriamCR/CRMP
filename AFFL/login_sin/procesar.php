<?php
    session_start(); //usar esto siempre en la primera linea en una variable de sesion
    //simulacion de datos
    $usuarioCorrecto = "admin";
    $passwordCorrecto = "12345";

    $usuario = trim($_POST["usuario"] ?? "");
    $password = trim($_POST["password"] ?? "");

    if($usuario == "" || $password == "") {
        echo "Debes llenar todos los campos.";
    }elseif($usuario == $usuarioCorrecto &&
            $password == $passwordCorrecto){
                //yupiiiii
                $_SESSION["usuario"] = $usuario;

                header("Location: home.php");
                exit;
    }else{
        echo "Usuario o contraseña imcorrecta";
    }