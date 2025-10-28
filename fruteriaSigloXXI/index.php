<?php
require_once "precios.php";
session_start();

// Manejo de la sesión con dos valores
// 'cliente' => nombre del cliente
// 'pedido' => array asociativo fruta => cantidad


// Nuevo cliente: anoto en la sesión su nombre y creo su tabla de pedidos vacía 
if (isset($_GET['cliente'])) {
    $_SESSION["cliente"] = $_GET["cliente"];
    if(!isset($_SESSION["pedido"]))
        $_SESSION["pedido"] = [];
}

// No hay definido un cliente todavía en la session
if (!isset($_SESSION['cliente'])) {
    require_once "bienvenida.php";
    exit();
}

// Proceso las acciones 
if (isset($_POST["accion"])) {
    $fruta = $_POST["fruta"];
    $cantidad = $_POST["cantidad"];

    switch ($_POST["accion"]) {
        case " Anotar ":
            // Actualizo la tabla de pedidos en la sesión
            
            if(!isset($_SESSION["pedido"][$fruta])) {
                $_SESSION["pedido"][$fruta] = $cantidad;
            }else $_SESSION["pedido"][$fruta] += $cantidad;
            break;
        case " Anular ":
            // Vacío la tabla de pedidos en la sesión
            unset($_SESSION["pedido"][$fruta]);
            break;
        case " Terminar ":
            $compraRealizada = htmlTablaPedidos();
            // Destruyo la sesión y vuelvo a la página de bienvenida
            session_destroy();
            require_once "despedida.php";
            exit();
            break;
    }
}
$compraRealizada = htmlTablaPedidos();
require_once 'compra.php';


// Función axiliar que genera una tabla HTML a partir  la tabla de pedidos
// Almacenada en la sesión
function htmlTablaPedidos(): string
{
    $msg = "";
    $msg .= "<table>";
    foreach($_SESSION["pedido"] as $fruta => $cantidad) {
        $msg .= "<tr><td>$fruta: $cantidad</td></tr>";
    }
    $msg .= "</table>";
    return $msg;
}
