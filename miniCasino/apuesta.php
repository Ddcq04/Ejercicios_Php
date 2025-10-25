<?php
if($_SERVER['REQUEST_METHOD'] == "GET") {
    header("Location: index.php");
    exit();
}

if(!isset($_SESSION)) {
    $_SESSION["dinero_usuario"] = $_POST["dinero"];
}




?>
<html>
    <body>
        <form action="apuesta.php" method="post">
            <p>Dispone de <?= $_SESSION["dinero_usuario"] ?> para jugar</p>
            <label for="">Cantidad a apostar: </label><input type="number" name="apuesta"><br>
            <label for="">Tipo de apuesta: </label><input type="radio" name="tipo" value="Par">Par
                                                   <input type="radio" name="tipo" value="Impar">Impar<br>
            <button type="submit" name="apostar">Apostar cantidad</button>
            <button type="submit" name="abandonar">Abandonar el Casino</button>
        </form>