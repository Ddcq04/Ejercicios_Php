<?php
class Usuario {

    function __construct(private $nombre,private $contraseña,private $inicios_sesion){
    }
    function __get($atributo) {
        return $this->$atributo;
    }
    
    function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
}

?>