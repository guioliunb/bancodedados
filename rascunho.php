<?php
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Buscar Pedido</title>
        <style>
            body {
                text-align: left;
                margin: 4em;
                font-size: 32px;
                text: black;
                background-color: blue;
            }
            input {
                width: 256px;
                height: 32px;
                font-size: 16px;
            }
            .send {
                height: 128px;
                width: 256x;
                font-size: 32px;
                background-color: aqua;
            }
        </style>
    </head>
    <body>
        <h1>Buscar Pedido</h1>
        <form method="post" action="conexaopedidos.php">
            Todos Pedidos:<input type="submit" name="todos" value="Clique Aqui">
            <br>
            <br>
            Buscar por Cliente:<input type="text" name="cliente" value="" size="32">
            <br>
            <br>
            Buscar por Pedido:<input type="text" name="id" value="0" size="32">
            <br>
            <br>
            <tr>
                <td><input type="hidden" name="select" value="buscar" /></td>
                <td><input class="send" type="submit" value="Enviar" name="Enviar" /></td>
            </tr>
        </form>
    </body>
</html>