<?php
session_start();
if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] !== 'admin') {
    header("Location: admin.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Añadir herramientas</title>
</head>
<body>
    <form action="./anadirherramientas.php" method="post" enctype="multipart/form-data" style="width: 50vh; margin-left: 5vh; margin-top: 5vh;">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de herramienta:</label>
            <input type="text" id="nombre" name="nombre" class="form-control"><br>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción de herramienta:</label>
            <textarea id="descripcion" name="descripcion" class="form-control"></textarea><br>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen de la herramienta:</label>
            <input type="file" name="imagen" id="imagen" class="form-control"><br>
        </div>
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" class="form-control"><br>
        </div>
        <input type="submit" value="Añadir herramienta" class="btn btn-primary">
    </form>
    <?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $cantidad = trim($_POST['cantidad']);

    if (empty($nombre) || empty($descripcion) || empty($cantidad)) {
        echo 'Por favor, complete los campos.';
    } else {
        include "./conexionbs.php";
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
            $nombre_aleatorio = uniqid(). '.'. pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
            $ruta_imagen = './imagenes/herramientas/'. $nombre_aleatorio;
            move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen);
        } else {
            $ruta_imagen = '';
        }

        $stmt = $conn->prepare("INSERT INTO herramientas (nombre, descripcion, imagen, cantidad) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $descripcion, $ruta_imagen, $cantidad);
        $stmt->execute();

        if ($stmt->affected_rows === 1) {
            echo "Herramienta añadida.";
        } else {
            echo "Error al agregar herramienta.";
        }

        $stmt->close();
        $conn->close();
    }
}

?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>