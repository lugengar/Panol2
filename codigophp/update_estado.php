<?php
include './conexionbs.php'; // Asegúrate de que la conexión a la base de datos esté correctamente configurada

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados a través de POST
    $id_pedido = $_POST['id'];
    $estado = $_POST['estado'];

    // Preparar la consulta SQL para actualizar el estado del pedido
    $sql = "UPDATE pedidos SET estado = ? WHERE id_pedido = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("si", $estado, $id_pedido); // "si" significa que el primer parámetro es una cadena (s) y el segundo es un entero (i)
        
        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Estado actualizado correctamente";
        } else {
            echo "Error al actualizar el estado: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Método de solicitud no permitido.";
}
?>
