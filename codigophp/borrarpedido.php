<?php
include "./sesion.php";
include "./conexionbs.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el ID del pedido a eliminar
    $pedido_id = $_POST['pedido'];
   // $estado = $_POST['estadop'];

    // Preparar la consulta SQL para eliminar el pedido
    $sql = "DELETE FROM pedidos WHERE id_pedido = ? AND usuario_solicitante = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $pedido_id, $_SESSION['id_usuario']);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<h1>Pedido eliminado con éxito</h1>";
    } else {
        echo "<h1>No se pudo eliminar el pedido. Verifica que el ID del pedido sea correcto y que te pertenezca.</h1>";
    }

    $stmt->close();
}

$conn->close();
header("Location: ../pedidos.php");
exit;
?>
