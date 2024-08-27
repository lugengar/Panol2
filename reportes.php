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
    <link rel="stylesheet" href="estiloscss/imagenes.css">
    <link rel="stylesheet" href="estiloscss/animaciones.css">
</head>
<body>
    <div id="pagina">
        <div id="header">
            <a href="inicio.php" class="logo imagen"></a>
            <button class="usuario imagen"></button>
        </div>
        <div id="subheader">
            <h1>Lista de reportes de <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
            <p></p>
        </div>
        <div id="contenido">
            <form action="formularioreportes.php">
                <button class="barra">
                    <div class="mas"></div>
                        <div>Escribir nuevo reporte</div>
                        <div></div>
                </button>
            </form>
            <div class="contenido2">
                <div class="con3" id="inicio">
                <h1>TUS REPORTES</h1>
                    <div class="scroll-y" id="scroll" style="height: 100%;">
                        <div class="conscroll-y">  
                            <?php
                                $sql = "";
                                if ($_SESSION['cargo'] == "panolero" || $_SESSION['cargo'] == "admin") {
                                    $sql = "SELECT reportes.*, usuarios.nombre_completo
                                    FROM reportes
                                    JOIN usuarios ON reportes.id_usuario = usuarios.id_usuario";
                                    $stmt = $conn->prepare($sql);
                                } else {
                                    $sql = "SELECT * FROM reportes WHERE reportes.id_usuario = ?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("s", $_SESSION['id_usuario']); 
                                }

                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<div class="rectangulo2">';
                                        echo '<h1>' . $row["nombre_completo"] . '</h1>';
                                        echo '<p>' . $row["observaciones"] . '</p>';
                                        echo '<input type="hidden" name="id" id="id" value="' . $row["id"] . '">';
                                        echo '<button class="imagen ojo tocar"></button>';
                                        echo '</div>';
                                    }
                                } else {
                                    echo "<h1>NO HAY REPORTES AUN</h1>";
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
            <a href="notificaciones.php" class="campana imagen izquierda">Ver pedidos</a>
            <a href="pedidos.php" class="logoboton imagen centro">Herramientas</a>
            <a href="inicio.php" class="flecha imagen derecha">Volver al inicio</a>
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
                            <form action = "./reportes.php" method = "post">
                                <input type="hidden"  name="reportes" id="elim" value="2">
                                <input type = "submit" class="basura imagen boton" style=" padding-left: 5vh;" value="Eliminar pedido">
                            </form>
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
        let id = parentNode.querySelector("#id").value;
        document.getElementById("elim").value = id;
        aplicarBlur();
    });
});

opcionequis.addEventListener('click', sacarBlur);
</script>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el ID del pedido a eliminar
    $pedido_id = $_POST['reportes'];
    include "./codigophp/conexionbs.php";

    // Preparar la consulta SQL para eliminar el pedido
    $sql = "DELETE FROM reportes WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $pedido_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<h1>reporte eliminado con éxito</h1>";
    } else {
        echo "<h1>No se pudo eliminar el reporte. Verifica que el ID del pedido sea correcto y que te pertenezca.</h1>";
    }

    $stmt->close();
}

$conn->close();
header("Location: ./reportes.php");
exit;
?>
