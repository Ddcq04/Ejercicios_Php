<?php
function ordenar() {
    $fichero = file("incidencias.txt",FILE_IGNORE_NEW_LINES |  FILE_SKIP_EMPTY_LINES);
    $datos_incidencias = [];
    for($i=0; $i<count($fichero); $i++) {
        $datos_incidencias[$i] = explode(",", $fichero[$i]);
    }
    usort($datos_incidencias,function ($a, $b) {
        return $a[3] - $b[3];
    });
    return $datos_incidencias;
}
