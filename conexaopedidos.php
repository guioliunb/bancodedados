<html>
<head>
<style>
table {
  border-collapse: collapse;
}
table, th, td {
    border: 1px solid black;
}
table {
  width: 100%;
}

th {
  height: 50px;
} 
th {
  text-align: left;
} 
td {
  height: 50px;
  vertical-align: bottom;
} 
th, td {
  padding: 15px;
  text-align: left;
} 
th, td {
  border-bottom: 1px solid #ddd;
} 
tr:hover {background-color: #f5f5f5;} 
th {
  background-color: #4CAF50;
  color: white;
} 
</style>
</head>
<body>

<?php
$host = 'localhost';
$dbusername = 'root';
$dbpassword = '';
$dbname = 'ecommerce_conectado';

$cliente = filter_input(INPUT_POST, 'cliente');
$endereco = filter_input(INPUT_POST, 'endereco');
$pagamento = filter_input(INPUT_POST, 'pagamento');
$totalproduto = filter_input(INPUT_POST, 'produto');
$totalfrete = filter_input(INPUT_POST, 'frete');
$totaldesconto = filter_input(INPUT_POST, 'desconto');
$totalpedido = filter_input(INPUT_POST, 'pedido');
$datapedido = filter_input(INPUT_POST, 'datapedido');
$previsaoentrega = filter_input(INPUT_POST, 'previsao');
$entregaefetiva = filter_input(INPUT_POST, 'efetivada');

$selectall = filter_input(INPUT_POST, 'todos');
$id = filter_input(INPUT_POST, 'id');
//criar conexao 
//selectId(1);
if(isset($_POST["acao2"])){
    if($_POST["acao2"]== "inserir"){
        inserirCliente();
        //selectEverybody();
        //voltarIndex();
    }
}
if(isset($_POST["select"])){
    /*
    $con = abrirBanco();
    $sql    = "SELECT * FROM clientes WHERE id_cliente = 74";
    $result = mysqli_query($con, $sql) or die('Error ' . mysqli_error($con));
    $row = mysqli_fetch_array($result);
    echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"/>'; 
     */
   /////////////////IMAGEM
    if($selectall){
        $show = selectEverybody();
        var_dump($show);
    }
    else if($cliente){
        $conn = abrirBanco1();
        $query = "SELECT * from pedidos WHERE id_cliente = '{$cliente}' ";
        $result = $conn->query($query);
       while($fetch = $result->fetch_assoc()) {
                echo "<p>";
                echo "<table><tr><th>Nome Coluna</th><th>Valor Coluna</th><th>Editar</th><th>Deletar</th></tr>";
                foreach ($fetch as $field => $value) {
                    
                    if($field != 'image')
                    echo "<tr><td>" . $field . "</td><td>" . $value  . "</td></tr>";
                    else{
                    $sql    = "SELECT * FROM pedidos WHERE id_cliente = '{$cliente}' ";
                    $result = mysqli_query($conn, $sql) or die('Error ' . mysqli_error($conn));
                    $row = mysqli_fetch_array($result);
                    echo "<tr><td>" . $field . "</td><td>".'<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"/>' . "</td></tr>"; 
                       $cliente = $cliente + 1;
                    }
                }
            echo "</p>";  
            echo "</table>";
         }
    }   
    else if($id)
    {
        $conn = abrirBanco1();
        $query = "SELECT * from pedidos WHERE num_pedido = '{$id}' ";
        $result = $conn->query($query);
        while($fetch = $result->fetch_assoc()) {
                echo "<p>";
                echo "<table><tr><th>Nome Coluna</th><th>Valor Coluna</th></tr>";
                foreach ($fetch as $field => $value) {
                    if($field != 'image')
                    echo "<tr><td>" . $field . "</td><td>" . $value  . "</td></tr>";
                    else{
                    $sql    = "SELECT * FROM pedidos WHERE num_pedido = '{$id}' ";
                    $result = mysqli_query($conn, $sql) or die('Error ' . mysqli_error($conn));
                    $row = mysqli_fetch_array($result);
                    echo "<tr><td>" . $field . "</td><td>".'<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"/>' . "</td></tr>"; 
                       
                    }
                }
            echo "</p>";  
            echo "</table>";
        }    
    }
    
    //voltarIndex();
}
if(isset($_POST["update2"])){
   //FALTA DEIXAR VALORES DEFAULT
$pedido = filter_input(INPUT_POST, 'kaka');
$cliente = filter_input(INPUT_POST, 'cliente');
$endereco = filter_input(INPUT_POST, 'endereco');
$pagamento = filter_input(INPUT_POST, 'pagamento');
$totalproduto = filter_input(INPUT_POST, 'produto');
$totalfrete = filter_input(INPUT_POST, 'frete');
$totaldesconto = filter_input(INPUT_POST, 'desconto');
$totalpedido = filter_input(INPUT_POST, 'pedido');
$datapedido = filter_input(INPUT_POST, 'datapedido');
$previsaoentrega = filter_input(INPUT_POST, 'previsao');
$entregaefetiva = filter_input(INPUT_POST, 'efetivada');
$status_pedido = filter_input(INPUT_POST, 'status');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce_conectado";
echo $pedido;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
    }
    
$sql = "UPDATE pedidos SET total_prod = '{$totalproduto}',total_frete = '{$totalfrete}', total_desc = '{$totaldesconto}',"
. "total_pedido = '{$totalpedido}', data_pedido = '{$datapedido}',"
. "previsao_entrega= '{$previsaoentrega}', efetiva_entrega = '{$entregaefetiva}',"
. " image = '{$imgContent}' WHERE num_pedido='{$pedido}'";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
voltarIndex();

}
if(isset($_POST["deletar"])){
   //FALTA DEIXAR VALORES DEFAULT
$pedido = filter_input(INPUT_POST, 'kaka');
$cliente = filter_input(INPUT_POST, 'cliente');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce_conectado";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// É NECESSARIO APAGAR PRIMEIROA CHAVE DA TABELA VIRTUAL
if($pedido!=null){
    $sqlbefore = "DELETE FROM rastreabilidade where num_pedido = '{$pedido}'";
    $sql = "DELETE FROM pedidos WHERE num_pedido='{$pedido}'";
    if ($conn->query($sqlbefore) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
else{
    $sql = "DELETE FROM pedidos WHERE id_cliente ='{$cliente}'";
}
voltarIndex();  
$conn->close();

}

function abrirBanco1(){
    $host = 'localhost';
    $dbusername = 'root';
    $dbpassword = '';
    $dbname = 'ecommerce_conectado';
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    return $conn;
}
function selectEverybody(){
    $conn = abrirBanco1();
    $query = "SELECT * from pedidos";
    $result = $conn->query($query);
    while($fetch = $result->fetch_assoc()) {
                echo "<p>";
                echo "<table><tr><th>Nome Coluna</th><th>Valor Coluna</th></tr>";
                foreach ($fetch as $field => $value) {
                    if($field != 'image')
                    echo "<tr><td>" . $field . "</td><td>" . $value  . "</td></tr>";
                    else{
                    $sql    = "SELECT * FROM pedidos ";
                    $result = mysqli_query($conn, $sql) or die('Error ' . mysqli_error($conn));
                    $row = mysqli_fetch_array($result);
                    echo "<tr><td>" . $field . "</td><td>".'<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"/>' . "</td></tr>"; 
                       
                    }
                }
            echo "</p>";  
            echo "</table>";
        }
}
/*
function selectIdPessoa($id){
    $banco = abrirBanco();
    $sql = "SELECT * from clientes WHERE id =".$id;
    $resultado = $banco->query($sql);
    $banco->close();
    $cliente = mysqli_fetch_assoc($resultado);

    return $cliente; 
}*/
function selectId($id){
    $conn = abrirBanco();
    $query = "SELECT * from clientes WHERE id_cliente = '{$id}' ";
    $result = $conn->query($query);
    while($fetch = $result->fetch_assoc()) {
        echo "<p>";
        echo "<table><tr><th>Nome Coluna</th><th>Valor Coluna</th></tr>";
        foreach ($fetch as $field => $value) {
            echo "<tr><td>" . $field . "</td><td>" . $value  . "</td></tr>";
        }
        echo "</p>";  
        echo "</table>";
    }
}
function inserirCliente(){
    $cliente = filter_input(INPUT_POST, 'cliente');
    $endereco = filter_input(INPUT_POST, 'endereco');
    $pagamento = filter_input(INPUT_POST, 'pagamento');
    $totalproduto = filter_input(INPUT_POST, 'produto');
    $totalfrete = filter_input(INPUT_POST, 'frete');
    $totaldesconto = filter_input(INPUT_POST, 'desconto');
    $totalpedido = filter_input(INPUT_POST, 'pedido');
    $datapedido = filter_input(INPUT_POST, 'datapedido');
    $previsaoentrega = filter_input(INPUT_POST, 'previsao');
    $entregaefetiva = filter_input(INPUT_POST, 'efetivada');
    $link = abrirBanco1();
    $status_ped = filter_input(INPUT_POST, 'status');
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
    }
    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    // Attempt insert query execution
    $sql = "INSERT INTO pedidos (id_cliente,id_pagto,total_prod,total_frete"
            . ",total_desc,total_pedido,data_pedido,previsao_entrega"
            . ",efetiva_entrega,status_ped,image) VALUES"
            . " ('$cliente', '$pagamento','$totalproduto', '$totalfrete',"
            . "'$totaldesconto','$totalpedido', '$datapedido','$previsaoentrega',"
            . " '$entregaefetiva', '$status_ped', '$imgContent')";
    if(mysqli_query($link, $sql)){
        echo "Records inserted successfully.";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }

    // Close connection
    mysqli_close($link);
   // voltarIndex();  
}

function voltarIndex(){
    header("Location:index.php");
}
 ?>
    
    </body>
</html>