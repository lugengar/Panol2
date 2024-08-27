<?php
include "./codigophp/sesion.php";
include './codigophp/conexionbs.php';
include './codigophp/añadirpaleta.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
    <link rel="stylesheet" href="estiloscss/styles.css">
    <link rel="stylesheet" href="estiloscss/animaciones.css">
    <link rel="stylesheet" href="estiloscss/imagenes.css">
</head>
<body>
    <div id="pagina">
        <div id="header">
            <a href="inicio.php" class="logo imagen"></a>
            <button  class="usuario imagen" id="user"></button>
        </div>
        <div id="subheader">
            <h1>Pedidos de hoy para <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            <p></p>
        </div>
        <div id="contenido">
            <div class="barra">
                <button class="equis"></button>
                <input type="text" placeholder="Buscar..">
                <div></div>
            </div>
            <div class="contenido2">
                <div class="con3" id="inicio">
                <h1>PEDIDOS DE HOY</h1>
                    <div class="scroll-y" id="scroll" style="height: 100%;">
                        <div class="conscroll-y" style="height: 100%;">
                            <?php
                                $sql = "SELECT pedidos.*, aulas.*, cursos.*, usuarios.*
                                FROM pedidos
                                JOIN aulas ON pedidos.id_aula = aulas.id_aulas
                                JOIN cursos ON pedidos.fk_curso = cursos.id
                                JOIN usuarios ON pedidos.fk_usuario = usuarios.id_usuario
                            
                                ORDER BY pedidos.fecha_pedido DESC;
                                ";  
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        if (date('Y-m-d') == date('Y-m-d', strtotime($row["fecha_pedido"])) && $row["estado"] == "pendiente") {
                                            echo '<div class="rectangulo4 verde"><h1>'.$row["fecha_pedido"].' '.$row["estado"].'</h1> <p>Aula: '.$row["nombre"].'<br>Curso:'.$row["curso"].' </p> <input type="hidden" name="id" id="id" value="'.$row["id_pedido"].'"><input type="hidden" name="estado" id="estado" value="'.$row["estado"].'"><input type="hidden" name="pedido" id="pedido" value="'.htmlspecialchars($row["pedido"],ENT_QUOTES, 'UTF-8').'"> <button class="imagen opcionesblanco tocar"></button></div>';
                                        }else{
                                            echo '<div class="rectangulo2"><h1>'.$row["fecha_pedido"].'</h1> <p>'.$row["nombre"].' - '.$row["username"].'<br><strong> Estado: </strong>'.$row["estado"].'</p> <input type="hidden" name="id" id="id" value="'.$row["id_pedido"].'"><input type="hidden" name="estado" id="estado" value="'.$row["estado"].'"><input type="hidden" name="pedido" id="pedido" value="'.htmlspecialchars($row["pedido"],ENT_QUOTES, 'UTF-8').'"> <button class="imagen opciones tocar"></button></div>';
                                        }
                                    }
                                } else {
                                    echo "<h1>NO HAY PEDIDOS AUN</h1>";
                                }
                                $conn->close();
                            ?>          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer">
            <a href="inicio.php" class="flecha imagen izquierda">Volver al inicio</a>
            <a href="pedidos.php" class="logoboton imagen centro">Herramientas</a>
            <a href="reportes.php" class="alerta imagen derecha">Reportes</a>
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
                            <form action = "./codigophp/borrarpedido.php" method = "post">
                                <input type="hidden"  name="pedido" id="elim" value="2">
                                <input type="hidden"  name="pedido" id="estadop" value="pendiente">
                                <input type="submit" class="alerta imagen boton" style=" padding-left: 5vh;" value="Cancelar pedido">
                            </form>
                            <form action = "./pedido.php" method = "post">
                                <input type="hidden"  name="estado" value="2">
                                <input type="hidden"  name="codigo" value="0">
                                <input type="hidden" name="pedido" id="ver" value="">
                                <input type="submit" class="logoboton imagen boton" style=" padding-left: 5vh;" value="Preparar pedido">
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
