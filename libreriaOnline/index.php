
<?php
//Token
require_once "funciones.php";
session_start();
$precios_libros = [
    "PHP" => 25.00,
    "JavaScript" => 35.50,
    "HTML" => 20.00,
    "BBDD" => 30.00,
    "Python" => 28.50
];

if(!isset($_SESSION["usuario"])){
    if(isset($_REQUEST["nombre"]) && isset($_REQUEST["apellido"]) && isset($_REQUEST["contraseña1"]) && isset($_REQUEST["contraseña2"])) {
        $contraseña_ok = false;
        if($_POST["contraseña1"] !== $_POST["contraseña2"]) {
            $msg = "La contraseña no son iguales";
        }elseif(hayMayus($_POST["contraseña1"]) || hayMinus($_POST["contraseña2"])) {
            $msg = "La contraseña no contiene mayuscula o minuscula";
        }else $contraseña_ok = true;
            
        if($contraseña_ok) {
            //Creacion de usuario si ha pasado las validaciones
            $_SESSION["usuario"] = ["nombre" => $_REQUEST["nombre"],
                                    "apellido" => $_REQUEST["apellido"],
                                    "correo" => $_REQUEST["correo"],
                                 "contraseña1" => $_REQUEST["contraseña1"],
                                 "contraseña2" => $_REQUEST["contraseña2"]];
            $_SESSION["cesta"] = [];
        }else {
            include_once "bienvenida.php";
            exit();
        }
    }else {
        include_once "bienvenida.php";
        exit();
    }
}
//Para rediccionarlo en caso que los campos vacios
//INDICE
if(isset($_POST["accion"])) {
    switch($_POST["accion"]) {
        case " Anotar ":
            anotar($_SESSION["cesta"],$_POST["libro"], $_POST["cantidad"]);
            break;
        case " Anular ":
            anular($_SESSION["cesta"],$_POST["libro"]);
            break;
        case " Terminar ":
            $tabla_final = mostrarPrecios($_SESSION["cesta"],$precios_libros);
            include_once "despedida.php";
            session_destroy();
            exit();
            break;
    }
}
$tabla = mostrarTabla($_SESSION["cesta"]);
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Compra libros</title>
    </head>
    <body>
        <?= $tabla ?>
        <form method="post">
            <label for="libro">Selecciona el libro:</label>
            <select name="libro" id="fruta">
                <?= listadoLibros($precios_libros); ?>
            </select><br><br>
            Introduzca cantidad que desea: <br>
            <input type="number" name="cantidad" value="1"><br><br>

            <input type="submit" name="accion" value=" Anotar ">	
            <input type="submit" name="accion" value=" Anular ">	
            <input type="submit" name="accion" value=" Terminar ">	

        </form>
        
    </body>
</html>