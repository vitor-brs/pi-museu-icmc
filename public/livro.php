<?php 
  if(!isset($_SESSION['logged'])){
    header("Location: login.php");
    exit();
  }elseif  (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
  session_destroy();
  session_unset();
  header("Location: login.php");
  exit();

  }
  require_once 'Connection.php';
  if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
    $ocupacao = $_POST['ocupacao'];
    $dataNascimento = $_POST['data-nascimento'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $mensagem = $_POST['comentarios'];
    $dataCad = date("Y-m-d");
  
    $c = new Connection;
    $row = $c->open('museu');
    $sql = "INSERT INTO VISITANTE (NOME, OCUPACAO, DT_NASCIMENTO, CIDADE, UF, MENSAGEM, DT_CAD) VALUES ('$nome', '$ocupacao', '$dataNascimento', '$cidade', '$uf', '$mensagem', '$dataCad')";
    $r = $row->query($sql);
    $row=null;
    $c=null;
  }
  

?>