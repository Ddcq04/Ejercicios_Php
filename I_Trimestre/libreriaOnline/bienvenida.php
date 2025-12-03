<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
        <body>
            <h1> Bienvenido a la libreria</h1>
            <form action="index.php" method="post">
                Nombre: <input type="text" name="nombre" value= '<?php if(isset($_REQUEST["nombre"])) {
                                                                        $_REQUEST["nombre"];
                                                                    }else "" ?>'><br>
                Apellido <input type="text" name="apellido"><br>
                Email: <input type="text" name="correo"><br>
                Contraseña: <input type="text" name="contraseña1"><br>
                Repita su contraseña: <input type="text" name="contraseña2"><br><br>

                <button type="submit" name="enviar">Enviar</button>
            </form>
        </body>
</html>