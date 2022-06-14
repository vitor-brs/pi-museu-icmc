<?php 
  session_start();
  if(!isset($_SESSION['logged'])){
    header("Location: login.php");
    exit();
  }elseif  (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_destroy();
    session_unset();
    header("Location: login.php");
    exit();
  
  }else{
    require_once 'Connection.php';

    $c =  new Connection;

    $data = date("Y-m-d");
    $mes = date("n");
    $ano = date("Y");
   
    if(isset($_POST['nome'])){
        $idInstituicao = $_POST['id_instituicao'];
        $nome = $_POST['nome'];
        $ocupacao = $_POST['ocupacao'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];

        $sql = "UPDATE INSTITUICAO_RESPONSAVEL SET NOME =:NOME, OCUPACAO =:OCUPACAO, EMAIL =:EMAIL, TELEFONE =:TELEFONE WHERE ID =:ID";
        $row = $c->open('museu');
        $dados = $row->prepare($sql)->execute(["NOME" => $nome, "OCUPACAO" => $ocupacao, "EMAIL" => $email, "TELEFONE" => $telefone, "ID" => $idInstituicao]);
        $_SESSION['id'] = $idInstituicao;
        $c = null;
        $row = null;
        header("Location: editar.php");
        exit();
    }
    
    if(isset($_POST['instituicao'])){
        $idInstituicao = $_POST['id_instituicao2'];
        $instituicao = $_POST['instituicao'];
        $organizacao = $_POST['organizacao'];
        $cep = $_POST['cep'];
        $rua = $_POST['rua'];
        $numero = $_POST['numero'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $uf = $_POST['uf'];

        $sql = "UPDATE INSTITUICAO_RESPONSAVEL SET INSTITUICAO =:INSTITUICAO, TIPO_ORGANIZACAO =:TIPO_ORGANIZACAO, CEP =:CEP, RUA =:RUA, NUMERO =:NUMERO, BAIRRO =:BAIRRO, CIDADE =:CIDADE, UF =:UF WHERE ID = $idInstituicao";
        $row = $c->open('museu');
        $dados = $row->prepare($sql)->execute(["INSTITUICAO" =>$instituicao, "TIPO_ORGANIZACAO" =>$organizacao, "CEP" =>$cep, "RUA" =>$rua, "NUMERO" =>$numero, "BAIRRO" =>$bairro, "CIDADE" =>$cidade, "UF" =>$uf]);
        $_SESSION['id'] = $idInstituicao;
        $c = null;
        $row = null;
        header("Location: editar.php");
        exit();
    }

    if(isset($_POST['id_agenda1'])){
       atualizar('1', $_POST['id_agenda1']);
        
        header("Location: agenda.php");
    }
    if(isset($_POST['id_agenda2'])){
        atualizar('2', $_POST['id_agenda2']);
         
         header("Location: agenda.php");
     }
     if(isset($_POST['id_agenda3'])){
        atualizar('3', $_POST['id_agenda3']);
         
         header("Location: agenda.php");
     }

  }

  function atualizar($params, $id){
    $data = $_POST['data'.$params];
    $hora = $_POST['hora'.$params];
    $num_visitantes = $_POST['num_visitantes'.$params];
    $status = $_POST['group-select-status'.$params];
    $n_especial = $_POST['textareaNecessidadeEspecial'.$params];
    $sql = "UPDATE AGENDA SET DATA =:DATA, HORA =:HORA, NUM_VISITANTES =:NUM_VISITANTES, STATUS =:STATUS, DESCRICAO_NECESSIDADE_ESPECIAL =:DESCRICAO_NECESSIDADE_ESPECIAL WHERE ID =:ID ";
    $c =  new Connection;
    $row = $c->open('museu');
    $dados = $row->prepare($sql)->execute(["DATA" =>$data, "HORA" =>$hora, "NUM_VISITANTES" =>$num_visitantes, "STATUS" =>$status, "DESCRICAO_NECESSIDADE_ESPECIAL" =>$n_especial, "ID" =>$id]);
    $c = null;
    $row = null;
  }
 
?>