<?php
function piedraPapeloTijera($jugador) {
    $aleatorio =random_int(1,3);
    $jugada= [];
    //Para ver que jugada le toco al usuario y almacenarlo
    switch ($aleatorio) {
        case 1:
            if ($jugador == 1) {  
                $jugada["piedra"] = "&#x1F91C"; 
                return  $jugada; //piedra1
            }else{
                $jugada["piedra"] = "&#x1F91B";
                return $jugada; //piedra2
            }
        case 2:
            $jugada["tijera"] = "&#x1F596";
            return $jugada; //tijera
        case 3:
            $jugada["papel"] = "&#x1F91A";
            return $jugada; //papel
    }
}

function ganador($jug1, $jug2) {
    $msg = "Ha ganado el jugador";
    $clave1 = key($jug1);
    $clave2 = key($jug2);

     if($clave1 === $clave2) {
        return "Empate";
    }
    
    switch($clave1) {
        case "piedra":
            return ($clave2 == "tijera") ? $msg . " 1" : $msg . " 2";
        case "tijera":
            return ($clave2 == "papel") ? $msg . " 1" : $msg . " 2";
        case "papel":
            return ($clave2 == "piedra") ? $msg . " 1" : $msg . " 2";
        default:
            return "Jugada inválida";
    }
}


//Declaracion de jugadores
$jugada_jugador1 = piedraPapeloTijera(1);
$jugada_jugador2 = piedraPapeloTijera(2);

//Al devolver un array lo recorro aqui para que el html sea mas simple
foreach($jugada_jugador1 as $clave => $valor) {
    $jugador1= $valor;
}
foreach($jugada_jugador2 as $clave => $valor) {
    $jugador2= $valor;
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Juego de Cindo Dados</title>
        <meta charset="UTF-8">
        <link rel="StyleSheet" href="juego_dados.css" type="text/css">
    </head>
    <body>
        <h1> ¡Piedra, papel, tijera!</h1>
        <p>Actualice la página paara mostrar otra partida.</p>

        <strong>Jugador 1</strong>   <strong>Jugador 2</strong><br>

        <span style= font-size:3rem;><?= $jugador1 ?></span><span style=font-size:3rem;> <?= $jugador2 ?></span><br>
        <strong> <?php echo ganador($jugada_jugador1,$jugada_jugador2);?>



