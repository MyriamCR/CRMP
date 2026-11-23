<?php

// Iniciar sesion
session_start();

// vemos si el usuario inicio sesion 
if (isset($_SESSION["usuario"])) {

    //si si inicio sesion lo mandamos al inicio
    header("Location: dashboard.php");
    exit;

} else {

    //si no entonces ir al login
    header("Location: login.php");
    exit;

}

?>
