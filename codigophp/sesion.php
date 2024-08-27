<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ./index.php");
}

function panol($contenido){
    if ($_SESSION['cargo'] == "panolero" || $_SESSION['cargo'] == "admin") {
        echo $contenido;
    }
}
?>