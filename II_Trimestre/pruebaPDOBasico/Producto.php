<?php
class Producto {
    private $id;
    private $nombre;
    private $precio;
    private $stock;


    public function __get($nom) {
        if(property_exists($this,$nom)) {
            return $this->$nom;
        }
    }
    public function __set($nom,$value) {
        if(property_exists($this,$nom)) {
            $this->$nom = $value;
        }
    }

    // Método auxiliar para mostrar info
    public function info() {
        return "[ID: {$this->id}] {$this->nombre} - Precio: {$this->precio}$ (Stock: {$this->stock})";
    }
}

?>