<?php


// incluir los archivos
require_once "../config/auth.php";
require_once "../config/conexion.php";


//comprobar que el usuario inicio sesion
verificarSesion();
 

// recuperar el texto puesto en  busqueda
$busqueda = $_GET["busqueda"] ?? "";


// si  el rol del usuario es admin:
if ($_SESSION["rol"] == "admin") {

    // Se consultan todos los libros
    $sql = "SELECT * FROM libros
            WHERE titulo LIKE :busqueda
            ORDER BY titulo";

    $consulta = $conexion->prepare($sql);

    $consulta->execute([
        "busqueda" => "%$busqueda%"
    ]);


} else {

    //solo se consultan los libros del usuario

    $sql = "SELECT * FROM libros
            WHERE id_usuario = :id_usuario
            AND titulo LIKE :busqueda
            ORDER BY titulo";

    $consulta = $conexion->prepare($sql);


    $consulta->execute([
        "id_usuario" => $_SESSION["id_usuario"],
        "busqueda" => "%$busqueda%"
    ]);

}

//recuperar todos los libros encontrados
$libros = $consulta->fetchAll(PDO::FETCH_ASSOC);


//traer el navbar
require_once "../includes/header.php";

?>



<h2>Mis libros</h2>

<hr>


<!-- el formulario para buscar libros-->
<form method="GET" action="index.php" class="mb-4">

    <div class="input-group">
        <!--mantener texto de busqueda-->
        <input type="text" name="busqueda"
            class="form-control"
            placeholder="Buscar libro por titulo"
            value="<?= htmlspecialchars($busqueda) ?>">
        <button type="submit" class="btn-outline theme-accent">
            Buscar
        </button>
    </div>

</form>



<!--link para crear un librro -->
<a href="crear.php" class="btn-subtle theme-info">
    Registrar libro
</a>


<!--lista de libros -->
<div class="row">

    <?php if (count($libros) > 0): ?>

        <!--recorrer los libros encontrados-->
        <?php foreach ($libros as $libro): ?>

            <div class="col-md-4 mb-4">
                <div class="card h-100" style="width: 18rem;">

                    <!--Informacion principal -->
                    <div class="card-body">

                        <h4 class="card-title">
                            <?= htmlspecialchars($libro["titulo"]) ?>
                        </h4>
                        <p class="card-text">
                            Autor: <?= htmlspecialchars($libro["autor"]) ?>
                        </p>
                    </div>
                    <!--Info adicional -->
                    <ul class="list-group list-group-flush">

                        <li class="list-group-item">
                            Género: <?= htmlspecialchars($libro["genero"]) ?>
                        </li>
                        <li class="list-group-item">
                            Año: <?= htmlspecialchars($libro["anio"]) ?>
                        </li>
                        <li class="list-group-item">
                            Estado: <?= htmlspecialchars($libro["estado"]) ?>
                        </li>
                    </ul>


                    <!--editar sus libros -->
                    <div class="card-body d-flex flex-row gap-4">
                        <a href="editar.php?id=<?= $libro["id_libro"] ?>">
                            Editar
                        </a>


                        <!-- Solo el administrador puede eliminar -->
                        <?php if ($_SESSION["rol"] == "admin"): ?>

                            <form action="eliminar.php" method="POST"
                                onsubmit="return confirm('¿Seguro que deseas eliminar este libro?');">

                                <input type="hidden" name="id_libro"
                                    value="<?= $libro["id_libro"] ?>">

                                <button type="submit"
                                    class="btn btn-link text-danger p-0">
                                    Eliminar
                                </button>
                            </form>

                        <?php endif; ?>

                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    <?php else: ?>

        <!--mensaje cuando no hay libros-->
        <p>Aún no tienes lecturas! Registra un libro :></p>

    <?php endif; ?>


</div>


<?php require_once "../includes/footer.php"; ?>