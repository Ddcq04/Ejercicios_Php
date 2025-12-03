<?php
include_once "usuario.php";

//Cargadatos
function cargaDatos():array{
    $archivo = @fopen("usuarios.dat","r");
    $usuarios = [];
    while($datos = fgetcsv($archivo)) {
        $usuario = new Usuario($datos[0],
                                  $datos[1],
                                  $datos[2]);
        //array asociativo
        $usuarios[$datos[0]] = $usuario;
    }
    fclose($archivo);
    return $usuarios;
}
/**
 * Checks if the provided username and password are valid.
 *
 * @param string $username The username to validate.
 * @param string $password The password to validate.
 * @return bool Returns true if the username and password are valid, false otherwise.
 */
function accesoValido($username, $password): bool{
    $usuarios = cargaDatos();
    if(key_exists($username,$usuarios)){
        if($username == $usuarios[$username]->nombre && password_verify($password,$usuarios[$username]->contraseña)) {
            return true;
        }
    }
    return false;
}

/**
 * Records a new access for the given username.
 *
 * @param string $username The username for which to record the access.
 * @return int The result of the access recording operation.
 */
function anotarNuevoAcceso($username){
    $usuarios = cargaDatos();
    if(key_exists($username,$usuarios)) {
        $usuarios[$username]->inicios_sesion++;
        //Subir datos
        $fich = @fopen("usuarios.dat", "w");
        foreach($usuarios as $usuario) {
            $datos = [$usuario->nombre, $usuario->contraseña, $usuario->inicios_sesion];
            fputcsv($fich, $datos,",");
        }
        fclose($fich);
    }
}

/**
 * Registers a user with a given username and time.
 *
 * @param string $username The username of the user to register.
 * @param int $time The time associated with the registration.
 */
function registra($username,$time){
    $ip = $_SERVER['REMOTE_ADDR'];
    $dia = date("d-m-Y h:i" ,$time);
    $log = [$ip,$username,$dia];
    @file_put_contents("registro.log",implode(",",$log),FILE_APPEND);
}
