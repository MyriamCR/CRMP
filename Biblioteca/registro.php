<?php

// Incluir los archivos necesarios
require_once "config/auth.php";
require_once "config/conexion.php";

// las variables para mensajes
$mensaje = "";
$tipoMensaje = "";


//comprobar si se envio el  formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // recuperar  datos del formulario
    $nombre = trim($_POST["nombre"]);
    $correo = trim($_POST["correo"]);
    $telefono = trim($_POST["telefono"]);
    $password = $_POST["password"];
    $confirmarPassword = $_POST["confirmar_password"];


    //checar que los campos no  esten vacios
    if ($nombre == "" || $correo == "" || $telefono == "" ||
        $password == "" || $confirmarPassword == "") {

        $mensaje = "Todos los campos son obligatorios.";
        $tipoMensaje = "danger";

    // validar el formato del correo
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {

        $mensaje = "Ingresa un correo electronico valido.";
        $tipoMensaje = "danger";

    //   Comprobar que las contraseñas coincidan
    } elseif ($password != $confirmarPassword) {

        $mensaje = "Las contraseñas no coinciden.";
        $tipoMensaje = "danger";

    } else {

            // checar si el correo ya esta registrado
        $sql = "SELECT id_usuario FROM usuarios WHERE correo = :correo";

        $consulta = $conexion->prepare($sql);
        $consulta->execute(["correo" => $correo]);

        $usuarioExistente = $consulta->fetch(PDO::FETCH_ASSOC);

         //mensaje si el correo ya existe
        if ($usuarioExistente) {

            $mensaje = "Este correo ya se encuentra registrado.";
            $tipoMensaje = "danger";
        } else {

            //se  encripta la contraseña mediante hash
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            //prepparamos para registrar al nuevo usuario
            $sql = "INSERT INTO usuarios
                    (nombre, correo, telefono, password_hash, rol)
                    VALUES
                    (:nombre, :correo, :telefono, :password_hash, :rol)";

            $consulta = $conexion->prepare($sql);

            //ejecutar el registro asignando 
            $consulta->execute([
                "nombre" => $nombre,
                "correo" => $correo,
                "telefono" => $telefono,
                "password_hash" => $passwordHash,
                "rol" => "usuario"
            ]);

            // dirigir al inicio de sesion
            header("Location: login.php");
            exit;
        }
    }
}

//poner navbar
require_once "includes/header.php";

?>

<!-- html para la pestaña-->
<div class="container">

    <h1>Crear cuenta</h1>
    <hr>

    <!-- Mostrar mensaje -->
    <?php if ($mensaje != ""): ?>
        <div class="alert alert-<?= $tipoMensaje ?>">
            <?= htmlspecialchars($mensaje); ?>
        </div>
    <?php endif; ?>


    <!--Formulario  -->
    <form action="registro.php" method="POST" class="formulario">

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingresa tu nombre" required>
        </div>

        <div class="mb-3"> 
            <label for="correo" class="form-label">Correo electrónico</label>
            <input type="email" name="correo" id="correo" class="form-control"
                placeholder="Ingresa tu correo" required>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="tel" name="telefono" id="telefono" class="form-control"
                placeholder="Ingresa tu teléfono" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" id="password"
                class="form-control" placeholder="Crea una contraseña" required>
        </div>

        <div class="mb-3">
            <label for="confirmar_password" class="form-label">Confirmar contraseña</label>
            <input type="password" name="confirmar_password" id="confirmar_password" class="form-control"
                placeholder="Confirma tu contraseña" required>
        </div>

        <button type="submit" class="btn-outline theme-primary">
            Registrarse
        </button>

    </form>

    <hr>

    <p>
        ¿Ya tienes cuenta?
        <a href="login.php">Inicia sesión</a>
    </p>

</div>

<?php require_once "includes/footer.php"; ?>
