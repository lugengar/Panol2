<?php
// dashboard.php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ./index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
    <link rel="stylesheet" href="animaciones.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="imagenes.css">
</head>
<body>
    <div id="pagina2">
        <div id="header">
            <a href="inicio.php" class="logo imagen"></a>
            <button class="usuario imagen"></button>
        </div>
        
        <div id="contenido">
            <form action="buscarherramienta.php" method="post">
                <button class="barra" type="submit">
                    <div class="mas"></div>
                        <div>AÑADIR HERRAMIENTA</div>
                        <div></div>
                        <input type="hidden" value="nuevopedido" name="estado">
                        <input type="hidden" value="" name="horario">
                        <input type="hidden" value="" name="aula">
                        <input type="hidden" value="" name="profesor">
                </button>
            </form>
            <div class="contenido2">
                <div class="con3" id="inicio">
                    <h1>INFORMACIÓN DEL PEDIDO</h1>
                    <div class="scroll-y" style="height: 100%;">
                        <form class="conscroll-y" method="post" action="./codigophp/crearpedido.php">
                        <?php

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $tipo = trim($_POST['tipo']);
                            $pedido =  $_POST['pedido'];
                            if($tipo == "nuevopedido"){
                                echo '<div class="rectangulo2"><h1>NOMBRE</h1> <p>ROL CURSO</p> <button class="imagen opciones"></button></div>'
                                echo '<div class="rectangulo2"><h1>AULA</h1> <p>HORARIO</p> <button class="imagen opciones"></button></div>'
                                if($pedido != null){
                                    $sql = "SELECT * FROM pedido INNER JOIN aulas ON pedido.ubicacion_pedido = aulas.id_aulas WHERE pedido.usuario_solicitante = ".$_SESSION['id_usuario'];
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo '<div class="rectangulo2"><h1>'.$row["fecha_pedido"].'</h1> <p>'.$row["nombre"]." ".$row["piso"].'</p> <button class="imagen opciones"></button></div>';
                                        }
                                    } else {
                                        echo "<h1>NO HAY PEDIDOS AUN</h1>";
                                    }
                                }
                            }else{
                                $_SESSION['pedido'] += $_POST['pedido'];
                            }
                        }
                        ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer">
            <a href="notificaciones.php" class="campana imagen izquierda">Notificaciones</a>
            <a onclick="goBack()" class="flecha imagen centro">Volver al inicio</a>
            <a href="reportes.php" class="alerta imagen derecha">Reportes</a>
        </div>
    </div>
    <div id="sombra">
        <div class="contenidosombra">
        <button class="barra">
                <div class="equis"></div>
                    <div>Volver</div>
                    <div></div>
            </button>
            <div class="contenido2">
                <div class="con3" id="inicio">
                    <div class="scroll-y" style="height: 100%; padding-top:2vh;">
                        <div class="conscroll-y">
                                <a onclick="console.log('hola')" class="flecha imagen boton">Volver al inicio</a>                  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
      
    </style>
</body>
</html>

<script src="codigojs/sombra.js"></script>
<script src="codigojs/volveratras.js"></script>
