<?php if(limite300Caracteres($_REQUEST["comentario"])):?>
            <div>
                <p>ERROR: Ha excedido los 300 carácteres en el comentario</p>
            </div>

<?php else:?>
    <div>
    <b> Detalles:</b><br>
    <table>
    <tr><td>Longitud:          </td><td><?= longitudTexto($_REQUEST['comentario']) ?></td></tr>
    <tr><td>Nº de palabras:    </td><td><?= contarPalabras($_REQUEST["comentario"]) ?></td></tr>
    <tr><td>Letra + repetida:  </td><td><?= letraMasRepetida($_REQUEST["comentario"]) ?></td></tr>
    <tr><td>Palabra + repetida:</td><td><?= palabraMasRepetida($_REQUEST["comentario"]) ?></td></tr>
    </table>
    </div>
<?php endif; ?>
