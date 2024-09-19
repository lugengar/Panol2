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
            <a href="inicio.php" class="imagen"><?php incrustarSVG("imagenes/SVG/logo"); ?></a>
            <button class="usuario imagen" id="user"></button>
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
                                            $herramientas_ids = $_SESSION['pedido']['herramientas'];
                                            $cantidad_pedido = $_SESSION['pedido']['cantidad'];
                                            $sql_herramientas = "SELECT * FROM herramientas WHERE herramientas.id IN (" . implode(",", array_map('intval', $herramientas_ids)) . ")";
                                            $result_herramientas = $conn->query($sql_herramientas);
                                            if ($result_herramientas->num_rows > 0) {
                                                $herramientas = array();
                                                while($herramienta = $result_herramientas->fetch_assoc()) {
                                                    $herramientas[] = $herramienta['nombre'];
                                                }
                                            } else {
                                                $herramientas = array('No se encontraron herramientas');
                                            }
                                            echo '<div class="rectangulo4 verde"><h1>'.$row["fecha_pedido"].' '.$row["estado"].'</h1> 
                                                  <p>Aula: '.$row["nombre"].'<br>Curso:'.$row["curso"].' 
                                                  <br>Herramientas:';
                                            foreach($herramientas as $herramienta) {
                                                echo '<span>'.$herramienta.'</span>, ';
                                            }
                                            echo '</p> 
                                                  <input type="hidden" name="id" id="id" value="'.$row["id_pedido"].'">
                                                  <input type="hidden" name="estado" id="estado" value="'.$row["estado"].'">
                                                  <input type="hidden" name="pedido" id="pedido" value="'.htmlspecialchars($row["pedido"],ENT_QUOTES, 'UTF-8').'"> 
                                                  <button class="imagen opcionesblanco tocar"></button></div>';
                                        } else {
                                            echo '<div class="rectangulo2"><h1>'.$row["fecha_pedido"].'</h1> <p>'.$row["nombre"].' - '.$row["nombre_completo"].'<br><strong> Estado: </strong>'.$row["estado"].'</p> <input type="hidden" name="id" id="id" value="'.$row["id_pedido"].'"><input type="hidden" name="estado" id="estado" value="'.$row["estado"].'"><input type="hidden" name="pedido" id="pedido" value="'.htmlspecialchars($row["pedido"],ENT_QUOTES, 'UTF-8').'"> <button class="imagen opciones tocar"></button></div>';
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
            <a href="inicio.php" class="imagen izquierda i">Volver al
                inicio<?php incrustarSVG("imagenes/SVG/flecha"); ?></a>
            <a href="pedidos.php"
                class=" imagen centro i">Herramientas<?php incrustarSVG("imagenes/SVG/botonlogo"); ?></a>
            <a href="reportes.php" class=" imagen derecha i">Reportes<?php incrustarSVG("imagenes/SVG/alerta"); ?></a>
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
                                <!-- Aquí agregas la sección para mostrar las herramientas y cantidades -->
                                <div id="detallePedido">
                                    <!-- Este contenido será llenado dinámicamente con JavaScript -->
                                </div>
                                <form action="./codigophp/borrarpedido.php" method="post">
                                    <input type="hidden" name="pedido" id="elim" value="2">
                                    <input type="hidden" name="pedido" id="estadop" value="pendiente">
                                    <input type="submit" class="alerta imagen boton" style="padding-left: 5vh;"
                                        value="Cancelar pedido">
                                </form>
                                <form id="formEstado" action="javascript:void(0);">
                                    <input type="hidden" name="id_pedido" id="idPedido" value="">
                                    <input type="hidden" name="estado" id="nuevoEstado" value="">
                                    <input type="button" class="logoboton imagen boton" style="padding-left: 5vh;"
                                        value="Editar estado" onclick="toggleDropdown()">
                                    <div id="dropdownMenu" class="dropdown-content" style="display: none;">
                                        <a onclick="setEstado('Pendiente')">Pendiente</a>
                                        <a onclick="setEstado('En proceso')">En proceso</a>
                                        <a onclick="setEstado('Enviado')">Enviado</a>
                                        <a onclick="setEstado('Entregado')">Entregado</a>
                                        <a onclick="setEstado('Cancelado')">Cancelado</a>
                                    </div>
                                </form>
                                <script>
                                    function setEstado(estado) {
                                        let idPedidoInput = document.getElementById("idPedido");
                                        let nuevoEstadoInput = document.getElementById("nuevoEstado");
                                        let idPedido = idPedidoInput ? idPedidoInput.value : "";
                                        if (nuevoEstadoInput) {
                                            nuevoEstadoInput.value = estado;
                                        }
                                        // Envía el estado actualizado con AJAX
                                        let xhr = new XMLHttpRequest();
                                        xhr.open("POST", "codigophp/update_estado.php", true);
                                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                        xhr.onreadystatechange = function () {
                                            if (xhr.readyState === 4 && xhr.status === 200) {
                                                alert("Estado actualizado correctamente");
                                                window.location.reload();
                                            }
                                        };
                                        xhr.send("id=" + idPedido + "&estado=" + estado);
                                        document.getElementById("dropdownMenu").style.display = "none";
                                    }
                                    // Código para manejar el clic en los botones de opciones
                                    document.querySelectorAll('.tocar').forEach(element => {
                                        element.addEventListener('click', () => {
                                            let parentNode = element.parentNode;
                                            let idPedido = parentNode.querySelector("#id").value;
                                            let estado = parentNode.querySelector("#estado").value;
                                            let pedidoJson = JSON.parse(parentNode.querySelector("#pedido").value);
                                            let idPedidoInput = document.getElementById("idPedido");
                                            let nuevoEstadoInput = document.getElementById("nuevoEstado");
                                            if (idPedidoInput && nuevoEstadoInput) {
                                                idPedidoInput.value = idPedido;
                                                nuevoEstadoInput.value = estado;
                                            }
                                            // Llenar la información de las herramientas en el modal
                                            let detallePedido = document.getElementById("detallePedido");
                                            detallePedido.innerHTML = "<h3>Herramientas solicitadas:</h3>";
                                            pedidoJson.herramientas.forEach((herramienta, index) => {
                                                detallePedido.innerHTML += "<p>Herramientas: " + herramienta + " - Cantidad: " + pedidoJson.cantidad[index] + "</p>";
                                            });
                                            aplicarBlur();
                                        });
                                    });
                                </script>
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
            document.getElementById("estadop").value = pedido;
            aplicarBlur();
        });
    });
    opcionequis.addEventListener('click', sacarBlur);
