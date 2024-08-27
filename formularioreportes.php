<?php
include "./codigophp/sesion.php";
include './codigophp/conexionbs.php';
include './codigophp/añadirpaleta.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PĂˇgina de Inicio</title>
    <link rel="stylesheet" href="estiloscss/animaciones.css">
    <link rel="stylesheet" href="estiloscss/styles.css">
    <link rel="stylesheet" href="estiloscss/imagenes.css">
</head>

<body>
    <div id="pagina">
        <div id="header">
            <a href="inicio.php" class="logo imagen"></a>
            <button class="usuario imagen"></button>
        </div>
        <div id="subheader">
            <h1>Lista de reportes de <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
            <p></p>
        </div>
        <div id="contenido">
            <button class="barra">
                <div class="mas"></div>
                <div>Escribir nuevo reporte</div>
                <div></div>
            </button>
            <div class="contenido2">
                <div class="con3" id="inicio">
                    <h1>TUS REPORTES</h1>
                    <div class="scroll-y" id="scroll" style="height: 100%;">
                        <form class="conscroll-y" action="./formularioreportes.php" method="post">
                            <div class="signomas imagen boton"> <select name="pedidos" id="pedidos">
                                    <?php

                                    $query = "SELECT id_pedido FROM pedidos WHERE estado = 'entregado'";


                                    $result = $conn->query($query);

                                    if ($result->num_rows == 0) {
                                        echo '<option disabled selected>No hay pedidos.</option>';
                                    }

                                    if (!$result) {
                                        die("Error executing query: " . $conn->error);
                                    }

                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['id_pedido'] . '">' . $row['id_pedido'] . '</option>';
                                    }
                                    ?>
                                </select></div>

                            <div class="signomas imagen boton"> 
                                <input type="text" placeHolder="" id="observaciones" name="observaciones" maxlength="200" required><br></div>
                            <div class="avion imagen boton"> <input type="submit" value="Crear Reporte"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer">
            <?php
            panol('<a href="notificaciones.php" class="campana imagen izquierda">Ver pedidos</a>');
            ?>
            <a href="pedidos.php" class="logoboton imagen centro">Herramientas</a>
            <a href="inicio.php" class="flecha imagen derecha">Volver al inicio</a>
        </div>
    </div>
</body>

</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $observaciones = $_POST['observaciones'];
    $id_pedido = $_POST['pedidos'];
    $id_usuario = $_SESSION['id_usuario'];

    $sql = "INSERT INTO reportes (id_usuario, id_pedido, observaciones) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("sss", $id_usuario, $id_pedido, $observaciones);

    if ($stmt->execute()) {
        echo "Nuevo reporte creado correctamente.";
    } else {
        echo "Error al crear el reporte: " . $stmt->error;
    }

    $stmt->close();

    $conn->close();

    header("Location: ./reportes.php");
    exit;
}
?>