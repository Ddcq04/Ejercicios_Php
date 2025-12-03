<?php

include "dat/Cliente.php";

/**
 *  Lee el fichero de clientes y lo carga en un Array de objetos clientes
 *  @return array - tabla asociativa con clave dni.
 */

function cargarTablaClientes (): array {
    $tclientes = [];
    $fichero = @fopen("dat/clientes.csv","r");

    while($datos = fgetcsv($fichero)){
        $cliente = new Cliente($datos[0], $datos[1], $datos[2], $datos[3]);
        $tclientes[$datos[0]] = $cliente;
    }
    return $tclientes;
}

/**
 * Escribe la tabla de objectos clientes en el fichero csv
 * @param  $tabla - array de objectos
 */

function salvarTablaClientes(array $tabla){
    $fich = @fopen("dat/clientes.csv", "w");
        foreach($tabla as $usuario) {
            $datos = [$usuario->dni, $usuario->nombre, $usuario->clavehash, $usuario->puntos];
            fputcsv($fich, $datos,",");
        }
    fclose($fich);
}

/**
 * Valida usuario y contraseña contra clientes.csv
 * @param string $dni DNI del cliente
 * @param string $clave Contraseña en texto plano
 * @return true Si el usuario y la contraseña son correctas
 */
function validarCliente($dni, $clave) :bool{
    $tablacli = cargarTablaClientes();
    if(key_exists($dni,$tablacli) && password_verify($clave,$tablacli[$dni]->clavehash)) {
        return true;
    }
    return false;
}

/**
 * Anota los puntos logrados en la última partida 
 * @param string $dni DNI del cliente a modificar
 * @param int $puntos Puntos a almacenar
 * @return true si han anotado los datos
*/
function anotarPuntos($dni,$puntos): bool {
    $tablaCli = cargarTablaClientes();
    if(key_exists($dni,$tablaCli)) {
        $tablaCli[$dni]->puntos = $puntos;
        salvarTablaClientes($tablaCli);
        return true;
    }
    return false;
}




