<?php

// DATOS DE PRUEBA
$precios = [250, 10, 50, 100, 50, 25, 5, 200, 10, 300, 50];
// Definimos rangos: 'Barato' hasta 20 inclusive, 'Medio' hasta 100, 'Caro' más de 100
$categorias = ['Barato','Medio','Caro'];

// LLAMADAS A FUNCIONES


$res1 = agruparPorCategoria($precios, $categorias);
echo "<pre><code>";
print_r($res1);
echo "</pre></code>";

$preciosRandom = generarDatos(1,500,20);
$res2 = agruparPorCategoria($preciosRandom, $categorias);
echo " <br><br>
        <pre><code>";
print_r($res2);
echo "</pre></code>";

/**
 * Agrupa los precios según si son menores o iguales al valor de la categoría
 * En array tiene que estar los datos ORDENADOS de mas baratos a más caros
 * @param array $precios Lista numérica
 * @param array $categorias Array asociativo con los nombre de las categorias
 * @return array Array multidimensional
 */
function agruparPorCategoria($precios, $categorias): array {
    $resultado = [];
    sort($precios);
    foreach($categorias as $categoria) {
        foreach($precios as $precio) {
            switch($categoria) {
                case "Barato":
                    if($precio <= 20) {
                        $resultado[$categoria][] = $precio;
                    }
                    break;
                case "Medio":
                    if($precio > 20 && $precio <= 100) {
                        $resultado[$categoria][] = $precio;
                    }
                    break;
                case "Caro":
                    if($precio > 100) {
                    $resultado[$categoria][] = $precio;
                    }
                    break;
            }
        }
    }
    return $resultado;
}

function generarDatos($min,$max, $nunelementos): array {
    $resultado = [];
    for($i=0; $i<$nunelementos; $i++) {
        $resultado[] = random_int($min, $max);
    }
    return $resultado;
}
