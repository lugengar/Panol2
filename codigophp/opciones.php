<?php
session_start(); // Iniciar sesión

// Verificar si el usuario es "admin"
if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] !== 'admin') {
    header("Location: admin.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opciones de Administrador</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['username']; ?> (Administrador)</h1>
    <p>Por favor, selecciona una de las siguientes opciones:</p>

    <form action="opciones.php" method="POST">
        <button type="submit" name="accion" value="crearusuario">Crear Usuario</button>
        <button type="submit" name="accion" value="anadirherramientas">Añadir Herramientas</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_POST['accion'] === 'crearusuario') {
            // Redirigir a la creación de usuarios
            header("Location: crearusuario.php");
            exit();
        } elseif ($_POST['accion'] === 'anadirherramientas') {
            // Redirigir a añadir herramientas
            header("Location: anadirherramientas.php");
            exit();
        }
    }
    ?>
</body>
</html>
