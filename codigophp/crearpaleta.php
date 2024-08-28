<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estiloscss/styles.css">
    <title>Document</title>
</head>
<body>
    <form action="crearpaleta.php" method="post">
        <input type="color" name="color1" value="#4139E6" id="color1">
        <input type="color" name="color2" value="#caee52" id="color2">
        <input type="color" name="color3" value="#FFFFFF" id="color3">
        <input type="color" name="color4" value="#202427" id="color4">
        <input type="submit" value="enviar" style="width: max-content; heigth: 2dvh; color: white; background-color: gray;">
    </form>
 

    <?php 
    include "./conexionbs.php";
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $colores = ["azul" => $_POST["color1"], "amarillo" =>$_POST["color2"], "blanco" => $_POST["color3"], "negro" => $_POST["color4"]];
        $colores2 = json_encode($colores, true);

        $sql = "INSERT INTO `paletas`(`colores`, `fk_usuario`) VALUES (?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $colores2, $_SESSION["id_usuario"]);
        $stmt->execute();
        print_r($colores);

        implementarcolores($colores);
        $stmt->close();
        header("Location: ../inicio.php");

    }else{
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
