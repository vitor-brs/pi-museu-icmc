<?php 

  require_once 'Connection.php';
  if(isset($_POST['nome'])){
    $nome = addslashes($_POST['nome']);
    $ocupacao = addslashes($_POST['ocupacao']);
    $dataNascimento = addslashes($_POST['data-nascimento']);
    $cidade = addslashes($_POST['cidade']);
    $uf = addslashes($_POST['uf']);
    $mensagem = addslashes($_POST['comentarios']);
    $dataCad = date("Y-m-d");
  
    $c = new Connection;
    $row = $c->open('museu');
    $sql = "INSERT INTO VISITANTE (NOME, OCUPACAO, DT_NASCIMENTO, CIDADE, UF, MENSAGEM, DT_CAD) VALUES (
       '$nome', 
       '$ocupacao', 
       '$dataNascimento', 
       '$cidade', 
       '$uf', 
       '$mensagem', '$dataCad')";
    $r = $row->query($sql);
    $row=null;
    $c=null;
  }
  

?>