<?php
/* Para depurar las contraseña de todos los usuarios las cambie a "1234"*/
include_once 'util.php';
session_start();

$mensaje="";
if (!isset($_SESSION['usuario']) && !isset($_POST['orden'])){
    include_once 'vistas/acceso.php';
    die();
}

if ($_POST['orden'] ==  "entrar" ){
    // Campos de usuario y contraseña rellenos
    if(empty($_REQUEST["username"]) || empty($_REQUEST["password"])) {
        $mensaje = "ERROR: Los campos estan vacios";
        include_once 'vistas/acceso.php';   
    }
    // con valores correctos
    if(userOk($_REQUEST["username"],$_REQUEST["password"] )) {
        // Actualizo variable de sesión
        $_SESSION["usuario"] = $_REQUEST["username"];
        include_once 'vistas/cambiarcontra.php';
    }else{
        // Si falla muestro acceso.php
        $mensaje = "ERROR: La contraseña o el usuario no son correctos";
        include_once 'vistas/acceso.php';
    }
}


if ($_POST['orden'] ==  "cambiar" ){
    // Comprobar que los campos están llenos
    if(empty($_REQUEST["password"]) || empty($_REQUEST["password1"]) || empty($_REQUEST["password2"])) {
        $mensaje = "ERROR: Uno o varios campos estan vacios";
        // si falla muestro cambiarcontra.php
        include_once 'vistas/cambiarcontra.php';
    }
    // Se cambiar si la contraseña antigua es correcta
    elseif(passwdOk($_SESSION["usuario"],$_REQUEST["password"])) {
        // Y las nuevas contraseñas son iguales 
        if($_REQUEST["password1"] === $_REQUEST["password2"]) {
            //Aplico la funcion
            if(updatePasswd($_SESSION["usuario"],$_REQUEST["password1"])) {
                $mensaje ="";
                include_once "vistas/resultado.php";
            }else {
                //Si falla al subir
                $mensaje = "ERROR: Falla al actualizar la contraseña, intentelo otra vez";
                include_once 'vistas/cambiarcontra.php';
            }

        }else {
            //sino volvemos a mostrar cambiarcontra
            $mensaje = "Las contraseñas no son iguales";
            include_once 'vistas/cambiarcontra.php';
        }
    }else {
        $mensaje = "ERROR: La contraseña actual no es correcta";
        include_once "vistas/cambiarcontra.php";
    }
}