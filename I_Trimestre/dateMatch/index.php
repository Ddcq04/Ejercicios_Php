<?php
include_once 'funciones.php';
session_start();
if(isset($_SESSION["nombre"])) {
    if(time() > $_SESSION["tiempo_limite"]) {
        registra($_SESSION["nombre"],time());
        session_destroy();    
    }else {
        $_SESSION["tiempo"] = $_SESSION["tiempo_limite"] - time();
        include_once "bienvenido.php";
        exit();
    }
}


if($_SERVER["REQUEST_METHOD"] == "GET") {
    include_once "acceso.php";
    exit();
}else {
    //Procesamiento
    if(accesoValido($_POST["username"], $_POST["password"])) {
        $_SESSION["nombre"] = $_POST["username"];
        $_SESSION["tiempo"] = $_POST["time"];
        $_SESSION["tiempo_limite"] = $_POST["time"] + time();
        anotarNuevoAcceso($_SESSION["nombre"]);
        include_once "bienvenido.php";
        exit();
    }else {
        $msg = "Nombre de usuario y contraseña incorrectos";
        include_once "acceso.php";
        exit();
    }
}
