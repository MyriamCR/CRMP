<?php

require_once "config/auth.php";



//eliminar los datos de la sesion y destruirla

$_SESSION = [];

session_destroy();



//  Regresar a  inicio de sesion
header("Location: " . BASE_URL . "login.php");
exit;
?>
