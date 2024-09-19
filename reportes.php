<?php
include "./codigophp/sesion.php";
include "./codigophp/conexionbs.php";
include "./codigophp/añadirpaleta.php";

function mostrarReportesSegunCargo() {
    if ($_SESSION['cargo'] == 'panolero') {
        // Mostrar todos los reportes
        return true;
    } elseif ($_SESSION['cargo'] == 'encargado_panol') {
        // Mostrar solo los reportes del propio usuario
        return false;
    }
    return null; // No tiene acceso a reportes
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
    <link rel="stylesheet" href="estiloscss/styles.css">
    <link rel="stylesheet" href="estiloscss/imagenes.css">
    <link rel="stylesheet" href="estiloscss/animaciones.css">
</head>
<body>
    <div id="pagina">
        <div id="header">
           <a href="inicio.php" class="imagen"><?php incrustarSVG("imagenes/SVG/logo"); ?></a>
            <button class="imagen" ><?php incrustarSVG("imagenes/SVG/user"); ?></button>
        </div>
        <div id="subheader">
            <h1>Lista de reportes de <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
            <p></p>
        </div>
        <div id="contenido">
            <button class="barra" onclick="window.location = './formularioreportes.php'">
                <div class="mas"></div>
                    <div>Escribir nuevo reporte</div>
                    <div></div>
            </button>
            <div class="contenido2">
                <div class="con3" id="inicio">
                <h1>TUS REPORTES</h1>
                    <div class="scroll-y" id="scroll" style="height: 100%;">
                        <div class="conscroll-y">  
                            <?php
                                $mostrarTodos = mostrarReportesSegunCargo();
                                $sql = "";

                                if ($mostrarTodos === true) {
                                    $sql = "SELECT reportes.*, usuarios.nombre_completo
                                            FROM reportes
                                            JOIN usuarios ON reportes.id_usuario = usuarios.id_usuario";
                                    $stmt = $conn->prepare($sql);
                                } elseif ($mostrarTodos === false) {
                                    $sql = "SELECT reportes.*, usuarios.nombre_completo 
                                            FROM reportes 
                                            JOIN usuarios ON reportes.id_usuario = usuarios.id_usuario 
                                            WHERE reportes.id_usuario = ?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("s", $_SESSION['id_usuario']);
                                }

                                if ($mostrarTodos !== null) {
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<div class="rectangulo2">';
                                            echo '<h1>' . htmlspecialchars($row["nombre_completo"]) . '</h1>';
                                            echo '<p>' . htmlspecialchars($row["observaciones"]) . '</p>';
                                            echo '<input type="hidden" name="id" id="id" value="' . htmlspecialchars($row["id"]) . '">';
                                            echo '<button class="imagen ojo tocar"></button>';
                                            echo '</div>';
                                        }
                                    } else {
                                        echo "<h1>NO HAY REPORTES AUN</h1>";
                                    }

                                    $stmt->close();
                                } else {
                                    echo "<h1>No tienes permiso para ver reportes.</h1>";
                                }

                                $conn->close();
                            ?>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer">
            <?php
                panol('<a href="notificaciones.php" class="i imagen izquierda">Ver pedidos'.incrustarSVG2("imagenes/SVG/campana").'</a>'); 
            ?>  
            <a href="pedidos.php" class="i imagen centro">Herramientas<?php incrustarSVG("imagenes/SVG/botonlogo"); ?></a>
            <a href="inicio.php" class="i imagen derecha">Volver al inicio<?php incrustarSVG("imagenes/SVG/flecha"); ?></a>
            <?php /*
                if (mostrarReportesSegunCargo() !== null) {
                    echo '<a href="reportes.php" class="i imagen derecha">Reportes'.incrustarSVG2("imagenes/SVG/flecha").'</a>';
                }*/
            ?>
        </div>
    </div>
    <div id="sombra" class="sombra">
        <div class="contenidosombra">
        <button class="barra" id="opcionequis">
                <div class="equis"></div>
                    <div>Volver</div>
                    <div></div>
            </button>
            <div class="contenido2">
                <div class="con3" id="inicio">
                    <div class="scroll-y" id="scroll" style="height: 100%; padding-top:2vh;">
                        <div class="conscroll-y">
                            <form action = "./reportes.php" method = "post">
                                <input type="hidden"  name="reportes" id="elim" value="2">
                                <input type = "submit" class="basura imagen boton" style=" padding-left: 5vh;" value="Eliminar pedido">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>