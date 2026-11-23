<?php


require_once "../config/auth.php";
require_once "../config/conexion.php";


//verificar que el usuario sea administrador
verificarAdmin();

// comprobar que los datos se enviaron mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Comprobar que se recibio el ID del libro
    if (isset($_POST["id_libro"]) && is_numeric($_POST["id_libro"])) {

        // convnvertir el ID a numero entero
        $id = intval($_POST["id_libro"]);

        // Comprobar que el libro exista
        $sql = "SELECT * FROM libros
                WHERE id_libro = :id_libro";

        $consulta = $conexion->prepare($sql);
        $consulta->execute(["id_libro" => $id]);

        //obtener los datos del libro
        $libro = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($libro) {

            // eliminar  el libro

            $sql = "DELETE FROM libros
                    WHERE id_libro = :id_libro";

            $consulta = $conexion->prepare($sql);
            $consulta->execute(["id_libro" => $id]);

        }
    }
}

// regresar a la lista de libros
header("Location: index.php");
exit;
?>
