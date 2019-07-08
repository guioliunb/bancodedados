<?php include("conexao.php");
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pagina Inicial</title>
        <style>
            body {
                font-size: 32px;
                background-color:darkslategray;
                font-style: oblique;
                margin: 4em;
                text-align: left;
            }
            .click {
                color: black;
                padding: 64px;
            }
            .title {
                color: gold;
            }
        </style>
    </head>
    <body>
        <h1 class="title">SISTEMA <br>CINEMA<h1>
        <a class="click" href="indexcliente.php">1. Gerenciar Clientes</a>
        <br>
        <br>
        <a class="click" href="indexpedidos.php">2. Gerenciar Pedidos</a>
        <?php
        ?>
    </body>
</html>