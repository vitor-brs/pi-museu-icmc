<?php 
  if(!isset($_SESSION['logged'])){
    header("Location: login.php");
    exit();
  }
    require_once 'Connection.php';


  function tabInstituicao($dataInicial, $dataFinal){
    $c =  new Connection;
    $row = $c->open('museu');

    $sql = "SELECT * FROM INSTITUICAO_RESPONSAVEL WHERE DT_CAD BETWEEN '$dataInicial' AND '$dataFinal'";

    $r = $row->query($sql);
    return $result = $r->fetchAll(PDO::FETCH_ASSOC);
    $c =  null;
    $row = null;
  }

  function tabAgenda($dataInicial, $dataFinal){
    $c =  new Connection;
    $row = $c->open('museu');

    $sql = "SELECT * FROM AGENDA WHERE DATA BETWEEN '$dataInicial' AND '$dataFinal'";

    $r = $row->query($sql);
    return $result = $r->fetchAll(PDO::FETCH_ASSOC);
    $c =  null;
    $row = null;
  }

  function tabVisitante($dataInicial, $dataFinal){
    $c =  new Connection;
    $row = $c->open('museu');

    $sql = "SELECT * FROM VISITANTE WHERE DT_CAD BETWEEN '$dataInicial' AND '$dataFinal'";

    $r = $row->query($sql);
    return $result = $r->fetchAll(PDO::FETCH_ASSOC);
    $c =  null;
    $row = null;
  }

  function tabInstituicaoAgenda($dataInicial, $dataFinal){
    $c =  new Connection;
    $row = $c->open('museu');

    $sql = "SELECT INSTITUICAO, NOME, TIPO_ORGANIZACAO, CEP, RUA, NUMERO, BAIRRO, CIDADE, UF, DT_CAD, OCUPACAO, EMAIL, TELEFONE,
    DATA, NUM_VISITANTES, STATUS, N_ESPECIAL, DESCRICAO_NECESSIDADE_ESPECIAL, MOTIVO_STATUS, HORA FROM INSTITUICAO_RESPONSAVEL INNER JOIN AGENDA ON INSTITUICAO_RESPONSAVEL.ID = AGENDA.FK_INSTITUICAO_RESPONSAVEL_ID WHERE DATA BETWEEN '$dataInicial' AND '$dataFinal'";

    $r = $row->query($sql);
    return $result = $r->fetchAll(PDO::FETCH_ASSOC);
    $c =  null;
    $row = null;
  }

  function export($data, $filename, $arr){
    // $filename = 'dados.csv';
    
    // $f = fopen('php://output', 'w');
    // $f = fopen('php://output', 'w');
    $f = fopen($filename, 'w');
    
    // if ($f === false) {
    //     die('Error opening the file ' . $filename);
    // }
    fputcsv($f, $arr, ';');
    
    foreach ($data as $row) {
        fputcsv($f, $row, ';');
    }

    fclose($f);
  }
?>