<?php
session_start(); // Iniciar sesión

// Verificar si el usuario es "admin"
if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] !== 'admin') {
    header("Location: admin.php");
    exit();
}

?>


<?php

include './conexionbs.php';
include './añadirpaleta.php';

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
    <link rel="stylesheet" href="../estiloscss/styles.css">
    <link rel="stylesheet" href="../estiloscss/imagenes.css">
    <link rel="stylesheet" href="../estiloscss/animaciones.css">
</head>

<body>

    <div id="pagina">
        <div id="header">
            <a href="inicio.php" class="imagen"><?php incrustarSVG("../imagenes/SVG/logo"); ?></a>

            <button class="imagen" id="user"><?php incrustarSVG("../imagenes/SVG/user"); ?></button>


        </div>
        <div id="subheader">
            <h1>Bienvenido <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            <p></p>
        </div>
        <div id="contenido">
            
            <div class="contenido2">
                <div class="con3" id="inicio">
                    <h1>OPCIONES</h1>
                    <div class="conscroll-y">

                    <a href="./crearusuario.php" class="i imagen boton">Crear Usuario<?php incrustarSVG("../imagenes/SVG/signomas"); ?></a>
                    <a href="./anadirherramientas.php" class="i imagen boton">Añadir Herramientas<?php incrustarSVG("../imagenes/SVG/signomas"); ?></a>
</div>
    
                </div>
            </div>
        </div>
        <div id="footer">
          
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
                                <a href="./cerrarsesion.php" class="i imagen boton">Cerrar sesión<?php incrustarSVG("../imagenes/SVG/flecha"); ?></a>
                                <a href="./crearpaleta.php" class="i imagen boton">Cambiar colores <?php incrustarSVG("../imagenes/SVG/intercambio"); ?></a>
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
<script src="../codigojs/sombra2.js"></script>
