<?php
define ('FILEUSER','dat/usuarios.txt');
function lecturaArchivo($fichero): array {
    $lineas = file($fichero);
    $usuarios = [];
    foreach($lineas as $linea) {
        $array = explode("|", $linea);
        $usuarios[$array[0]] = $array[1];
    }
    return $usuarios;
}
function updatePasswd () {
    $actualizado ="";
    $encontrado = false;
    if(is_writable(FILEUSER)) {
        $usuarios = lecturaArchivo(FILEUSER);
        foreach($usuarios as $usuario => $hash) {
            if($usuario == "luis") {
                $hash = password_hash(1234,PASSWORD_DEFAULT);
                $encontrado = true;
            }
        $actualizado .= $usuario. "|" .$hash. "\n";
        }
        return $actualizado;
    }
}
print_r(updatePasswd());
        /*
    if($encontrado) {
        file_put_contents(FILEUSER,$actualizado);
        return true;
    }
    }
    return false;
}*/