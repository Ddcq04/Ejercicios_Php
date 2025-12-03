<?php
//Creacion de las caras de los dados y sus valores
$cara_de_dados= [1 => "&#9856",
               2 => "&#9857",
               3 => "&#9858",
               4 => "&#9859",
               5 => "&#9860",
               6 => "&#9861" ];

//Funcion que lanza dados aleatoriamente
function lanza_dados(array $lista):array {
    $caras= [];
    $nuevo= [];

    for($i=0; $i<5; $i++) {
        $cara_aleatoria = random_int(1,6);
            $caras[] = $lista[$cara_aleatoria];
    }
    return $caras;
}

//Funcion que quita el valor minimo,maximo y calcula el total
function calcular_jugada(array $jugada): int {
    $valores= [];
    for($i=0; $i<count($jugada); $i++) {
        switch($jugada[$i]) {
            case "&#9856":
                $valores[]= 1;
                break;
            case "&#9857":
                $valores[]= 2;
                break;
            case "&#9858":
                $valores[]= 3;
                break;
            case "&#9859":
                $valores[]= 4;
                break;
            case "&#9860":
                $valores[]= 5;
                break;
            case "&#9861":
                $valores[]= 6;
                break;
        }
    }
    //Encontrar en el array el valor minimo y maximo
    $minimo = min($valores);
    $maximo = max($valores);
    unset($valores[array_search($minimo,$valores)]);
    unset($valores[array_search($maximo,$valores)]);

    //Suma total del array
    return array_sum($valores);
}
function ganador($valor1, $valor2) {
    if($valor1>$valor2) {
        return "Ha ganado el Jugador 1";
    }elseif($valor1<$valor2) {
         return "Ha ganado el Jugador 2";
    }else return "EMPATE";
}

$jugador1 = lanza_dados($cara_de_dados);
$jugador2 = lanza_dados($cara_de_dados);
$suma_j1 = calcular_jugada($jugador1);
$suma_j2 = calcular_jugada($jugador2);


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Juego de Cindo Dados</title>
        <meta charset="UTF-8">
        <link rel="StyleSheet" href="juego_dados.css" type="text/css">
    </head>
    <body>
        <h1>Cinco dados</h1>
        Actualice la página para mostrar una nueva tirada.<br><br>

        <table border="1">
            <tr>
                <td><strong>Jugador 1</strong></td><td id="rojo"><?php for($i=0; $i<count($jugador1); $i++) {echo "<span class='dado'>$jugador1[$i]</span>";}?><td><strong><?php echo $suma_j1?></strong></td>
            </tr>
            <tr>
                <td><strong>Jugador 2</strong></td><td id="azul"><?php for($i=0; $i<count($jugador2); $i++) {echo "<span class='dado'>$jugador2[$i]</span>";}?><td><strong><?php echo $suma_j2?></strong></td>
            </tr>
        </table>
        <strong>Resultado</strong> <?php echo ganador($suma_j1,$suma_j2)?>
        