<?php
function usuarioOk($usuario, $contraseña) :bool {
    $validador_contraseña = strrev($usuario); 
    if(strlen($usuario) >= 8 && $validador_contraseña === $contraseña) {
        return true;
   }else return false;
}

function limpiezaTexto(&$texto): string {
    $texto = strip_tags($texto);
    return trim($texto);
}
function limite300Caracteres($texto): bool {
    $texto = limpiezaTexto($texto);
    if(strlen($texto) > 300) {
        return true;
    }else return false;
}


//Funciones de Detalles
function longitudTexto($texto): int {
    $texto = limpiezaTexto($texto);
    return strlen($texto);
}

function contarPalabras($texto): int {
    $texto = limpiezaTexto($texto);
    return str_word_count($texto);
}

function letraMasRepetida($texto): string {
    $texto = limpiezaTexto($texto);
    //Si no introduce nada o introduce espacios en blanco
    if(empty($texto)) {
        return "No introducio ninguna letra";
    }else {
        $contador_letras = [];
        for($i=0; $i<strlen($texto); $i++) {
            $letra = $texto[$i];
            //para evitar numeros o espacios en blanco
            if(ctype_alpha($letra)) {
                //si la letra existe aumentarle
                if(isset($contadorLetras[$letra])){
                    $contadorLetras[$letra]++;
                    //en caso que no darle valor
                }else $contadorLetras[$letra] = 1;            
            }
        }
    }
    return array_search(max($contadorLetras), $contadorLetras);
}
function palabraMasRepetida($texto): string {
    $texto = limpiezaTexto($texto);
    
    if(empty($texto)) {
        return "No hay ninguna palabra";
    }else {
        //mediante explode divido el texto recibido por espacios y genera un array de ello
        $palabras = explode(" ",$texto);
        $contador_palabras = [];
        //La misma funcionalidad de letraMasRepetida()
        for($i=0; $i<count($palabras); $i++) {
            $palabra = $palabras[$i];
            //Si hay mucho espacio entre palabras hago que se las salte para evitar errores al mostrar la palabra mas repetida
            if($palabra == "") {
                continue;
            }
            if(isset($contador_palabras[$palabra])) {
                $contador_palabras[$palabra]++;
            }else $contador_palabras[$palabra] = 1;
        }
        return array_search(max($contador_palabras),$contador_palabras);
    }
}