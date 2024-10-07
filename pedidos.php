<?php
include "./codigophp/sesion.php";
include "codigophp/conexionbs.php";
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
    <div id="pagina">
        <div id="header">
           <a href="inicio.php" class="imagen"><?php incrustarSVG("imagenes/SVG/logo"); ?></a>
           <button class="imagen" id="user"><?php incrustarSVG("imagenes/SVG/user"); ?></button>
        </div>
        <div id="subheader">
            <h1>Historial de pedidos de <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            <p></p>
        </div>
        <div id="contenido">
            <form action="pedido.php" method="post">
                <button class="barra" type="submit">
                    <div class="mas"></div>
                        <div>Crear nuevo pedido</div>
                        <div></div>
                        <input type="text" value="nuevopedido" name="estado" style="display:none;">
                        <input type="text" style="display:none;" name="codigo" value="0">
                        <input type="text" value="" name="pedido" style="display:none;">
                </button>
            </form>
            <div class="contenido2">
                <div class="con3" id="inicio">
                    <h1>HISTORIAL DE PEDIDOS</h1>
                    <div class="scroll-y"  id="scroll" style="height: 100%;">
                        <div class="conscroll-y">
                            <?php
                               $sql = "SELECT pedidos.*, aulas.*, cursos.*, usuarios.*
                                FROM pedidos
                                JOIN aulas ON pedidos.id_aula = aulas.id_aulas
                                JOIN cursos ON pedidos.fk_curso = cursos.id
                                JOIN usuarios ON pedidos.fk_usuario = usuarios.id_usuario 
                                WHERE pedidos.fk_usuario = ?";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $_SESSION['id_usuario']); 
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="rectangulo2"><h1>'.$row["fecha_pedido"].'</h1> <p>Estado: '.$row["estado"].'<br>Salón: '.$row["nombre"].'</p> <input type="hidden" name="id" id="id" value="'.$row["id_pedido"].'"><input type="hidden" name="estado" id="estado" value="'.$row["estado"].'"><input type="hidden" name="pedido" id="pedido" value="'.htmlspecialchars($row["pedido"],ENT_QUOTES, 'UTF-8').'"> <button class="imagen opciones tocar">'; incrustarSVG("imagenes/SVG/ojo"); echo '</button></div>';
                        }
                    } else {
                        echo "<h1>NO HAY PEDIDOS AUN</h1>";
                    }
                    
                    $stmt->close();
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
            <a href="inicio.php" class=" imagen centro i">Volver al inicio<?php incrustarSVG("imagenes/SVG/flecha"); ?></a>
            <a href="reportes.php" class=" imagen derecha i">Reportes<?php incrustarSVG("imagenes/SVG/alerta"); ?></a>
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
                            <form>
                                <input type="hidden"  name="pedido" id="elim" value="2">
                                <input type="hidden"  name="estado" id="estadop" value="pendiente">
                            </form>
                            <form action = "./pedido.php" method = "post">
                                <input type="hidden"  name="estado" value="2">
                                <input type="hidden"  name="codigo" value="0">
                                <input type="hidden" name="pedido" id="ver" value="">
                                <div class="imagen divinput i">
                                    <input type = "submit" class="ojo imagen boton" style=" padding-left: 5vh;" value="Ver pedido">
                                    <?php incrustarSVG("imagenes/SVG/ojo"); ?>
                                </div>
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
                <div class="equis" ></div>
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
<script> 
opciones = document.querySelectorAll('.tocar');
opcionequis = document.getElementById("opcionequis");
sombra = document.getElementById("sombra");

click = true;
som = false;

function aplicarBlur() {
    if (click == true) {
        sombra.style.display = "grid";
        sombra.style.animation = "sombra both 0.5s";
    }
}

function sacarBlur() {
    if (click == true) {
        click = false;
        sombra.style.animation = "sacarsombra both 0.5s";
    }
}

sombra.addEventListener('animationend', function handleAnimationEnd() {
    if (som == true) {
        som = false;
        sombra.style.display = "none";
    } else {
        som = true;
    }
    click = true;
});

opciones.forEach(element => {
    element.addEventListener('click', () => {
        let parentNode = element.parentNode;
        let pedido = parentNode.querySelector("#pedido").value;
        let estado = parentNode.querySelector("#estado").value;
        let id = parentNode.querySelector("#id").value;
        document.getElementById("elim").value = id;
        document.getElementById("ver").value = pedido;
        document.getElementById("estadop").value = pedido;
        aplicarBlur();
    });
});

opcionequis.addEventListener('click', sacarBlur);
</script>
<script src="codigojs/sombra2.js"></script>
