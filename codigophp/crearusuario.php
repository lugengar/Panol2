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
        $ruta_imagen = '../estiloscss/imagenes/fotosperfil/'. $nombre_aleatorio;
        move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $ruta_imagen);
    } else {
        $ruta_imagen = '';
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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>
    <form action="./crearusuario.php" method="post" enctype="multipart/form-data">
        <label for="nombre_completo">Nombre:</label>
        <input type="text" name="nombre_completo" id="nombre_completo" required><br>
        <label for="username">Nombre de usuario:</label>
        <input type="text" name="username" id="username" required><br>
        <label for="cargo">Cargo:</label>
        <select name="cargo" id="cargo">
            <option value="usuario">Usuario</option>
            <option value="panolero">Pañolero</option>
            <option value="encargado_panol">Encargado de pañol</option>
        </select><br>
        <label for="correo">Correo electronico:</label>
        <input type="text" name="correo" id="correo" required><br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" required><br>
        <label for="foto_perfil">Foto de perfil:</label>
        <input type="file" name="foto_perfil" id="foto_perfil"><br>
        <input type="submit" value="Registrarse">
    </form>
</body>
</html>