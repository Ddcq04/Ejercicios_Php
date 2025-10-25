<?php
session_start();
//Si se envio dinero que cree la sesion "dinero_usuario"
if(isset($_POST["dinero"])) {
    $_SESSION["dinero_usuario"] = ($_POST["dinero"] > 0)? $_POST["dinero"] : 0;
}//En caso que no que lo regrese a la pagina principal
if(!isset($_SESSION["dinero_usuario"])) {
    require_once "bienvenida.php";
    exit();
}

$msg="";
    if(isset($_POST["Accion"])) {
        switch($_POST["Accion"]) {
            //Si el usuario elige apostar
            case "Apostar":
                $aleatorio = random_int(1,2);
                $cantidad_apuesta = $_POST["cantidad_apostar"];

                //Si el usuaario no tiene dinero
                if($_SESSION["dinero_usuario"] == 0) {
                    $msg ="Dinero agotado, le recomendamos que cierre sesion"; 
                //Si no introduce una cantidad a apostar
                }elseif(empty($_POST["cantidad_apostar"])){
                    $msg = "ERROR: Introduzca una cantidad a apostar";
                //Si apuesta un numero mayor al dinero que tiene
                }elseif($_SESSION["dinero_usuario"] < $_POST["cantidad_apostar"]) {
                    $msg = "ERROR: No dispone de " .$_POST["cantidad_apostar"]. " euros disponibles";
                //Caso si gana sea par o impar
                }elseif(($_POST["Tipo"] == "Par" && $aleatorio == 2) || ($_POST["Tipo"] == "Impar" && $aleatorio == 1) ) {
                        $msg .= "RESULTADO DE LA APUESTA: " .$_POST["Tipo"]. "<br>";
                        $msg .= "GANASTE";
                        $_SESSION["dinero_usuario"] += $cantidad_apuesta;
                //Si pierde
                }else {
                    $msg .= "PERDISTE";
                    $_SESSION["dinero_usuario"] -= $cantidad_apuesta;
                }
                break;
            //Si el usuario elige abandonar
            case "Abandonar":
                $dinero_final = $_SESSION["dinero_usuario"];
                session_destroy();
                ?>
                <html>
                    <body>
                        <p>Muchas gracias por jugar con nosotros.<br>
                        Su resultado es de <?= $dinero_final ?> euros</p>
                        <button type="submit" onclick="location.href='bienvenida.php'">Volver al inicio</button>
                    </body>
                </html>
                <?php
                exit();
                break;
        }
    }
?>
<html>
    <body>
        <form action="index.php" method="post">
            
            <p><?= $msg ?></p>
            <p>Dispone de <?= $_SESSION["dinero_usuario"] ?> para jugar</p>
            <label for="">Cantidad a apostar: </label><input type="number" name="cantidad_apostar"><br>
            <label for="">Tipo de apuesta: </label><input type="radio" name="Tipo" value="Par" checked>Par
                                                   <input type="radio" name="Tipo" value="Impar">Impar<br>
            <button type="submit" name="Accion" value="Apostar">Apostar cantidad</button>
            <button type="submit" name="Accion" value="Abandonar">Abandonar el Casino</button>
        </form>