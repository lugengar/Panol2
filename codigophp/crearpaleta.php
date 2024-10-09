
<?php
include "../codigophp/sesion.php";
include '../codigophp/conexionbs.php';

function incrustarSVG($nombreArchivo) {
    
    $rutaArchivoSVG = $nombreArchivo.'.svg';
    
    if (file_exists($rutaArchivoSVG)) {
        $contenidoSVG = file_get_contents($rutaArchivoSVG);
        echo $contenidoSVG;
    } else {
        echo "<p>Error: No se pudo cargar el archivo SVG.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estiloscss/styles.css">
    <link rel="stylesheet" href="../estiloscss/imagenes.css">
    <title>Document</title>
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
                    <h1>Paleta principal</h1>
                        <form action="crearpaleta.php" method="post" class="conscroll-x">
                            <input type="color" class="cubo2" name="color1" value="#4139E6" id="color1">
                            <input type="color" class="cubo2" name="color2" value="#caee52" id="color2">
                            <input type="color" class="cubo2" name="color3" value="#FFFFFF" id="color3">
                            <input type="color" class="cubo2" name="color4" value="#202427" id="color4">
                            
                            <input type="submit" value="enviar" style="width: max-content; heigth: 2dvh; color: var(--letra_blanco); background-color: gray;">
                        </form>
                    </div>
                  
                </div>
            </div>
        </div>
        <div id="footer">
       
            <a href="../inicio.php" class=" imagen derecha i">Volver<?php incrustarSVG("../imagenes/SVG/flecha"); ?></a>
        </div>
    </div>
    
 


</body>
</html>


<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $colores = ["azul" => $_POST["color1"], "amarillo" => $_POST["color2"], "blanco" => $_POST["color3"], "negro" => $_POST["color4"]];
    $colores2 = json_encode($colores, true);

    $sql = "SELECT * FROM `paletas` WHERE fk_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION["id_usuario"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $sql_update = "UPDATE `paletas` SET `colores` = ? WHERE fk_usuario = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ss", $colores2, $_SESSION["id_usuario"]);
        $stmt_update->execute();
        $stmt_update->close();
    } else {
        $sql_insert = "INSERT INTO `paletas`(`colores`, `fk_usuario`) VALUES (?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("ss", $colores2, $_SESSION["id_usuario"]);
        $stmt_insert->execute();
        $stmt_insert->close();
    }

    implementarcolores($colores);
    $stmt->close();
    header("Location: ../inicio.php");
} else {
    $sql = "SELECT * FROM `paletas` WHERE fk_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION["id_usuario"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $colores = json_decode($row["colores"], true);
            implementarcolores($colores);
        }
    } else {
        $colores = ["azul" => "#4139E6", "amarillo" => "#caee52", "blanco" => "#FFFFFF", "negro" => "#202427"];
        implementarcolores($colores);
    }

    $stmt->close();
}

    function implementarcolores($colores){

        echo '
        <style> 
            :root {
                --azul: '.$colores["azul"].';
                --amarillo: '.$colores["amarillo"].';
                --blanco: '.$colores["blanco"].';
                --negro: '.$colores["negro"].';
                --sombra: rgba(0, 0, 0, 0.2);
                --letra_azul: '.$colores["azul"].';
                --letra_amarillo: '.$colores["amarillo"].';
                --letra_blanco: '.$colores["blanco"].';
                --letra_negro: '.$colores["negro"].';
                --letra_rojo: red;
            }
        </style>
        '; 
    }
  
    ?>