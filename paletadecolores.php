<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>
<body>
    <form action="paletadecolores.php" method="post">
        <input type="color" name="color1" id="color1">
        <input type="color" name="color2" id="color2">
        <input type="color" name="color3" id="color3">
        <input type="color" name="color4" id="color4">
        <input type="submit">
    </form>
    <button id="boton1">color1</button>
    <button id="boton2">color2</button>
    <button id="boton3">color3</button>
    <button id="boton4">color4</button>

    <?php 
    include "./codigophp/conexionbs.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $colores = ["azul" => $_POST["color1"], "amarillo" =>$_POST["color2"], "blanco" => $_POST["color3"], "negro" => $_POST["color4"]];
        $colores2 = json_encode($colores, true);

        $sql = "INSERT INTO `paletas`(`colores`, `fk_usuario`) VALUES (?,?)";
        $a = 4;
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $colores2, $a);
        $stmt->execute();
        print_r($colores);

        implementarcolores($colores);
        $stmt->close();
    }else{
        $sql = "SELECT * FROM `paletas` WHERE fk_usuario = 4";

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
    }

    function implementarcolores($colores){

        echo '
        <style> 
            :root {
                --color-primary: '.$colores["azul"].';
                --color-secondary: '.$colores["amarillo"].';
                --color-accent: '.$colores["blanco"].';
                --color-background: '.$colores["negro"].';
            }
        </style>
        '; 
    }

    ?>
</body>
</html>
