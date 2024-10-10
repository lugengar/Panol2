<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    include "./conexionbs.php";

    $sql = "SELECT username, contrasena, cargo FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($db_username, $db_password, $db_cargo);
        $stmt->fetch();

        if (password_verify($password, $db_password)) {
            $_SESSION['username'] = $db_username;
            $_SESSION['cargo'] = $db_cargo;

            if ($db_cargo === 'admin') {
                header("Location: opciones.php");
                exit();
            } else {
                echo "Acceso denegado: Solo los administradores pueden acceder.";
            }
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }

    $stmt->close();
    $conn->close();
}
?>


<?php
// dashboard.php
session_start();

/*if (isset($_SESSION['id_usuario'])) {
    header("Location: ./inicio.php");
    exit;
}*/
include "./conexionbs.php";

    include "./añadirpaleta.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="../estiloscss/animaciones.css">
    <link rel="stylesheet" href="../estiloscss/styles.css">
    <link rel="stylesheet" href="../estiloscss/imagenes.css">
</head>
<body>
    <div id="pagina3">
        <div id="header">
            <a class="imagen"> <?php incrustarSVG("../imagenes/SVG/logo"); ?></a>
            <div></div>
        </div>
        <div id="subheader2" style="background-size:20vh;background-position:bottom; box-shadow:none;" class="imagen"> <?php incrustarSVG("../imagenes/SVG/user"); ?>
        </div>
        
        <div id="contenido" style="background-color:transparent; box-shadow:none;">
        <div class="contenido2">
                <div class="con3" id="inicio">
                    <h1 style="color: var(--letra_blanco);">Iniciar sesión</h1>
                    <div class="scroll-y" id="scroll" style="height: 100%; width:40vh; padding-top: 2vh;">
                        <form class="conscroll-y" method="post"  action="./admin.php" method="post">
                            <div class="imagen divinput i"> <input type="text" class=" boton " name="username" id="username" required placeHolder="Nombre"><?php incrustarSVG("../imagenes/SVG/signomas"); ?></div>
                            <div class="imagen divinput i"> <input type="password" class="signomas boton imagen" name="password" id="password" required  placeHolder="Contraseña"><?php incrustarSVG("../imagenes/SVG/ojo"); ?></div>
                            <div class="imagen divinput i"> <input type="submit" class="avion boton imagen borde" style="background-color: transparent;" value="Iniciar sesión">   <?php incrustarSVG("../imagenes/SVG/avion"); ?></div> 
                        </form>
                        
                    </div>
                </div>
            </div>
        
        </div>

    </div>
   
</body>
</html>

