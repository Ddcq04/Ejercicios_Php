<?php
class Cliente {
    private $cod_cliente;
    private $nombre;
    private $clave;
    private $veces;

    function __get($name){
        return $this->$name;
    }

    function __set($name, $value){
        $this->$name = $value;
    }
}
?>