<?php
require_once ('dat/datos.php');
/**
 *  Devuelve true si el código del usuario y contraseña se 
 *  encuentra en la tabla de usuarios
 *  @param $login : Código de usuario
 *  @param $clave : Clave del usuario
 *  @return true o false
 */

function userOk($login,$clave):bool {
    global $usuarios;
    if(isset($usuarios[$login])){
        foreach($usuarios as $id => $array) {
            if($clave == $usuarios[$login][1]) {
                return true;
            }
        }return false;
    }return false;
}
/**
 *  Devuelve el rol asociado al usuario
 *  @param $login: código de usuario
 *  @return ROL_ALUMNO o ROL_PROFESOR
 */
function getUserRol($login){
    global $usuarios;
    if($usuarios[$login][2] == ROL_ALUMNO) {
        return ROL_ALUMNO;
    }else return ROL_PROFESOR;
}

/**
 *  Muestra las notas del alumno indicado.
 *  @param $codigo: Código del usuario
 *  @return $devuelve una cadena con una tabla html con los resultados 
 */
function verNotasAlumno($codigo):String{
    $msg="";
    global $nombreModulos;
    global $notas;
    global $usuarios;

    $nota_usuario = [];

    
    $msg .= " Bienvenido/a alumno/a: " .$usuarios[$codigo][0];
    $msg .= "<table>";
    $msg .= "<tr><td>Módulo</td><td>Nota</td>";
    for($i=0; $i<count($nombreModulos); $i++) {
       $msg.= "<tr><td>" .$nombreModulos[$i]. "</td><td>" .$notas[$codigo][$i]."</tr>";
    }
    $msg .= "</table>";
    return $msg;
}

/**
 *  Muestra las notas de todos alumnos. 
 *  @param $codigo: Código del profesor
 *  @return $devuelve una cadena con una tabla html con los resultados 
 */
function verNotaTodas ($codigo): String {
    $msg="";
    global $nombreModulos;
    global $notas;
    global $usuarios;
    $msg .= " Bienvenido Profesor: ". $usuarios[$codigo][0];
    $msg .= "<table>";
    $msg .= "<tr><td>Nombre</td>";
    for($i=0; $i<count($nombreModulos); $i++) {
        $msg .= "<td>" .$nombreModulos[$i]. "</td>";
    }
    $msg .= "</tr>";
    foreach($usuarios as $id => $array){
        if($id == 200001) {
            continue;
        }
        $msg .= "<tr><td>" .$array[0]. "</td>";
        for($i=0; $i<count($nombreModulos); $i++) {
            $msg.= "<td>" .$notas[$id][$i]. "</td>";
        }
        $msg .="</tr>";
    }
    $msg .= "</table>";
    return $msg;
}