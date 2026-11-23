<?php

//iniciar la sesion si todavia  no esta iniciada ya que usamos header
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!defined("BASE_URL")) {
    define("BASE_URL", "/biblioteca/");
}


//verificar si inicio sesion usuario

function verificarSesion() {

    // Comprobar si existe un usuario en la sesion
    if (!isset($_SESSION["id_usuario"])) {

        //si no ha iniciado sesion regresar al login
        header("Location: " . BASE_URL . "login.php");
        exit;
    }
    
}


//verificar si es admin

function verificarAdmin() {

    // Primero comprobamos si inicio sesion
    verificarSesion();

    //comprobar si el rol es administrador
    if ($_SESSION["rol"] != "admin") {

        //si no es administrador regresar al dashboard
        header("Location: " . BASE_URL . "dashboard.php");
        exit;

    }
}

?>
