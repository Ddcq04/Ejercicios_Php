<?php 
include_once "ordenarincidencias.php";
function datoCorrecto($dato):bool {
    if(empty($dato) || !isset($dato)) {
        return true;
    }
    strip_tags($dato);
    return false;
}

function transformarDatos($nombre,$problema,$prioridad): string {
   $ip = $_SERVER["REMOTE_ADDR"];
    $nueva_incidencia = [date('d:m:Y H:i'), $nombre, $problema, $prioridad,$ip ];
    return implode(",", $nueva_incidencia);
}   
function subidaFichero($subir) {
    file_put_contents("incidencias.txt","\n" .$subir,FILE_APPEND);
    $ordenado = ordenar();
    $escribir_incidencia = "";
    foreach($ordenado as &$incidencia) {
        $escribir_incidencia .= implode(",",$incidencia). "\n";
    }
    file_put_contents("incidencias.txt", $escribir_incidencia);
}
?>