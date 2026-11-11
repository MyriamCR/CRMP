<?php
    session_start();

    $_SESSION = []; //deja vacia la variable de sesion
    session_destroy();
    header("location: index.php");
    exit;
