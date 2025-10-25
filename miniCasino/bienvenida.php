<?php
    $contador = 0;
    //Contador de visitas 
    if(isset($_COOKIE["contador"])) {
        $contador = $_COOKIE["contador"];
    }
    $contador++;
    setcookie("contador",$contador, time() + 30*24*3600);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mini Casino</title>
    </head>
    <body>
        <h1>BIENVENIDO AL CASINO</h1>
        <p>Esta es su <?= $_COOKIE["contador"];?>º visita.</p>
        <form action="index.php" method="post">
            <label for="">Introduzca el dinero con el que va jugar: </label>
            <input type="number" name="dinero"><br><br>
            <button type="submit" value="subir">Jugar</button>
        </form>
    </body>
</html>