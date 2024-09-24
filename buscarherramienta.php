<?php
include "./codigophp/sesion.php";
include "codigophp/conexionbs.php";
include "codigophp/añadirpaleta.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
    <link rel="stylesheet" href="estiloscss/animaciones.css">
    <link rel="stylesheet" href="estiloscss/styles.css">
    <link rel="stylesheet" href="estiloscss/imagenes.css">
</head>
<body>
    <div id="pagina2">
        <div id="header">
           <a href="inicio.php" class="imagen"><?php incrustarSVG("imagenes/SVG/logo"); ?></a>
            <button class="imagen" ><?php incrustarSVG("imagenes/SVG/user"); ?></button>
        </div>
        
        <div id="contenido">
            <form class="barra" method="get"  action="./buscarherramienta.php">
                <input type="submit" class="equis" value=""></button>
                <input type="text" name="busqueda" placeholder="Buscar..">
                <div></div>
            </form>
            <div class="contenido2">
                <div class="con3" id="inicio">
                
                        
                    
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "GET") {
                        $sql="";
                        if($_GET['busqueda'] == null){
                            $sql = "SELECT * FROM herramientas";
                        }else{
                            $sql = "SELECT * FROM herramientas WHERE herramientas.nombre = '".$_GET['busqueda']."'";
                        }
                        $result = mysqli_query($conn, $sql);
                        if ($result->num_rows > 0) {
                            if($_GET['busqueda']== null){
                                echo '<h1>HERRAMIENTAS</h1>';
                            }else{
                                echo '<h1>RESULTADOS DE: '.$_GET['busqueda'].'</h1>';
                            }
                            echo'<div class="scroll-y" id="scroll" style="height:100%;"><div class="conscroll-y">';
                            while($row = $result->fetch_assoc()) {
                                if($row["cantidad"] == 0){
                                    echo '<div class="rectangulo3 verde"><h1>'.$row["nombre"].'</h1> <img src="" alt="" class="sinimagen imagen" ><p id="can" style="color:var(--letra_rojo);">SIN UNIDADES</p> <input type="number" name="id" id="id" style="display:none;" value="'.$row["id"].'"><input type="number" name="id" id="can2" style="display:none;" value="'.$row["cantidad"].'"><a class="imagen i" href="formularioreportes.php">'.incrustarSVG2("imagenes/SVG/alertab").'</a></div>';
                                }else{
                                    echo '<div class="rectangulo3"><h1>'.$row["nombre"].'</h1> <img src="'.$row["imagen"].'" alt="" class="imagen imagen_herramienta"><p id="can">Stock: '.$row["cantidad"].'</p> <input type="number" name="id" id="id"  style="display:none;" value="'.$row["id"].'"><input type="number" name="id" id="can2" style="display:none;" value="'.$row["cantidad"].'"><a class="imagen i tocar">'.incrustarSVG2("imagenes/SVG/signomas").'</a></div>';
                                }
                            } 
                            echo'</div></div>';
                        }else{
                            if($_GET['busqueda']== null){
                                echo "<h1>NO SE ENCONTRARON HERRAMIENTAS</h1>";
                            }else{
                                echo '<h1>NO SE ENCONTRO: '.$_GET['busqueda'].'</h1>';
                            }
                        }
                    }else{
                        $sql = "SELECT * FROM herramientas";
                        $result = mysqli_query($conn, $sql);
                        if ($result->num_rows > 0) {
                            
                            echo '<h1>HERRAMIENTAS</h1>';
                            
                            echo'<div class="scroll-y" id="scroll" style="height:100%;" ><div class="conscroll-y">';
                            while($row = $result->fetch_assoc()) {
                                if($row["cantidad"] == 0){
                                    echo '<div class="rectangulo3 verde"><h1>'.$row["nombre"].'</h1> <img src="" alt="" class="sinimagen imagen" ><p id="can" style="color:var(--letra_rojo);">SIN UNIDADES</p> <input type="number" name="id" id="id" style="display:none;" value="'.$row["id"].'"><input type="number" name="id" id="can2" style="display:none;" value="'.$row["cantidad"].'"><a class="imagen i" href="formularioreportes.php?herramienta='.$row["id"].'">'.incrustarSVG2("imagenes/SVG/alertab").'</a></div>';
                                }else{
                                    echo '<div class="rectangulo3"><h1>'.$row["nombre"].'</h1> <img src="'.$row["imagen"].'" alt="" class="sinimagen imagen imagen_herramienta" ><p id="can">Stock: '.$row["cantidad"].'</p> <input type="number" name="id" id="id"  style="display:none;" value="'.$row["id"].'"><input type="number" name="id" id="can2" style="display:none;" value="'.$row["cantidad"].'"><a class="imagen i tocar">'.incrustarSVG2("imagenes/SVG/signomas").'</a></div>';
                                }
                            } 
                            echo'</div></div>';
                        }else{
                           
                            echo "<h1>NO SE ENCONTRARON HERRAMIENTAS</h1>";
                         
                        }
                    }
                    ?>
                    
                        
                </div>
            </div>
        </div>
        <div id="footer">
        <a onclick="goBacka()" class="flecha imagen i centro">Volver<?php incrustarSVG("imagenes/SVG/flecha"); ?></a>
        </div>
    </div>
    <div id="sombra" class="sombra">
        <div class="contenidosombra">
            <button class="barra" id="opcionequis">
                    <div class="equis" ></div>
                        <div>Volver</div>
                        <div></div>
            </button>
            <div class="contenido2">
                <div class="con3" id="inicio" >
                <h1 style="color: var(--letra_blanco);" id="cantidad"></h1>

                    <div class="scroll-y" id="scroll" style="height: 100%; padding-top:2vh; width: 40vh;">
                        <form class="conscroll-y" action = "./pedido.php" method = "post">
                        <div class="signomas imagen boton"><input type="number" id="can3" name="cantidad" value='' placeHolder="Elegir cantidad" min="1" max=""></div>
                                <input type = "text" id="input" name="id"  style=" display:none;" value="" >
                                <input type="text" style="display:none;" name="estado" value="2">
                                <input type="text" style="display:none;" name="codigo" value="1">
                                <input type = "submit" class="avion imagen boton borde" style=" padding-left: 5vh;" value="Agregar herramienta">
                        </form>             
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
texto = document.getElementById("cantidad");
cantidad3 = document.getElementById("can3");
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
        let cantidad = parentNode.querySelector("#can").textContent;
        let idInput = parentNode.querySelector("#id").value;
        let max = parentNode.querySelector("#can2").value;
        texto.textContent = cantidad;
        cantidad3.setAttribute("max", max);
        document.getElementById("input").value = idInput;
        aplicarBlur();
    });
});
function goBacka() {
    window.location = "./pedido.php"
}
opcionequis.addEventListener('click', sacarBlur);
</script>
