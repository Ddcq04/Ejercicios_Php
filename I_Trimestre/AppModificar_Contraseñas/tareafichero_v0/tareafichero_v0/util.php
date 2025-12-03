<?php 
define ('FILEUSER','dat/usuarios.txt');

function lecturaArchivo($fichero): array {
    $lineas = file($fichero);
    $usuarios = [];
    foreach($lineas as $linea) {
        $partes = explode("|", trim($linea));
        $usuarios[$partes[0]] = $partes[1];
    }
    return $usuarios;
}
/**
 * 
 * Compruba que la usuario y la contraseña son correctos consultando
 * el archivo de datos
 * @param mixed $login
 * @param mixed $passwd
 * @return bool
 */
function userOk ( $login, $passwd):bool {
    if(is_readable(FILEUSER)) {
        $usuarios = lecturaArchivo(FILEUSER);
        if(array_key_exists($login,$usuarios) && password_verify($passwd, $usuarios[$login])) {
            return true;
            }
        }  
    return false;
 }
function passwdOk($login,$passwd):bool {
    if(is_readable(FILEUSER)) {
        $usuarios = lecturaArchivo(FILEUSER);
        if(password_verify($passwd, $usuarios[$login])) {
            return true;
        }
    }
    return false;
}

/**
 *  Actualiza la password de un usuario en el archivo de datos
 * @param mixed $login
 * @param mixed $passwd
 * @return bool true si el usuarios existe en el fichero
 */
function updatePasswd ($login, $passwd):bool {
    $encontrado = false;

    if(is_writable(FILEUSER)) {
        $usuarios = lecturaArchivo(FILEUSER);
        if(array_key_exists($login, $usuarios)) {
            $usuarios[$login] = password_hash($passwd,PASSWORD_DEFAULT);
            $encontrado = true;
        }
        if($encontrado) {
            $subir_contenido = "";
            foreach($usuarios as $usuario => $hash) {
                $subir_contenido .= $usuario. "|" .$hash. "\n";
            }
            file_put_contents(FILEUSER,trim($subir_contenido));
            return true;
        }
    }
    return false;
}


