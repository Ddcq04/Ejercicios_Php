<?php 
include_once "funciones.php";
session_start();
//Para evitar muchas incidencias en 2 minutos
/*
if(isset($_COOKIE["contador-incidencias"])){
    $num_incidencias = $_COOKIE["contador-incidencias"];
}
setcookie("contador-incidencias",$num_incidencias,time() + 10000);

if($_COOKIE["contador-incidencias"] == 3) {
    echo "Superado el número máximo de incidencias.<br>
        Espere 2 minutos para introducir otra o reinicie su navegador.";
    include_once "incidenciasform.html";
    exit();
}
*/

$estadoIncidencia = true;
if(datoCorrecto($_POST["nombre"]) || datoCorrecto($_POST["resumen"]) || datoCorrecto($_POST["prioridad"]) ){
    $estadoIncidencia = false;
}else {
    $incidencia = transformarDatos($_POST["nombre"], $_POST["resumen"], $_POST["prioridad"]);
    subidaFichero($incidencia);
    include_once "incidenciasform.html";
}
//Si sale error
if($estadoIncidencia) {
    echo "Muchas gracias " .$_POST["nombre"]. ", se ha anotado su incidencia";
}else {
    //En caso que no 
    echo "Error no se ha podido anotar su incidencia.";
    include_once "incidenciasform.html";
}