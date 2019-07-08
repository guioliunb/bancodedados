<html>
<head>
<title>...</title>
<style type="text/css">
body, html {
  margin: 0;
  padding: 0;
  height: 100%;
  width: 100%;
  font-family: 'Open Sans', sans-serif;
  
}

main {
  height: 100%;
  width: 100%;
}

aside {
  background-color: #0799d3;
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  width: 20%;
  z-index: 1;
}

section {
  position: relative;
  width: 100%;
  height: 100%;
  background-color: #fff;
  overflow: hidden;
}

label {
  display: inline-block;
  padding: 7px 10px;
  background-color: transparent;
  cursor: pointer;
  margin: 10px;
  z-index: 3;
  position: fixed;
}

.bar {
  display: block;
  background-color: #0799d3;
  width: 30px;
  height: 3px;
  border-radius: 5px;
  margin: 5px auto;
  transition: background-color .5s ease-in, transform .5s ease-in, width .5s ease-in;
}

.content {
  top: 0;
  bottom: 0;
  position: absolute;
  right: 0;
  left: 0;
  background-color: #fff;
  z-index: 2;
  transition: transform .5s ease-in-out;
}

h1 {
  margin: 0;
  position: relative;
  top: 50%;
  left: 0;
  right: 0;
  transform: translateY(-50%);
  text-align: center;
  font-size: 40px;
}

.asideList {
  list-style: none;
  padding: 0;
  margin: 0;
  margin-top: 100px;
  text-align: center;
  border-top: 2px solid rgba(255, 255, 255, .7);
}

.asideAnchor {
  border-bottom: 2px solid rgba(255, 255, 255, .7);
  padding: 20px 0;
  display: block;
  color: #fff;
  text-transform: uppercase;
  text-decoration: none;
  font-size: 20px;
  font-weight: 500;
  position: relative;
  transition: color .3s .15s ease-in;
}

.asideAnchor::after {
  content: "";
  position: absolute;
  left: 0;
  bottom: 0;
  height: 100%;
  background-color: #fff;
  width: 0;
  transition: width .3s ease-in;
  z-index: -1;
}

.asideAnchor:hover {
  color: #0799d3;
}

.asideAnchor:hover::after {
  width: 100%;
}

input[type="checkbox"] {
  display: none;
}

input[type="checkbox"]:checked ~ .content {
  transform: translateX(20%);
}

input[type="checkbox"]:checked ~ label .bar {
  background-color: #fff;
}

input[type="checkbox"]:checked ~ label .top {
  -webkit-transform: translateY(0px) rotateZ(45deg);
  -moz-transform: translateY(0px) rotateZ(45deg);
  -ms-transform: translateY(0px) rotateZ(45deg);
  -o-transform: translateY(0px) rotateZ(45deg);
  transform: translateY(0px) rotateZ(45deg);
}

input[type="checkbox"]:checked ~ label .bottom {
  -webkit-transform: translateY(-15px) rotateZ(-45deg);
  -moz-transform: translateY(-15px) rotateZ(-45deg);
  -ms-transform: translateY(-15px) rotateZ(-45deg);
  -o-transform: translateY(-15px) rotateZ(-45deg);
  transform: translateY(-15px) rotateZ(-45deg);
}

input[type="checkbox"]:checked ~ label .middle {
  width: 0;
}

.middle {
  margin: 0 auto;
}

.ua {
  position: absolute;
  right: 20px;
  bottom: 20px;
  color: #0799d3;
  font-size: 2em;
  z-index: 2;
}

</style>
</head>
<body>
<<main>
  <aside>
    <ul class="asideList">
     <li><a href="inserirdados.php" class="asideAnchor">Inserir Cliente</a></li>
      <li><a href="buscardados.php" class="asideAnchor">Buscar Cliente</a></li>
      <li><a href="updatedados.php" class="asideAnchor">Alterar Cliente</a></li>
      <li><a href="deletardados.php" class="asideAnchor">Deletar Cliente</a></li>
       <li><a href="inserirpedidos.php" class="asideAnchor">Inserir Pedido</a></li>
       <li><a href="buscarpedidos.php" class="asideAnchor">Buscar Pedido</a></li>
       <li><a href="updatepedidos.php" class="asideAnchor">Alterar Pedido</a></li>
      <li><a href="deletarpedidos.php" class="asideAnchor">Deletar Pedido</a></li>
    </ul>
  </aside>
  <section>
    <input type="checkbox" id="myInput">
    <label for="myInput">
      <span class="bar top"></span>
      <span class="bar middle"></span>
      <span class="bar bottom"></span>
    </label>
    <div class="content" >
        
      <h1 style="font-family:verdana;"
          
          >E-COMMERCE</h1><P></P><P></P>
        <h1>SISTEMA DE COMPRAS</h1>
    </div>
  </section>
</main>

<a href="https://codepen.io/tonkec" class="ua" target="_blank">
  <i class="fa fa-user"></i></a>
    
</body>
</html>
<?php
// style="background-image:url(C:\Users\Guilherme Oliveira.LAPTOP-0PIH6311\Desktop\PROJETO FINAL BANCO DE DADOS)" 
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

