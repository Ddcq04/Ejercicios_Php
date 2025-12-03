<?php
//Funciones para depurar bien la bienvenida
function limpiezaDato($dato):string {
    $dato = strip_tags($dato);
    return trim($dato);
}



//Para contraseña
function hayMayus($dato) : bool{
    for($i=0; $i< strlen($dato); $i++) {
        if(ctype_upper($dato[$i])) {
           return false;
        }
    }
    return true;
}
function hayMinus($dato): bool {
    for($i=0; $i< strlen($dato); $i++) {
        if(ctype_lower($dato[$i])) {
            return false;
        }
    }
    return true;
}





function listadoLibros($array) {
    foreach($array as $libro => $precio) {
        $mostrar .= "<option value=$libro>$libro</option>";
    }
    return $mostrar;
}

//Funciones principales
function anotar(&$cesta, $libro, $cantidad) {
        if(isset($cesta[$libro])) {
            $cesta[$libro] += $cantidad;
        }else $cesta[$libro] = $cantidad;
}
function anular(&$cesta, $libro) {
    unset($cesta[$libro]);
}
function mostrarTabla($cesta) {
    $tabla = "<table>";
    foreach($cesta as $libro => $cantidad) {
        $tabla .= "<tr><td>$libro : $cantidad</td></tr>";
    }
    $tabla .= "</table>";
    return $tabla;
}
function mostrarPrecios($cesta, $libreria) {
    $total = 0;
    $tabla = "<table>";
    $tabla .= "<tr><td>Libro</td><td>Cantidad</td><td>Precio</td>";
    foreach($cesta as $libro => $cantidad) {
        $total += $libreria[$libro] * $cantidad;
        $tabla .= "<tr><td>$libro</td><td>$cantidad</td><td>" .$libreria[$libro] * $cantidad. "</tr>";
    }
    $tabla .= "</table>";
    $tabla .= "TOTAL: $total";
    return $tabla;
}
?>