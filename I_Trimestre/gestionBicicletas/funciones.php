<?php
include_once "BiciElectrica.php";
//Funcion cargarbicis
function cargarBicis(): array{
    $archivo = file("bicicletas.csv");
    $bicicletas = [];
    foreach($archivo as $datos_combinados) {
        $datos = explode(",",$datos_combinados);
        $bicicleta = new BiciElectrica(
                    $datos[0],
                    $datos[1],
                    $datos[2],
                    $datos[3],
                    $datos[4]
        );
        $bicicletas[] = $bicicleta;
    }
    return $bicicletas;
}
//Funcion mostrarbicis en una tabla
function mostrarTablaBicis($array_bicicletas): string {
    $tabla = "<table border=1>";
    $tabla .= "<tr><th>Id</th><th>Coord X</th><th>Coord Y</th><th>Bateria</th>";
    foreach($array_bicicletas as $bicicleta) {
        if($bicicleta->operativa == 1) {
            $tabla .= "<tr><td>" .$bicicleta->id. "</td><td>" .$bicicleta->coordx. "</td><td>" .$bicicleta->coordy. "</td><td>" .$bicicleta->bateria. "%</td></tr>";
        }
    }
    $tabla .= "</table>";
    return $tabla;
}
//Funcion para obtener la bici mas cercana
function biciMasCercana($coordx_usuario, $coordy_usuario,$bicicletas): BiciElectrica {
    $bicicleta_cercana = null;
    $menor_distancia = PHP_INT_MAX;

    foreach($bicicletas as $bicicleta) {
        if($bicicleta->operativa == 1){
            $distancia = $bicicleta->distancia($coordx_usuario,$coordy_usuario);
            if($distancia < $menor_distancia) {
                $menor_distancia = $distancia;
                $bicicleta_cercana = $bicicleta;
            }

        }
    }
    return $bicicleta_cercana;
}