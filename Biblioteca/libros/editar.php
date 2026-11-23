<?php


require_once "../config/auth.php";
require_once "../config/conexion.php";

// commprobar si se inicio sesion
verificarSesion();

//Variables para mensajes y guardar  datos del libro
$mensaje = "";
$tipoMensaje = "";
$libro = [];

// Comprobar si se envio el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener el ID del libro
    $id = $_POST["id_libro"];

    //ver que el ID sea valido
    if (isset($id) && is_numeric($id)) {

        $id = intval($id);

        // buscar  libro dependiendo del rol
        if ($_SESSION["rol"] == "admin") {
            $sql = "SELECT * FROM libros
                    WHERE id_libro = :id_libro ";
            $consulta = $conexion->prepare($sql);
            $consulta->execute(["id_libro" => $id]);
        } else {
            //si es usuario normal
            $sql = "SELECT * FROM libros
                    WHERE id_libro = :id_libro
                    AND id_usuario = :id_usuario";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([
                "id_libro" => $id,
                "id_usuario" => $_SESSION["id_usuario"]
            ]);
        }

        //obtener los datos del libro
        $libro = $consulta->fetch(PDO::FETCH_ASSOC);

        // ver si el libro existe y puede editarse

        if ($libro) {

            //obtener los datos enviados por el formulario
            $titulo = trim($_POST["titulo"]);
            $autor = trim($_POST["autor"]);
            $genero = trim($_POST["genero"]);
            $anio = trim($_POST["anio"]);
            $estado = $_POST["estado"];

            // checar que los campos no esten vacios
            if ($titulo == "" || $autor == "" || $genero == "" || $anio == "" || $estado == "") {
                $mensaje = "Todos los campos son obligatorios.";
                $tipoMensaje = "danger";

            //validar  año
            } elseif (!is_numeric($anio) || $anio <= 0) {
                $mensaje = "Ingresa un año valido.";
                $tipoMensaje = "danger";

            //validar estado
            } elseif (!in_array($estado, ["Pendiente", "Leyendo", "Terminado"])) {
                $mensaje = "Selecciona un estado valido.";
                $tipoMensaje = "danger";

            } else {

                //Actualizar  datos del libro
                $sql = "UPDATE libros SET
                        titulo = :titulo,
                        autor = :autor,
                        genero = :genero,
                        anio = :anio,
                        estado = :estado
                        WHERE id_libro = :id_libro";

                $consulta = $conexion->prepare($sql);
                $consulta->execute([
                    "titulo" => $titulo,
                    "autor" => $autor,
                    "genero" => $genero,
                    "anio" => $anio,
                    "estado" => $estado,
                    "id_libro" => $id
                ]);

                //regresar a  lista de libros
                header("Location: index.php");
                exit;
            }

            // conservar los datos puestos si esque hubo un error de validacion
            $libro["titulo"] = $titulo;
            $libro["autor"] = $autor;
            $libro["genero"] = $genero;
            $libro["anio"] = $anio;
            $libro["estado"] = $estado;

        } else {
            $mensaje = "Libro no encontrado o no tienes permiso para editarlo.";
            $tipoMensaje = "danger";
        }

    } else {
        $mensaje = "El ID del libro no es valido.";
        $tipoMensaje = "danger";
    }

// Si se abrio la pagina desde el enlace Editar
} elseif (isset($_GET["id"]) && is_numeric($_GET["id"])) {

    $id = intval($_GET["id"]);

    // buscar libro dependiendo del rol
    if ($_SESSION["rol"] == "admin") {
        $sql = "SELECT * FROM libros
                WHERE id_libro = :id_libro";
        $consulta = $conexion->prepare($sql);
        $consulta->execute(["id_libro" => $id]);
    } else {
        $sql = "SELECT * FROM libros
                WHERE id_libro = :id_libro
                AND id_usuario = :id_usuario";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([
            "id_libro" => $id,
            "id_usuario" => $_SESSION["id_usuario"]
        ]);
    }

    $libro = $consulta->fetch(PDO::FETCH_ASSOC);

    // mensaje si no se encontro el libro
    if (!$libro) {
        $mensaje = "Libro no encontrado o no tienes permiso para editarlo.";
        $tipoMensaje = "danger";
    }

} else {
    $mensaje = "No se proporciono un ID valido.";
    $tipoMensaje = "danger";
}


//traer el encabezado
require_once "../includes/header.php";
?>


<h2>Editar libro</h2>
<hr>

<?php if ($mensaje != ""): ?>
    <div class="alert alert-<?= $tipoMensaje ?>">
        <?= htmlspecialchars($mensaje) ?>
    </div>
<?php endif; ?>

<?php if ($libro): ?>

    <form action="editar.php" method="POST">

        <!--enviar el ID del libro sin mostrarlo-->
        <input type="hidden" name="id_libro"
            value="<?= $libro["id_libro"] ?>">

        <div class="mb-3">
            <label for="floatingTitulo" class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control"
                id="floatingTitulo"
                value="<?= htmlspecialchars($libro["titulo"]) ?>" required>
        </div>

        <div class="mb-3">
            <label for="floatingAutor" class="form-label">Autor</label>
            <input type="text" name="autor" class="form-control"
                id="floatingAutor"
                value="<?= htmlspecialchars($libro["autor"]) ?>" required>
        </div>

        <div class="mb-3">
            <label for="floatingGenero" class="form-label">Género</label>
            <input type="text" name="genero" class="form-control"
                id="floatingGenero"
                value="<?= htmlspecialchars($libro["genero"]) ?>" required>
        </div>

        <div class="mb-3">
            <label for="floatingAnio" class="form-label">Año</label>
            <input type="number" name="anio" class="form-control"
                id="floatingAnio"
                value="<?= htmlspecialchars($libro["anio"]) ?>" required>
        </div>

        <div class="mb-3">
            <label for="floatingEstado" class="form-label">Estado</label>
            <select name="estado" class="form-select"
                id="floatingEstado" required>

                <option value="Pendiente"
                    <?= $libro["estado"] == "Pendiente" ? "selected" : "" ?>>
                    Pendiente
                </option>

                <option value="Leyendo"
                    <?= $libro["estado"] == "Leyendo" ? "selected" : "" ?>>
                    Leyendo
                </option>

                <option value="Terminado"
                    <?= $libro["estado"] == "Terminado" ? "selected" : "" ?>>
                    Terminado
                </option>

            </select>
        </div>

        <button type="submit" class="btn-outline theme-warning">
            Guardar cambios
        </button>

        <a href="index.php" class="btn-outline theme-danger">
            Cancelar
        </a>

    </form>

<?php endif; ?>


<?php require_once "../includes/footer.php"; ?>
