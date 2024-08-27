<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_completo = trim($_POST['nombre_completo']);
    $username = trim($_POST['username']);
    $correo = trim($_POST['correo']);
    $contrasena = trim($_POST['contrasena']);

    // Validar la entrada
    if (empty($nombre_completo)|| empty($username) || empty($correo) || empty($contrasena)) {
        die('Por favor, complete todos los campos.');
    }

    // Hashear la contraseña
    $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

    // Conectar a la base de datos
    include "./conexionbs.php";

    // Insertar el nuevo usuario
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre_completo, username, correo, contrasena) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre_completo, $username, $correo, $hashed_password);
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
    <form action="./crearcuenta.php" method="post">
        <label for="nombre_completo">Nombre:</label>
        <input type="text" name="nombre_completo" id="nombre_completo" required><br>
        <label for="username">Nombre de usuario:</label>
        <input type="text" name="username" id="username" required><br>
        <label for="correo">Correo electronico:</label>
        <input type="text" name="correo" id="correo" required><br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" required><br>
        <input type="submit" value="Registrarse">
    </form>
</body>
</html>
