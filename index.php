<?php
// dashboard.php
session_start();

/*if (isset($_SESSION['id_usuario'])) {
    header("Location: ./inicio.php");
    exit;
}*/
include "./codigophp/conexionbs.php";

    include "./codigophp/añadirpaleta.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="estiloscss/animaciones.css">
    <link rel="stylesheet" href="estiloscss/styles.css">
    <link rel="stylesheet" href="estiloscss/imagenes.css">
</head>
<body>
    <div id="pagina3">
        <div id="header">
            <a class="imagen"> <?php incrustarSVG("imagenes/SVG/logo"); ?></a>
            <div></div>
        </div>
        <div id="subheader2" style="background-size:20vh;background-position:bottom; box-shadow:none;" class="imagen"> <?php incrustarSVG("imagenes/SVG/user"); ?>
        </div>
        
        <div id="contenido" style="background-color:transparent; box-shadow:none;">
        <div class="contenido2">
                <div class="con3" id="inicio">
                    <h1 style="color:white;">Iniciar sesión</h1>
                    <div class="scroll-y" id="scroll" style="height: 100%; width:40vh; padding-top: 2vh;">
                        <form class="conscroll-y" method="post"  action="codigophp/iniciosesion.php" method="post">
                            <div class="imagen divinput i"> <input type="text" class=" boton " name="username" id="username" required placeHolder="Nombre"><?php incrustarSVG("imagenes/SVG/signomas"); ?></div>
                            <div class="imagen divinput i"> <input type="password" class="signomas boton imagen" name="password" id="password" required  placeHolder="Contraseña"><?php incrustarSVG("imagenes/SVG/ojo"); ?></div>
                            <div class="imagen divinput i"> <input type="submit" class="avion boton imagen borde" style="background-color: transparent;" value="Iniciar sesión">   <?php incrustarSVG("imagenes/SVG/avion"); ?></div> 
                        </form>
                        
                    </div>
                </div>
            </div>
        
        </div>

    </div>
   
</body>
</html>

