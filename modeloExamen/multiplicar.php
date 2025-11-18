<?php 
$numeros = [1 =>"uno","dos","tres","cuatro","cinco","seis","siete","ocho","nueve","diez"];

foreach($numeros as $pos => $nombre){
    $tabla_de_valores = [];
    for($i=1; $i<=10; $i++) {
        $tabla_de_valores[$i] = $pos * $i; 
    }
    $tmulti[$nombre] = $tabla_de_valores;
}
echo "<pre><code>";
var_dump($tmulti);
echo "</pre></code>";
?>