
<body>
<?php
// login.php
session_start();
session_unset();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Conectar a la base de datos
    include "./conexionbs.php";

$stmt = $conn->prepare("SELECT id_usuario, contrasena, nombre_completo, cargo FROM usuarios WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

// Verificar si hay algún resultado
if ($stmt->num_rows > 0) {
    // Vincular los resultados
    $stmt->bind_result($id, $hashed_password, $nombrecompleto, $cargo);

    $login_successful = false;

    // Iterar a través de todos los resultados
    while ($stmt->fetch()) {
        // Verificar la contraseña
        if (password_verify($password, $hashed_password)) {
            // Iniciar sesión exitosa
            $_SESSION['cargo'] = $cargo;
            $_SESSION['username'] = $username;
            $_SESSION['nombrecompleto'] = $nombrecompleto;
            $_SESSION['pedido'] = null;
            $_SESSION['id_usuario'] = $id;
            $login_successful = true;
            header("Location: ../inicio.php");
            exit;
        }
    }

    // Si ninguna contraseña coincide
    if (!$login_successful) {
        echo '<a onclick="window.history.back()">Contraseña incorrecta. </a>';
    }
} else {
    echo '<a onclick="window.history.back()">Nombre de usuario no encontrado. </a>';
}


    $stmt->close();
    $conn->close();
}
?>
</body>

<style>
    body{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        background-color: var(--negro);
    }
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Days+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    a{
        font-family: "Days One", sans-serif;
        font-size: 6vh;
        font-weight: 200;
        color: var(--letra_amarillo);
        cursor: pointer;
    }
</style>