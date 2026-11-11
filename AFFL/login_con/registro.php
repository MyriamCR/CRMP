<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">
</head>
<body>
    <h1>Registro de usuario</h1>
    <hr>

    <form action="crear_usuario.php" method="post">

        <label class="form-label mb-2">Nombre de usuario:</label>
        <input type="text" class="form-control" id="exampleFormControlInput" name="usuario" required placeholder="">
        <br>
        <label class="form-label mb-2">Contraseña:</label>
        <input type="password" class="form-control" id="exampleFormControlInput" name="password" required placeholder="">

        <br><br>
        <button type="submit" class="btn-outline theme-success">Registrarse</button>
    </form>

    <script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-1a/pXj49ZQ1aHEmrJ+gMw1otqoVsYwlEnlD8mIfY2TV03r20Y0CN7uqx1tQogjPL" crossorigin="anonymous"></script>
</body>
</html>
