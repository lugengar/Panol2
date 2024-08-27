<?php
include "./sesion.php";
include "./conexionbs.php";

// Obtener datos del formulario
$usuario_id = $_SESSION['id_usuario'];
$curso = $_POST['curso'];
$aula = $_POST['aula'];
$fecha = $_POST['horario'];

$herramientas = $_SESSION['pedido']["herramientas"];
$cantidades = $_SESSION['pedido']["cantidad"];
$pedido = json_encode($_SESSION['pedido'], true);

// Obtener el pedido de la sesión
for ($i = 0; $i < count($herramientas); $i++) {
    $id = $herramientas[$i];
    $cantidad = $cantidades[$i];
    $sql = "UPDATE categoria SET cantidad = cantidad - $cantidad WHERE id = $id";
    $result = mysqli_query($conn, $sql); 
}

$sql = "INSERT INTO pedidos (fecha_pedido, usuario_solicitante, id_aula, estado, observaciones, pedido, fk_curso) 
    VALUES ('$fecha', '$usuario_id', '$aula', 'pendiente', '', '$pedido', '$curso')";

$result = mysqli_query($conn, $sql);
if ($result) {
    echo "Nuevo pedido creado correctamente.";
} else {
    echo "Error al crear el pedido: " . mysqli_error($conn);
}

// Crear la consulta SQL para insertar el nuevo pedido en la base de datos

// Cerrar la conexión
$conn->close();
$_SESSION['pedido'] = null;
header("Location: ../pedidos.php");
exit;
?>
