<?php
require_once "config/auth.php";
require_once "config/conexion.php";


$mensaje = "";

 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // recuperar  datos del  formulario
    $correo = trim($_POST["correo"]);
    $password = $_POST["password"];

    // buscar al usuario por su correo
    $sql = "SELECT * FROM usuarios
            WHERE correo = :correo";

    $consulta = $conexion->prepare($sql);
    $consulta->execute(["correo" => $correo]);
    // recuperar los datos del usuario
    $usuario = $consulta->fetch(PDO::FETCH_ASSOC);


    //comprobar si  el usuario existe y la contraseña es correcta
    if ($usuario && password_verify($password, $usuario["password_hash"])) {

        // Guardar  datos del usuario en la sesión
        $_SESSION["id_usuario"] = $usuario["id_usuario"];
        $_SESSION["usuario"] = $usuario["nombre"];
        $_SESSION["rol"] = $usuario["rol"];


        //generar id  de sesion
        session_regenerate_id(true);

        header("Location: dashboard.php");
        exit;

    } else {
        $mensaje = "Correo o contraseña incorrectos.";
    }
}

// navbar
require_once "includes/header.php";
?>

<!-- inicio de sesion-->
<div class="container">

    <h1>Iniciar sesión</h1>
    <hr>

    <!--mensaje de error -->
    <?php if ($mensaje != ""): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($mensaje); ?>
        </div>
    <?php endif; ?>

    <!--formulario-->

    <form action="login.php" method="POST" class="formulario">

        <div class="mb-3">
            <label for="correo" class="form-label">
                Correo electrónico
            </label>
            <input type="email" name="correo" id="correo"
                class="form-control" placeholder="Ingresa tu correo" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">
                Contraseña
            </label>
            <input type="password" name="password" id="password"
                class="form-control" placeholder="Ingresa tu contraseña" required>
        </div>

        <button type="submit" class="btn-outline theme-primary">
            Iniciar sesión
        </button>

    </form>

    <hr>

    <p>¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>

</div>

<?php require_once "includes/footer.php"; ?>
