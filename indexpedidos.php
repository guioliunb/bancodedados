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
        <h1 class="title">Gerenciamento <br>Pedidos<h1>
                <a class="click" href="inserirpedidos.php">1. Cadastrar pedidos</a>
        <br>
        <br>
        <a class="click" href="buscarpedidos.php">2. Buscar pedidos</a>
        <br>
        <br>
        <a class="click" href="updatepedidos.php">3. Atualizar pedidos</a>
        <br>
        <br>
        <a class="click" href="deletarpedidos.php">4. Deletar pedidos</a>
        <?php
        ?>
    </body>
</html>