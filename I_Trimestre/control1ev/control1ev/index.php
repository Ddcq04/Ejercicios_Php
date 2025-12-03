<?php
session_start();

include_once('app/funciones.php');
if(!isset($_SESSION["contador_seguridad"])) {
  $_SESSION["contador_seguridad"] = 0;
}


if($_SESSION["contador_seguridad"] < 5) {
  if (  !empty( $_GET['login']) && !empty($_GET['clave'])){

      if ( userOk($_GET['login'],$_GET['clave'])){
        if ( getUserRol($_GET['login']) == ROL_PROFESOR){
          $contenido = verNotaTodas($_GET['login']);
        } else {
          $contenido = verNotasAlumno($_GET['login']);
        }
        $_SESSION["contador_seguridad"] = 0;
        include_once ('app/resultado.php');
      // userOK falso
      }else {
        $_SESSION["contador_seguridad"]++;
        $contenido = "El número de usuario y la contraseña no son válidos";
        include_once('app/acceso.php');
      }
  }else {
      $_SESSION["contador_seguridad"]++;
      $contenido = " Introduzca su número de usuario y su contraseña";
      include_once('app/acceso.php');
      
  }
}else {
      include_once("app/error.html");
    }


