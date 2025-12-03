<?php
session_start();
define('CUENTAFICHERO', 'misaldo.txt');

// NO está definido el token
if (!isset($_SESSION['token'])) {
    header('Location: acceso.php?msg=Error+de+acceso 1');
    exit();
}

if($_SESSION["token"] !== $_POST["token"]) {
    $msg = "Error de acceso";
    header("Location: acceso.php?msg=".urlencode($msg));
    exit();
}
$saldo = @file_get_contents(CUENTAFICHERO);
if($saldo == false) {
    echo "Ficherp no se puede leer";
    die();
}


switch($_POST["Orden"]) {
    case "Ingreso":
        if(empty($_POST["importe"]) || !is_numeric($_POST["importe"]) || $_POST["importe"] <=0) {
            $msg = "Importe Erróneo o importe menor de 0 ";
            header("Location: acceso.php?msg=".urlencode($msg));
            exit();
        }
        $saldo = $saldo + $_POST["importe"];
        file_put_contents(CUENTAFICHERO,$saldo);
        $msg = "Operacion realizada";
        header("Location: acceso.php?msg=".urlencode($msg));
        exit();
        break;

    case "Reintegro":
        if($_POST["importe"] <= $saldo) {
            $saldo = $saldo - $_POST["importe"];
            file_put_contents(CUENTAFICHERO, $saldo);
            $msg = "Reintegro exitoso";
            header("Location: acceso.php?msg=".urlencode($msg));
            exit();
        }else{
            $msg = "Importe Erróneo o importe superior al saldo";
            header("Location: acceso.php?msg=".urlencode($msg));
        }
    case "Ver saldo":
        $msg = "Su saldo actual es " .$saldo;
        header("Location: acceso.php?msg=".urlencode($msg));
        exit();
}
