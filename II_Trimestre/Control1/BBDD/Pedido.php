<?php
class Pedido {
    private $numped;
    private $cod_cliente;
    private $producto;
    private $precio;

    function __get($name){
        return $this->$name;
    }

    function __set($name, $value)
    {
        $this->$name = $value;
    }
}
?>