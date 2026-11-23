<?php
require_once "../config/auth.php";
require_once "../config/conexion.php";


verificarSesion();

$mensaje = "";
$tipoMensaje = "";



// si si  se envio el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener los datos del formulario
    $titulo = trim($_POST["titulo"]);
    $autor = trim($_POST["autor"]);
    $genero = trim($_POST["genero"]);
    $anio = trim($_POST["anio"]);
    $estado = $_POST["estado"];

    //validar que los campos no esten vacios
    if ($titulo == "" || $autor == "" || $genero == "" || $anio == "" || $estado == "") {
        $mensaje = "Todos los campos son obligatorios.";
        $tipoMensaje = "danger";

    //validar que el año sea numerico y mayor que cero
    } elseif (!is_numeric($anio) || $anio <= 0) {
        $mensaje = "Ingresa un año valido.";
        $tipoMensaje = "danger";

    //comprobar que el estado sea valido
    } elseif (!in_array($estado, ["Pendiente", "Leyendo", "Terminado"])) {
        $mensaje = "Selecciona un estado valido.";
        $tipoMensaje = "danger";

    } else {

        // insertar el libro en la base de datos
        $sql = "INSERT INTO libros
                (titulo, autor, genero, anio, estado, id_usuario)
                VALUES
                (:titulo, :autor, :genero, :anio, :estado, :id_usuario)";

        $consulta = $conexion->prepare($sql);
        $consulta->execute([
            "titulo" => $titulo,
            "autor" => $autor,
            "genero" => $genero,
            "anio" => $anio,
            "estado" => $estado,
            "id_usuario" => $_SESSION["id_usuario"]
        ]);

        // regresar a la lista de libros una vez registrado 
        header("Location: index.php");
        exit;
    }
}

// Incluir el encabezado
require_once "../includes/header.php";
?>

<h2>Registrar libro</h2>
<hr>

<?php if ($mensaje != ""): ?>
    <div class="alert alert-<?= $tipoMensaje ?>">
        <?= htmlspecialchars($mensaje) ?>
    </div>
<?php endif; ?>

<form action="crear.php" method="POST">

    <div class="mb-3">
        <label for="floatingTitulo" class="form-label">Título</label>
        <input type="text" name="titulo" class="form-control"
            id="floatingTitulo"
            value="<?= htmlspecialchars($_POST["titulo"] ?? "") ?>" required>
    </div>

    <div class="mb-3">
        <label for="floatingAutor" class="form-label">Autor</label>
        <input type="text" name="autor" class="form-control"
            id="floatingAutor"
            value="<?= htmlspecialchars($_POST["autor"] ?? "") ?>" required>
    </div>

    <div class="mb-3">
        <label for="floatingGenero" class="form-label">Género</label>
        <input type="text" name="genero" class="form-control"
            id="floatingGenero"
            value="<?= htmlspecialchars($_POST["genero"] ?? "") ?>" required>
    </div>

    <div class="mb-3">
        <label for="floatingAnio" class="form-label">Año</label>
        <input type="number" name="anio" class="form-control"
            id="floatingAnio"
            value="<?= htmlspecialchars($_POST["anio"] ?? "") ?>" required>
    </div>

    <div class="mb-3">
        <label for="floatingEstado" class="form-label">Estado</label>
        <select name="estado" class="form-select"
            id="floatingEstado" required>

            <option value="" disabled
                <?= empty($_POST["estado"]) ? "selected" : "" ?>>
                Selecciona un estado
            </option>

            <option value="Pendiente"
                <?= ($_POST["estado"] ?? "") == "Pendiente" ? "selected" : "" ?>>
                Pendiente
            </option>

            <option value="Leyendo"
                <?= ($_POST["estado"] ?? "") == "Leyendo" ? "selected" : "" ?>>
                Leyendo
            </option>

            <option value="Terminado"
                <?= ($_POST["estado"] ?? "") == "Terminado" ? "selected" : "" ?>>
                Terminado
            </option>

        </select>
    </div>

    <button type="submit" class="btn-outline theme-success">
        Crear libro
    </button>

    <a href="index.php" class="btn-outline theme-danger">
        Cancelar
    </a>

</form>

<?php require_once "../includes/footer.php"; ?>