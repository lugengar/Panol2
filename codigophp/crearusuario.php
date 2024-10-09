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
    <title>Crear Usuario</title>
</head>
<body>
    <h1>Formulario de Creación de Usuario</h1>

    <form action="crearusuario.php" method="POST" enctype="multipart/form-data">
        <!-- El formulario para crear un nuevo usuario -->
        <label for="nombre_completo">Nombre Completo:</label>
        <input type="text" name="nombre_completo" id="nombre_completo" required><br>

        <label for="username">Nombre de Usuario:</label>
        <input type="text" name="username" id="username" required><br>

        <label for="correo">Correo Electrónico:</label>
        <input type="email" name="correo" id="correo" required><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" required><br>

        <label for="cargo">Cargo:</label>
        <input type="text" name="cargo" id="cargo" required><br>

        <label for="foto_perfil">Foto de Perfil:</label>
        <input type="file" name="foto_perfil" id="foto_perfil"><br>

        <input type="submit" value="Crear Usuario">
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
</html>
