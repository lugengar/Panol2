<?php

function incrustarSVG($nombreArchivo) {
    
    $rutaArchivoSVG = $nombreArchivo.'.svg';
    
    if (file_exists($rutaArchivoSVG)) {
        $contenidoSVG = file_get_contents($rutaArchivoSVG);
        echo $contenidoSVG;
    } else {
        echo "<p>Error: No se pudo cargar el archivo SVG.</p>";
    }
}

function incrustarSVG2($nombreArchivo) {
    
    $rutaArchivoSVG = $nombreArchivo.'.svg';
    
    if (file_exists($rutaArchivoSVG)) {
        $contenidoSVG = file_get_contents($rutaArchivoSVG);
        return $contenidoSVG;
    } else {
        echo "<p>Error: No se pudo cargar el archivo SVG.</p>";
    }
}
    if (isset($_SESSION['id_usuario'])) {
        $sql = "SELECT * FROM `paletas` WHERE fk_usuario = ".$_SESSION["id_usuario"];

        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $colores = json_decode($row["colores"], true);
                implementarcolores($colores);
            }
        }else{
            $colores = ["azul" => "#4139E6", "amarillo" => "#caee52", "blanco" => "#FFFFFF", "negro" => "#202427"];
            implementarcolores($colores);
        }
    }else{
        $colores = ["azul" => "#4139E6", "amarillo" => "#caee52", "blanco" => "#FFFFFF", "negro" => "#202427"];
        implementarcolores($colores);
    }
    
    function implementarcolores($colores){

        echo '
        <style> 
            :root {
                --azul: '.$colores["azul"].';
                --amarillo: '.$colores["amarillo"].';
                --blanco: '.$colores["blanco"].';
                --negro: '.$colores["negro"].';
                --sombra: rgba(0, 0, 0, 0.2);
                --letra_azul: '.$colores["azul"].';
                --letra_amarillo: '.$colores["amarillo"].';
                --letra_blanco: '.$colores["blanco"].';
                --letra_negro: '.$colores["negro"].';
                --letra_rojo: red;
            }
        </style>
        '; 
    }


    ?>

