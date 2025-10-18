<?php
function usuarioOk($usuario, $contraseña) :bool {
    $validador_contraseña = strrev($usuario); 
    if(strlen($usuario) > 2 && $validador_contraseña === $contraseña) {
        return true;
   }else return false;
}

function limite300Caracteres($texto): bool {
    if(strlen($texto) > 300) {
        return true;
    }else return false;
}


//Funciones de Detalles
function longitudTexto($texto): int {
    $texto = strip_tags($texto);
    return strlen($texto);
}

function contarPalabras($texto): int {
    $texto = strip_tags($texto);
    return str_word_count($texto);
}

function letraMasRepetida($texto): string {
    $texto = strip_tags($texto);
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
    return array_search(max($contadorLetras), $contadorLetras);
}
function palabraMasRepetida($texto): string {
    $texto = strip_tags($texto);
    //mediante explode divido el texto recibido por espacios y genera un array de ello
    $palabras = explode(" ",$texto);
    $contador_palabras = [];
    //La misma funcionalidad de letraMasRepetida()
    for($i=0; $i<count($palabras); $i++) {
        $palabra = $palabras[$i];
        if(isset($contador_palabras[$palabra])) {
            $contador_palabras[$palabra]++;
        }else $contador_palabras[$palabra] = 1;
    }
    return array_search(max($contador_palabras),$contador_palabras);
}