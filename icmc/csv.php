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