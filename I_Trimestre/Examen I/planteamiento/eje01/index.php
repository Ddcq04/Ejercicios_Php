<?php
session_start();
include_once 'funciones.php';
if(isset($_COOKIE["cierre_sesion"])) {
    echo "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Sesion cerrada</title>
            </head>
            <body>
                <p> Ya no puedes apostar</p>
            </body>
            </html>";
    exit();
}

if (isset($_SESSION['dni'])) {
    if (isset($_GET['orden'])) {
        if ($_GET['orden'] == 'salir') {
            // ALMACENAR LOS PUNTOS EN FICHERO Y CERRAR LA SESION
            anotarPuntos($_SESSION["dni"],$_SESSION["puntos"]);
            setcookie("cierre_sesion",1, time() + 600);
            session_destroy();
            // MOSTRAR VISTA DE INICIAL
            include_once "vistas/login.php";
            exit();
        }
        if ($_GET['orden'] == 'continuar' && $_SESSION['puntos'] > 0) {
            // CAMBIAR LOS  PUNTOS DE LA SESION CON VALORES ALEATORIA
            $aleatorio = random_int(1,2);
            switch($aleatorio) {
                case 1:
                    $_SESSION["puntos"]+=50;
                    break;
                case 2:
                    $_SESSION["puntos"]-=50;
                    break;
            }
            if ($_SESSION['puntos'] <=0) {
                $_SESSION['puntos'] = 0;
            }
        }
    } 
    include 'vistas/puntos.php';
}

if ($_SERVER['REQUEST_METHOD'] == "GET" && !isset($_SESSION['dni'])) {
        include 'vistas/login.php';
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // PROCESAR FORMULARIO LOGIN
    // COMPROBAR QUE LOS PUNTOS SON NUMERICOS
    if(!ctype_digit($_POST["puntos"]) || $_POST["puntos"] < 0){
        $msg = "El valor de puntos no es numérico";
        include_once "vistas/login.php";
        exit();
    }
    // COMPROBAR QUE DNI Y LA CLAVE SON CORRECTOS
    if(validarCliente($_POST["dni"], $_POST["clave"])) {
        // MENSAJE DE ACCESO
        // ANOTAR PUNTOS Y DNI EN AL SESSION Y MOSTRAR LA VISTA DE PUNTOS
        $_SESSION["dni"] = $_POST["dni"];
        //Para obtener los puntos anteriores guardados
        $usuarios = cargarTablaClientes();
        $puntos_obtenidos = $usuarios[$_SESSION["dni"]]->puntos;
        $_SESSION["puntos"] = $_POST["puntos"] + $puntos_obtenidos;
        include 'vistas/puntos.php';
    }else {
        // SI NO ES CORRECTO MOSTRAR EL LOGIN CON UN 
        $msg = "DNI y contraseña incorrecta";
        include_once "vistas/login.php";
    }
}