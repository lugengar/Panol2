<?php
include "./codigophp/sesion.php";
include "./codigophp/conexionbs.php";
include "codigophp/añadirpaleta.php";


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
    <div id="pagina2">
        <div id="header">
           <a href="inicio.php" class="imagen"><?php incrustarSVG("imagenes/SVG/logo"); ?></a>
            <button class="imagen" id="user"><?php incrustarSVG("imagenes/SVG/user"); ?></button>
        </div>
        
        <div id="contenidob">
            <form action="buscarherramienta.php" method="post">
                <button class="barra" type="submit">
                    <div class="mas"></div>
                    <div>AÑADIR HERRAMIENTA</div>
                    <div></div>
                    <input type="hidden" value="" name="busqueda">
                    <input type="hidden" value="" name="aula">
                    <input type="hidden" value="" name="curso">
                </button>
            </form>
            <div class="contenido2">
                <div class="con3" id="inicio">
                    <h1>INFORMACIÓN DEL PEDIDO</h1>
                    <div class="scroll-y" id="scroll" style="height: 100%; ">
                        <form method="post" action="./codigophp/crearpedido.php" id="formulario">
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $estado = isset($_POST['estado']) ? trim($_POST['estado']) : '';
                            if (isset($_POST["codigo"])) {
                                if ($_POST["codigo"] == 1) {
                                    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
                                    $cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']) : 0;
                                    if (isset($_SESSION['pedido'])) {
                                        $pedido = $_SESSION['pedido'];
                                        $index = array_search($id, $pedido['herramientas']);
                                        if ($index !== false) {
                                            $pedido['cantidad'][$index] = $cantidad;
                                        } else {
                                            $pedido['herramientas'][] = $id;
                                            $pedido['cantidad'][] = $cantidad;
                                        }
                                    } else {
                                        $pedido = array(
                                            'herramientas' => array($id),
                                            'cantidad' => array($cantidad)
                                        );
                                    }
                                    $_SESSION['pedido'] = $pedido;
                                } else {
                                    $_SESSION['pedido'] = isset($_POST['pedido']) ? json_decode($_POST['pedido'], true) : null;
                                }
                            }
                        }
                        $fechaHoraActual = date('Y-m-d H:i:s');
                        echo '<div class="conscroll-y" ><div class="signomas imagen boton"><select name="curso" ><option value="">Elija un curso</option>';
                        $sql = "SELECT * FROM cursos";
                        $result = mysqli_query($conn, $sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="'.$row["id"].'">'.$row["curso"].'</option>';
                            }
                        }
                        echo '</select></div>';
                        echo '<div class="mapa imagen boton"><select name="aula" ><option value="">Elija un aula</option>';
                        $sql = "SELECT * FROM aulas";
                        $result = mysqli_query($conn, $sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="'.$row["id_aulas"].'">'.$row["nombre"].'</option>';
                            }
                        }
                        echo '</select></div>';
                        echo '<div class="signomas imagen boton"><input type="text" name="horario" value="' . $fechaHoraActual . '" readonly></div></div>';

                        if (empty($_SESSION['pedido'])) {
                            echo "<h1>NO HAY HERRAMIENTAS AUN</h1>";
                        } else {
                            $herramientas_ids = $_SESSION['pedido']['herramientas'];
                            $cantidad_pedido = $_SESSION['pedido']['cantidad'];
                            if (!empty($herramientas_ids)) {
                                $sql = "SELECT * FROM herramientas WHERE herramientas.id IN (" . implode(",", array_map('intval', $herramientas_ids)) . ")";
                                $result = mysqli_query($conn, $sql);
                                if ($result->num_rows > 0) {
                                    echo '<h1>HERRAMIENTAS</h1><div class="conscroll-y" >';
                                    foreach ($result as $index => $row) {
                                        $cantidad = isset($cantidad_pedido[$index]) ? $cantidad_pedido[$index] : 0;
                                        if ($cantidad >= $row["cantidad"]) {
                                            echo '<div class="rectangulo2"><h1>'.$row["nombre"].'</h1> <p style="color:red;">Stock: '.$cantidad.'/'.$row["cantidad"].'</p> <input type="hidden" value="'.$cantidad.'" min="1" max="'.$row["cantidad"].'" required><a class="imagen opciones"></a></div>';
                                        } else {
                                            echo '<div class="rectangulo2"><h1>'.$row["nombre"].'</h1> <p>Stock: '.$cantidad.'/'.$row["cantidad"].'</p> <input type="hidden"  value="'.$cantidad.'" min="1" max="'.$row["cantidad"].'" required> <a onclick="console.log(\'a\')" class="imagen opciones"></a></div>';
                                        }
                                    }
                                    echo'</div>';
                                } else {
                                    echo "<h1>NO HAY HERRAMIENTAS AUN</h1> <input type='hidden'>";
                                }
                            } else {
                                echo "<h1>NO HAY HERRAMIENTAS AUN</h1>";
                            }
                            $conn->close();
                        }
                        ?>
                       
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer">
            <a href="pedidos.php" class="flecha imagen izquierda i">Volver</a>
            <a onclick="document.getElementById('formulario').submit()" class=" imagen derecha borde2 i">Enviar pedido<?php incrustarSVG("imagenes/SVG/avion"); ?></a>
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
                            <form action="./pedido.php" method="post">
                                <input type="text" style="display:none;" name="codigo" value="2">
                                <input type="text" style="display:none;" name="estado" value="2">
                                <input type="text" style="display:none;" name="pedido" value='{"herramientas": [1,2],"cantidad": [10,2]}'>
                                <input type="submit" class="basura imagen boton" style="padding-left: 5vh;" value="Eliminar herramienta">
                            </form>       
                            <form action="./pedido.php" method="post">
                                <input type="text" style="display:none;" name="estado" value="2">
                                <input type="text" style="display:none;" name="codigo" value="2">
                                <input type="text" style="display:none;" name="pedido" value='{"herramientas": [1,2],"cantidad": [10,2]}'>
                                <input type="submit" class="signomas imagen boton" style="padding-left: 5vh;" value="Editar cantidad">
                            </form>    
                            <form action="./pedido.php" method="post">
                                <input type="text" style="display:none;" name="codigo" value="2">
                                <input type="text" style="display:none;" name="estado" value="2">
                                <input type="text" style="display:none;" name="pedido" value='{"herramientas": [1,2],"cantidad": [10,2]}'>
                                <input type="submit" class="intercambio imagen boton" style="padding-left: 5vh;" value="Reemplazar">
                            </form>      
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
</body>
</html>

<script src="codigojs/sombra2.js"></script>
<script src="codigojs/sombra.js"></script>
<script src="codigojs/volveratras.js"></script>