</script>
<script src="codigojs/sombra2.js"></script>
<script>
    function toggleDropdown() {
        var dropdown = document.getElementById("dropdownMenu");
        dropdown.style.display = (dropdown.style.display === "none" || dropdown.style.display === "") ? "block" : "none";
    }
    function setEstado(estado) {
        let idPedidoInput = document.getElementById("idPedido");
        let nuevoEstadoInput = document.getElementById("nuevoEstado");
        let idPedido = idPedidoInput ? idPedidoInput.value : ""; // Obtén el valor del ID del pedido
        if (nuevoEstadoInput) {
            nuevoEstadoInput.value = estado; // Asigna el nuevo estado al campo oculto
        }
        // Mostrar los valores en la consola antes de enviarlos
        console.log("ID Pedido: ", idPedido);
        console.log("Nuevo Estado: ", estado);
        // Aquí envías el estado actualizado con AJAX
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "codigophp/update_estado.php", true);  // Archivo PHP que se encargará de la actualización en la base de datos
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert("Estado actualizado correctamente");
                window.location.reload();
            }
        };
        xhr.send("id=" + idPedido + "&estado=" + estado);
        document.getElementById("dropdownMenu").style.display = "none"; // Ocultar el menú después de seleccionar
    }
    // Código para manejar el clic en los botones de opciones
    document.querySelectorAll('.tocar').forEach(element => {
        element.addEventListener('click', () => {
            let parentNode = element.parentNode;
            let idPedido = parentNode.querySelector("#id").value;  // Asegúrate de que #id corresponde al id_pedido
            let estado = parentNode.querySelector("#estado").value; // Asegúrate de que #estado corresponde al estado actual
            let idPedidoInput = document.getElementById("idPedido");
            let nuevoEstadoInput = document.getElementById("nuevoEstado");
            if (idPedidoInput && nuevoEstadoInput) {
                idPedidoInput.value = idPedido; // Asigna el ID del pedido al campo oculto
                nuevoEstadoInput.value = estado; // Asigna el estado actual al campo oculto
            } else {
                console.error("No se encontraron los campos idPedido o nuevoEstado en el DOM.");
            }
            aplicarBlur();
        });
    });
</script>