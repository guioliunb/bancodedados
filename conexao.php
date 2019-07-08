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

$nome = filter_input(INPUT_POST, 'name');
$sobrenome = filter_input(INPUT_POST, 'lastname');
$email = filter_input(INPUT_POST, 'email');
$senha = filter_input(INPUT_POST, 'password');
$datanascimento = filter_input(INPUT_POST, 'bday');
$datacadastro = filter_input(INPUT_POST, 'register');
$ultimoacesso = filter_input(INPUT_POST, 'lastacess');
$ultimacompra = filter_input(INPUT_POST, 'lastbuy');
$situacao = filter_input(INPUT_POST, 'status');
$selectall = filter_input(INPUT_POST, 'todos');
$id = filter_input(INPUT_POST, 'id');
//criar conexao 
//selectId(1);
if(isset($_POST["acao"])){
    if($_POST["acao"]== "inserir"){
        inserirPessoa();
        //selectEverybody();
       // voltarIndex();
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
    else if($nome){
        $conn = abrirBanco();
        $query = "SELECT * from clientes WHERE nome = '{$nome}' ";
        $result = $conn->query($query);
       while($fetch = $result->fetch_assoc()) {
                echo "<p>";
                echo "<table><tr><th>Nome Coluna</th><th>Valor Coluna</th><th>Editar</th><th></th></tr>";
                foreach ($fetch as $field => $value) {
                    if($field != 'image')
                    echo "<tr><td>" . $field . "</td><td>" . $value  . "</td></tr>";
                    else{
                    $sql    = "SELECT * FROM clientes WHERE nome = '{$nome}' ";
                    $result = mysqli_query($conn, $sql) or die('Error ' . mysqli_error($conn));
                    $row = mysqli_fetch_array($result);
                    echo "<tr><td>" . $field . "</td><td>".'<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"/>' . "</td></tr>"; 
                       
                    }
                }
            echo "</p>";  
            echo "</table>";
         }
    }   
    else if($id)
    {
        $conn = abrirBanco();
        $query = "SELECT * from clientes WHERE id_cliente = '{$id}' ";
        $result = $conn->query($query);
        while($fetch = $result->fetch_assoc()) {
                echo "<p>";
                echo "<table><tr><th>Nome Coluna</th><th>Valor Coluna</th></tr>";
                foreach ($fetch as $field => $value) {
                    if($field != 'image')
                    echo "<tr><td>" . $field . "</td><td>" . $value  . "</td></tr>";
                    else{
                    $sql    = "SELECT * FROM clientes WHERE id_cliente = '{$id}' ";
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
if(isset($_POST["update"])){
   //FALTA DEIXAR VALORES DEFAULT
    
    $nome = filter_input(INPUT_POST, 'nome');
    $sobrenome = filter_input(INPUT_POST, 'sobrenome');
    $email = filter_input(INPUT_POST, 'email');
    $senha = filter_input(INPUT_POST, 'senha');
    $situacao = filter_input(INPUT_POST, 'status');
    $update = filter_input(INPUT_POST, 'id');
    if($nome!=""){
        $nomei = $nome;
    }
    if($sobrenome!=""){
        $sobrenomei = $sobrenome;
    }
    if($email!=""){
        $emaili = $email;
    }
    if($senha!="NULL"){
        $senhai = $senha;
    }
    
    $conn = abrirBanco();
    $sql = "UPDATE clientes SET nome = '{$nome}', sobrenome = '{$sobrenome}', "
    . "email = '{$email}', senha = '{$senha}', situacao = '{$situacao}' WHERE id_cliente = '{$update}'";
    if($conn->query($sql)){
       echo "Client is updated";
        }    

       //   voltarIndex();

}
if(isset($_POST["delete"])){
   //FALTA DEIXAR VALORES DEFAULT
    
    $nome = filter_input(INPUT_POST, 'nome');
    $update = filter_input(INPUT_POST, 'id');
    $conn = abrirBanco();
    if($nome!="")
    $sql = "delete from clientes where nome = '{$nome}'";
    else{
        $sql = "delete from clientes where id_cliente = '{$update}'";
    }
      if($conn->query($sql)){
       echo "Client is deleted";
        }    
        //Index();

}
if(mysqli_connect_error()){
    die('Connect Error ('. mysqli_connect_errno() .')' .mysqli_connect_error());
}
else{       
   
}
function abrirBanco(){
    $host = 'localhost';
    $dbusername = 'root';
    $dbpassword = '';
    $dbname = 'ecommerce_conectado';
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    return $conn;
}
function selectEverybody(){
    $conn = abrirBanco();
    $query = "SELECT * from clientes";
    $result = $conn->query($query);
    while($fetch = $result->fetch_assoc()) {
                echo "<p>";
                echo "<table><tr><th>Nome Coluna</th><th>Valor Coluna</th></tr>";
                foreach ($fetch as $field => $value) {
                    if($field != 'image')
                    echo "<tr><td>" . $field . "</td><td>" . $value  . "</td></tr>";
                    else{
                    $sql    = "SELECT * FROM clientes ";
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
function inserirPessoa(){
 //INSERT 
    $nome = filter_input(INPUT_POST, 'name');
    $sobrenome = filter_input(INPUT_POST, 'lastname');
    $email = filter_input(INPUT_POST, 'email');
    $senha = filter_input(INPUT_POST, 'password');
    $datanascimento = filter_input(INPUT_POST, 'bday');
    $datacadastro = filter_input(INPUT_POST, 'register');
    $ultimoacesso = filter_input(INPUT_POST, 'lastacess');
    $ultimacompra = filter_input(INPUT_POST, 'lastbuy');
    $situacao = filter_input(INPUT_POST, 'status');
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    //echo $nome.$sobrenome.$email.$senha.$datanascimento.$datacadastro.$ultimoacesso.$ultimacompra.$situacao;
    if($check !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
    }
    $conn = abrirBanco();
    $sql = "INSERT INTO clientes(nome, sobrenome, email, senha, data_nasc, data_cadastro, ult_acesso, ult_compra, situacao, image)
        values ('$nome', '$sobrenome','$email', '$senha', '$datanascimento', '$datacadastro','$ultimoacesso','$ultimacompra', '$situacao','$imgContent')";
    
    if($conn->query($sql)){
       echo "New record is inserted";
        }    
    $conn->close();
   // voltarIndex();
    
}

function voltarIndex(){
    header("Location:index.php");
}
 ?>
    
    </body>
</html>