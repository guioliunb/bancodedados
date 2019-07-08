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
        <h1 class="title">Gerenciamento<br>Clientes<h1>
        <a class="click" href="inserirdados.php">1. Cadastrar Cliente</a>
        <a class="click" href="buscardados.php">2. Buscar Cliente</a>
        <br>
        <br>
        <a class="click" href="updatedados.php">3. Atualizar Cliente</a>
        <a class="click" href="deletardados.php">4. Deletar Cliente</a>
        <?php
        ?>
    </body>
</html>