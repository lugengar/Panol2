<?php
include "./codigophp/sesion.php";
include './codigophp/conexionbs.php';
include "./codigophp/añadirpaleta.php"

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
            <a href="inicio.php" class="logo imagen"></a>

            <button class="usuario imagen" id="user"></button>


        </div>
        <div id="subheader">
            <h1>Bienvenido <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            <p></p>
        </div>
        <div id="contenido">
            <form class="barra" method="get" action="./buscarherramienta.php">
                <input type="submit" class="lupa" value="">
                <input type="text" id="search-input" name="busqueda" placeholder="Buscar..">
                <script></script>
                <div></div>
            </form>
            <div class="contenido2">
                <div class="con3" id="inicio">
                    <h1>HERRAMIENTAS</h1>
                    <div class="scroll-x" id="scroll">
                        <div class="conscroll-x">
                            <?php
                            $sql = "SELECT nombre, descripcion FROM categoria";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<a class="cubo" href="./buscarherramienta.php?busqueda='. $row["nombre"] .'"> <h1>' . $row["nombre"] . '</h1> <p>Descripción: ' . $row["descripcion"] . '</p></a>';
                                }
                            } else {
                                echo '<p>No se encontraron resultados</p>';
                            }
                            ?>
                        </div>
                    </div>
                    <h1>PAÑOLEROS</h1>
                    <div class="scroll-x" id="scroll" style="height: 33vh;">
                        <div class="conscroll-x">
                            <?php
                            $sql = "SELECT nombre_completo, horario, fotoperfil FROM usuarios WHERE cargo = 'panolero' ";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<div class='rectangulo'><button style='background-image:url(". $row["fotoperfil"] .");'></button><h1>" . $row["nombre_completo"] . "<p>" . $row["horario"] . "</p></div>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer">
            <?php
             panol('<a href="notificaciones.php" class="campana imagen izquierda">Ver pedidos</a>'); 
            ?>
            <a href="pedidos.php" class="logoboton imagen centro">Herramientas</a>
            <a href="reportes.php" class="alerta imagen derecha">Reportes</a>
        </div>
        <div id="sombra2" class="sombra">
            <div class="contenidosombra">
                <button class="barra" id="opcionequis2">
                    <div class="equis"></div>
                    <div>Volver</div>
                    <div></div>
                </button>
                <div class="contenido2">
                    <div class="con3" id="inicio">
                        <div class="scroll-y" id="scroll" style="height: 100%; padding-top:2vh;">
                            <div class="conscroll-y">
                                <a href="codigophp/cerrarsesion.php" class="flecha imagen boton">Cerrar sesión</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
<?php $conn->close(); ?>
<script src="./codigojs/sombra2.js"></script>