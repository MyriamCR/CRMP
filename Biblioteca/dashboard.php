<?php


require_once "config/auth.php";
require_once "config/conexion.php";


// ver  que inicio sesion
verificarSesion();


// consulta para el rol administrador 

if ($_SESSION["rol"] == "admin") {

    //contar el total de libros
    $sql = "SELECT COUNT(*) AS total FROM libros";
    $consulta = $conexion->prepare($sql);
    $consulta->execute();
    $total = $consulta->fetch(PDO::FETCH_ASSOC);

    //contar los libros pendientes
    $sql = "SELECT COUNT(*) AS pendientes
            FROM libros
            WHERE estado = 'Pendiente'";
    $consulta = $conexion->prepare($sql);
    $consulta->execute();
    $pendientes = $consulta->fetch(PDO::FETCH_ASSOC);

    //contar libros que se estan leyendo
    $sql = "SELECT COUNT(*) AS leyendo
            FROM libros
            WHERE estado = 'Leyendo'";
    $consulta = $conexion->prepare($sql);
    $consulta->execute();
    $leyendo = $consulta->fetch(PDO::FETCH_ASSOC);

    //contar  libros terminados
    $sql = "SELECT COUNT(*) AS terminados
            FROM libros
            WHERE estado = 'Terminado'";
    $consulta = $conexion->prepare($sql);
    $consulta->execute();
    $terminados = $consulta->fetch(PDO::FETCH_ASSOC);


} else {     //consulta para un usuario normal


    // obtener su total de libros
    $sql = "SELECT COUNT(*) AS total
            FROM libros
            WHERE id_usuario = :id_usuario";
    $consulta = $conexion->prepare($sql);
    $consulta->execute(["id_usuario" => $_SESSION["id_usuario"]]);
    $total = $consulta->fetch(PDO::FETCH_ASSOC);


    //contar libros pendientes del usuario
    $sql = "SELECT COUNT(*) AS pendientes
            FROM libros
            WHERE estado = 'Pendiente'
            AND id_usuario = :id_usuario";
    $consulta = $conexion->prepare($sql);
    $consulta->execute(["id_usuario" => $_SESSION["id_usuario"]]);
    $pendientes = $consulta->fetch(PDO::FETCH_ASSOC);

    // contar libros que esta leyendo el usuario
    $sql = "SELECT COUNT(*) AS leyendo
            FROM libros
            WHERE estado = 'Leyendo'
            AND id_usuario = :id_usuario";
    $consulta = $conexion->prepare($sql);
    $consulta->execute(["id_usuario" => $_SESSION["id_usuario"]]);
    $leyendo = $consulta->fetch(PDO::FETCH_ASSOC);

    //contar libros terminados del usuario
    $sql = "SELECT COUNT(*) AS terminados
            FROM libros
            WHERE estado = 'Terminado'
            AND id_usuario = :id_usuario";
    $consulta = $conexion->prepare($sql);
    $consulta->execute(["id_usuario" => $_SESSION["id_usuario"]]);
    $terminados = $consulta->fetch(PDO::FETCH_ASSOC);
}



//traer encabezado
require_once "includes/header.php";
?>



<h2>Bienvenido, <?= htmlspecialchars($_SESSION["usuario"]) ?></h2>

<p>Resumen de tu biblioteca digital.</p>
<hr>

<div class="row">

    <!--Total de libros -->
    <div class="col-md-3 mb-3">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="mt-2 mb-0">Total de libros</h5>
                <p class="card-text fg-2">
                    <?= $total["total"] ?>
                </p>
                <small class="fg-3">
                    Libros registrados en la biblioteca.
                </small>
            </div>
        </div>
    </div>

    <!--libros pendientes-->
    <div class="col-md-3 mb-3">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="mt-2 mb-0">Libros pendientes</h5>
                <p class="card-text fg-2">
                    <?= $pendientes["pendientes"] ?>
                </p>
                <small class="fg-3">
                    Libros que todavía no has comenzado.
                </small>
            </div>
        </div>
    </div>

    <!--Libros leyendo-->
    <div class="col-md-3 mb-3">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="mt-2 mb-0">Libros leyendo</h5>
                <p class="card-text fg-2">
                    <?= $leyendo["leyendo"] ?>
                </p>
                <small class="fg-3">
                    Libros que estás leyendo actualmente.
                </small>
            </div>
        </div>
    </div>

    <!--Libros terminados -->
    <div class="col-md-3 mb-3">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="mt-2 mb-0">Libros terminados</h5>
                <p class="card-text fg-2">
                    <?= $terminados["terminados"] ?>
                </p>
                <small class="fg-3">
                    Libros que ya has terminado de leer.
                </small>
            </div>
        </div>
    </div>

</div>

<?php require_once "includes/footer.php"; ?>