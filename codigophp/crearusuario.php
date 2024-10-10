<?php
session_start(); // Iniciar sesión

// Verificar si el usuario ha iniciado sesión y si tiene el cargo de "admin"
if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] !== 'admin') {
    // Si no está logueado o su cargo no es admin, redirigir al formulario de login
    header("Location: admin.php");
    exit();
}

// El usuario es admin, continuar mostrando el formulario de creación de usuario
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Crear Usuario</title>
</head>
<body>
    <h1>Formulario de Creación de Usuario</h1>

    <form action="crearusuario.php" method="POST" enctype="multipart/form-data" style="width: 50vh; margin-left: 5vh; margin-top: 5vh;">
        <!-- El formulario para crear un nuevo usuario -->
        <div class="mb-3">
            <label for="nombre_completo" class="form-label">Nombre Completo:</label>
            <input type="text" name="nombre_completo" id="nombre_completo" required class="form-control"><br>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Nombre de Usuario:</label>
            <input type="text" name="username" id="username" class="form-control" required><br>
        </div>

        <div class="mb-3">
            <label for="correo" class="form-label">Correo Electrónico:</label>
            <input type="email" name="correo" id="correo" class="form-control" required><br>
        </div>

        <div class="mb-3">
            <label for="contrasena" class="form-label">Contraseña:</label>
            <input type="password" name="contrasena" id="contrasena" class="form-control" required><br>
        </div>

        <div class="mb-3">
            <label for="cargo" class="form-label">Cargo:</label>
            <select type="text" name="cargo" id="cargo" class="form-control" required>
                <option value="panolero">Pañolero</option>
                <option value="encargado_panol">Encargado del pañol</option>
            </select><br>
        </div>

        <div class="mb-3">
            <label for="foto_perfil" class="form-label">Foto de Perfil:</label>
            <input type="file" name="foto_perfil" id="foto_perfil" class="form-control"><br>
        </div>

        <button type="submit" value="Crear Usuario" class="btn btn-primary">Crear usuario</button>
    </form>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_completo = trim($_POST['nombre_completo']);
    $username = trim($_POST['username']);
    $correo = trim($_POST['correo']);
    $contrasena = trim($_POST['contrasena']);
    $cargo = trim($_POST['cargo']);

    // Validar la entrada
    if (empty($nombre_completo) || empty($username) || empty($correo) || empty($contrasena) || empty($cargo)) {
        die('Por favor, complete todos los campos.');
    }

    // Hashear la contraseña
    $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

    // Conectar a la base de datos
    include "./conexionbs.php";
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == 0) {
        $nombre_aleatorio = uniqid(). '.'. pathinfo($_FILES['foto_perfil']['name'], PATHINFO_EXTENSION);
        $guardar_imagen = '../imagenes/fotosperfil/'. $nombre_aleatorio;
        $ruta_imagen = './imagenes/fotosperfil/'. $nombre_aleatorio;
        move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $guardar_imagen);
    } else {
        $guardar_imagen = '';
    }

    // Insertar el nuevo usuario
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre_completo, username, correo, contrasena, cargo, fotoperfil) VALUES (?,?,?,?,?,?)");
    $stmt->bind_param("ssssss", $nombre_completo, $username, $correo, $hashed_password, $cargo, $ruta_imagen);
    $stmt->execute();

    if ($stmt->affected_rows === 1) {
        echo "Registro exitoso.";
    } else {
        echo "Error en el registro.";
    }

    $stmt->close();
    $conn->close();
}
?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>



