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
            $ruta_imagen = '../estiloscss/imagenes/herramientas/'. $nombre_aleatorio;
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir herramientas</title>
</head>
<body>
    <form action="./anadirherramientas.php" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre de herramienta:</label><br>
        <input type="text" id="nombre" name="nombre"><br><br>
        <label for="descripcion">Descripción de herramienta:</label>
        <textarea id="descripcion" name="descripcion"></textarea><br><br>
        <label for="imagen">Imagen de la herramienta:</label>
        <input type="file" name="imagen" id="imagen"><br><br>
        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad"><br><br>
        <input type="submit" value="Añadir herramienta">
    </form>
</body>
</html>