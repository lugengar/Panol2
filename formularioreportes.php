<?php
include "./codigophp/sesion.php";
include "./codigophp/conexionbs.php";
include "./codigophp/añadirpaleta.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
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
                            <input type="hidden" id="herramientas" name="herramientas" value="1">
                            <input type="hidden" id="pedidos" name="pedidos" value="1">
                           
                            <div class = "signomas imagen boton"> <input type="text" placeHolder="observaciones" id="observaciones" name="observaciones" maxlength="200" required><br></div>

                            <div class = "avion imagen boton"> <input type="submit" value="Crear Reporte"></div>
                        

                        <script>
                            // Obtener la variable 'herramientas' de la barra de búsqueda
                            const urlParams = new URLSearchParams(window.location.search);
                            const herramientas = urlParams.get('herramientas');
                            const pedidos = urlParams.get('pedidos');
                            // Asignar el valor al input escondido
                            if (herramientas) {
                                document.getElementById('herramientas').value = herramientas;
                            }
                            if (pedidos) {
                                document.getElementById('pedidos').value = pedidos;
                            }
                        </script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer">
            <a href="notificaciones.php" class="campana imagen izquierda">Ver pedidos</a>
            <a href="pedidos.php" class="logoboton imagen centro">Herramientas</a>
            <a href="inicio.php" class="flecha imagen derecha">Volver al inicio</a>
        </div>
    </div>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y limpiar los datos del formulario
    $observaciones = $_POST['observaciones'];
    $id_herramienta = $_POST['herramientas'];
    $id_pedido = $_POST['pedidos'];
    
    // Obtener el id_usuario de la sesión
    $id_usuario = $_SESSION['id_usuario'];
    
    // Crear la consulta SQL usando un prepared statement
    $sql = "INSERT INTO reportes (id_usuario, id_pedido, id_herramienta, observaciones) VALUES (?, ?, ?, ?)";
    
    // Preparar la consulta
    $stmt = $conn->prepare($sql);
    
    // Vincular parámetros
    $stmt->bind_param("ssss", $id_usuario, $id_pedido, $id_herramienta, $observaciones);
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Nuevo reporte creado correctamente.";
    } else {
        echo "Error al crear el reporte: " . $stmt->error;
    }
    
    // Cerrar el statement
    $stmt->close();
    
    // Cerrar la conexión
    $conn->close();
    
    // Redirigir al usuario después de procesar el formulario
    header("Location: ./reportes.php");
    exit;
}
?>
