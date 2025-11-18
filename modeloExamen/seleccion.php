<?php 
session_start();

if(!isset($_SESSION["nombre"])) {
    $_SESSION["nombre"] = "";
}
if(isset($_POST["nombre"])) {
    $_SESSION["nombre"] = $_POST["nombre"];
}

//Lenguajes
if(!isset($_SESSION["lenguajes"])) {
    $_SESSION["lenguajes"] = [];
}
if(isset($_POST["nombre"])) {
    $_SESSION["lenguajes"] = $_POST["lenguajes"];
}
function estaLenguaje($lenguaje):bool {
    return in_array($lenguaje,$_SESSION["lenguajes"]);
}


$nombre = $_SESSION["nombre"];



?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Selección de personal</title>
</head>
<body>
<h2> Datos de candidato: Paso 2º </h2>
<form  action="seleccion.php" method="POST">
<fieldset>
<legend>Datos Profesionales </legend>
Nombre : <input type="text" name="nombre" value="<?= $nombre ?>"></br>
Lenguajes de programación:<br>
<select name="lenguajes[]" multiple="multiple" size=6>
     <option value="Java"           <?= estaLenguaje("Java")?"selected='selected'":'' ?>>Java</option>    
     <option value="Javascript"    <?= estaLenguaje("Javascript")?"selected='selected'":'' ?>>Javascript</option>
     <option value="Php"            <?= estaLenguaje("Php")?"selected='selected'":'' ?>>Php</option>
     <option value="Python"         <?= estaLenguaje("Python")?"selected='selected'":'' ?>>Python</option>
     <option value="Perl"           <?= estaLenguaje("Perl")?"selected='selected'":'' ?>>Perl</option>
     <option value="C#"             <?= estaLenguaje("C#")?"selected='selected'":'' ?>>C#</option>
     </select><br>
<input type="submit" value="Enviar">
</fieldset>
</form>
</body>
</html>

