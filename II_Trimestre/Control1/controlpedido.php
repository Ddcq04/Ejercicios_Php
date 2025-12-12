<?php
include_once "BBDD/AccesoDatos.php";

$ac = AccesoDatos::getModelo();
echo "a";
$nombre = $_POST["usuario"];
$clave = $_POST["contraseña"];
$cli = $ac->getCliente($nombre,$clave);

if($cli) {
    $tpedidos = $ac->getPedidos($cli->cod_cliente);
    $ac->incrementarVeces($cli->cod_cliente);
    echo "Mostrando los pedidos del cliente" . count($tpedidos);
    //include_once "vistapedidos.php";
}else {
    $msg = "No se encuentra el usuario";
    include_once "vistas/vistaerror.php";
}
?>