<?php 
class BiciElectrica {
    private $id; // Identificador de la bicicleta (entero)
    private $coordx; // Coordenada X (entero)
    private $coordy; // Coordenada Y (entero)
    private $bateria; // Carga de la batería en tanto por ciento (entero)
    private $operativa; // Estado de la bicleta ( true operativa- false no disponible)

    //constructor
    function __construct(int $id, int $coordx, int $coordy,int $bateria, int $operativa){
        $this->id = $id;
        $this->coordx = $coordx;
        $this->coordy = $coordy;
        $this->bateria = $bateria;
        $this->operativa = $operativa;

    }
    //setter
    function __set($atributo, $valor){
        $this->$atributo = $valor;
    }

    //getter
    function __get($atributo){
        return $this->$atributo;
    }

    //mostrar
    function __toString(){
        return "Identificador: " .$this->id. " Bateria: " .$this->bateria. "%";
    }

    //calcular distancia mas cercana
    function distancia(int $x, int $y):float {
        $distancia =  ($this->coordx - $x)**2 + ($this->coordy - $y)**2;
        $distancia = sqrt($distancia);
        return $distancia;
    }
}



?>