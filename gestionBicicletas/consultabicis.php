<?php
include_once "funciones.php";
$tabla = cargarBicis();
//Comprobacion de envio de coordenadas
if(!empty(["coordenadax"]) && !empty(["coordenadax"])){
    if(isset($_POST["coordenadax"]) && isset($_POST["coordenaday"])) {
        $bici_recomendada = biciMasCercana($_POST["coordenadax"],$_POST["coordenaday"],$tabla);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Localizador bicicletas</title>
</head>
<body>
    <h1>Listado de bicicletas operativas</h1>
    <?=  mostrarTablaBicis($tabla) ?>
    <?php if(isset($bici_recomendada)): ?>
        <h2> Bicicleta disponible más cercana es <?= $bici_recomendada ?> </h2>
        <button onclick="history.back()"> Volver </button>
    <?php else: ?>
            <form method="post">
                <h3>Indicar su ubicación:</h3>
                <strong>Coordenada X:</strong> <input type="number" name="coordenadax"><br>
                <strong>Coordenada Y:</strong> <input type="number" name="coordenaday"><br>
                <button type="submit">Consultar</button>
            </form>
    <?php endif ?>
</body>
</html>