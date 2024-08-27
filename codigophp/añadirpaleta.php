
    <?php 
    if (isset($_SESSION['id_usuario'])) {
        $sql = "SELECT * FROM `paletas` WHERE fk_usuario = ".$_SESSION["id_usuario"];

        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $colores = json_decode($row["colores"], true);
                print_r($colores);
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
            }
        </style>
        '; 
    }

    ?>

