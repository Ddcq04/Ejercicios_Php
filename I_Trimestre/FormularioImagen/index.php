<?php
//Para limpiar datos
function limpieza($dato) {
    if(isset($dato) && !empty($dato)){
        $limpiezaDato = trim($dato);
        return strip_tags($limpiezaDato);
    }
    return $dato;
}
//Para limpiar de datos de un array
function limpiezaArray(array $ar): array{
    $arrayLimpio = [];
    foreach($ar as $clave => $dato) {
        $arrayLimpio[$clave] = limpieza($dato);
    }
    return $arrayLimpio;
}

if($_SERVER['REQUEST_METHOD'] == "GET") {
    header("Location: captura.html");
    exit();
}

    $nombre = isset($_REQUEST["nombre"])? limpieza($_REQUEST["nombre"]): "";
    $alias = isset($_REQUEST["alias"])? limpieza($_REQUEST["alias"]): "";
    $edad = isset($_REQUEST["edad"])? limpieza($_REQUEST["edad"]): "";
    $decision = isset($_REQUEST["decision"])? limpieza($_REQUEST["decision"]): "";
    //Para mostrar las armas que escogio el jugador
    if(!isset($_REQUEST["armas"])) {
        $msg_armas = "No a introducido ningun arma";
    }else {
        $armas = limpiezaArray($_REQUEST["armas"]);
        $msg_armas = "";
        for($i=0; $i<count($armas); $i++) {
            if($i == count($armas) -1) {
                $msg_armas .= $armas[$i];
            }else {
                $msg_armas .= $armas[$i]. ", ";
            }
        
        }
    }
    $msg_error="";
    $exito = false;
    $imagen ="";


    //Para mover el archivo del directorio temporal a uploads y verificando a su vez si da errores
    //En caso de que se de errores la variable exito se mantendra false
    if(isset($_FILES["archivo"])){
        }if($_FILES["archivo"]["error"] == UPLOAD_ERR_NO_FILE){
            $msg_error .= "No se subió ninguna imagen";
        }else if($_FILES["archivo"]["error"] == UPLOAD_ERR_FORM_SIZE) {
            $msg_error .= "La imagen excede los 10 kbyte permitidos";
        }else if($_FILES["archivo"]["error"] !== UPLOAD_ERR_OK){
            $msg_error = "Error en la subida del archivo";
        }else if($_FILES["archivo"]["size"] > 10000) {
            $msg_error .= "La imagen excede los 10 kbyte permitidos";
        }else if($_FILES["archivo"]["type"] != 'image/png' ) {
                $msg_error .= "La imagen que subiste no es tipo png";
        }else {
                        //Si tiene el directorio permisos
                        if(is_writable("uploads")) {
                            $ruta_destino = "uploads/" .$_FILES["archivo"]["name"];
                            //si los tiene mueve el fichero y la variable exito es igual a true
                            if(move_uploaded_file($_FILES["archivo"]["tmp_name"], $ruta_destino) == true) {
                                $imagen = $ruta_destino;
                                $exito = true;
                            }else  $msg_error .= "No se a podido mover el archivo";
                        }else $msg_error .= "El directorio no tiene permisos para subir imagenes";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Formulario</title>
        <meta charset="UTF-8">
        <link rel="StyleSheet" href="formularioImagen" type="text/css">
    </head>
    <body>
        <style>
        div {
            padding: 2rem;
            margin:20%;
            background-color:#ff0;
        }
        h1 {
            text-align: center;
        }
        </style>
        <div>
            <h1>Datos del Jugador</h1>
            <strong>Nombre:</strong><?= $nombre ?><br><br>
            <strong>Alias:</strong><?= $alias ?><br><br>
            <strong>Edad:</strong><?= $edad ?><br><br>
            <strong>Armas seleccionadas:</strong><?= $msg_armas ?><br><br>
            <strong>¿Practica artes mágicas?:</strong><?= $decision ?><br><br><br>

            
            <strong>Imagen subida:</strong><br><br>
        
            <?php //En caso de ser true exito mostrara la imagen subida del jugador y si es falso mostrara la calavera
                if($exito) {
                    echo "<img src='$imagen'><br>";
                } else echo "<img src='calavera.png'><br>$msg_error";
            ?>
        </div>
    </body>
</html>

        



