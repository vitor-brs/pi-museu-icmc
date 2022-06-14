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

  function exibeVisitantesPorMes($row, $ano){
   
    echo '<h4>Visitantes por mês no ano</h4>';
    echo '<table class="table table-bordered tables-font">
    <thead class="table-light">
      <tr>
      <th scope="col">Ano</th>
      <th scope="col">Janeiro</th>
      <th scope="col">Fevereiro</th>
      <th scope="col">Março</th>
      <th scope="col">Abril</th>
      <th scope="col">Maio</th>
      <th scope="col">Junho</th>
      <th scope="col">Julho</th>
      <th scope="col">Agosto</th>
      <th scope="col">Setembro</th>
      <th scope="col">Outubro</th>
      <th scope="col">Novembro</th>
      <th scope="col">Dezembro</th>
      <th scope="col">Total</th>
      </tr>
    </thead>
    <tbody>';

      echo '<tr>
            <td>'.$ano.'</td>
            <td>'.$row['janeiro'].'</td>
            <td>'.$row['fevereiro'].'</td>
            <td>'.$row['marco'].'</td>
            <td>'.$row['abril'].'</td>
            <td>'.$row['maio'].'</td>
            <td>'.$row['junho'].'</td>
            <td>'.$row['julho'].'</td>
            <td>'.$row['agosto'].'</td>
            <td>'.$row['setembro'].'</td>
            <td>'.$row['outubro'].'</td>
            <td>'.$row['novembro'].'</td>
            <td>'.$row['dezembro'].'</td>
            <td>'.$row['concluidos'].'</td>
            </tr>
      ';

     echo '</tbody>
  </table>';
 
}
  function visitantesPorMes($ano){
    
    $array = [];
        $sqlConsolidado = "SELECT SUM(AGENDA.NUM_VISITANTES) as concluidos FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano'";
        $sqlJaneiro = "SELECT SUM(AGENDA.NUM_VISITANTES) as janeiro FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano' AND month(DATA)=1";
        $sqlFevereiro = "SELECT SUM(AGENDA.NUM_VISITANTES) as fevereiro FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano' AND month(DATA)=2";
        $sqlMarco = "SELECT SUM(AGENDA.NUM_VISITANTES) as marco FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano' AND month(DATA)=3";
        $sqlAbril = "SELECT SUM(AGENDA.NUM_VISITANTES) as abril FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano' AND month(DATA)=4";
        $sqlMaio = "SELECT SUM(AGENDA.NUM_VISITANTES) as maio FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano' AND month(DATA)=5";
        $sqlJunho = "SELECT SUM(AGENDA.NUM_VISITANTES) as junho FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano' AND month(DATA)=6";
        $sqlJulho = "SELECT SUM(AGENDA.NUM_VISITANTES) as julho FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano' AND month(DATA)=7";
        $sqlAgosto = "SELECT SUM(AGENDA.NUM_VISITANTES) as agosto FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano' AND month(DATA)=8";
        $sqlSetembro = "SELECT SUM(AGENDA.NUM_VISITANTES) as setembro FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano' AND month(DATA)=9";
        $sqlOutubro = "SELECT SUM(AGENDA.NUM_VISITANTES) as outubro FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano' AND month(DATA)=10";
        $sqlNovembro = "SELECT SUM(AGENDA.NUM_VISITANTES) as novembro FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano' AND month(DATA)=11";
        $sqlDezembro = "SELECT SUM(AGENDA.NUM_VISITANTES) as dezembro FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano' AND month(DATA)=12";
        
        $c =  new Connection;
        $row = $c->open('museu');
        $reljaneiro = $row->query($sqlJaneiro);
        $janeiro = $reljaneiro->fetch(PDO::FETCH_ASSOC);
        $relFevereiro = $row->query($sqlFevereiro);
        $fevereiro = $relFevereiro->fetch(PDO::FETCH_ASSOC);
        $relMarco = $row->query($sqlMarco);
        $marco = $relMarco->fetch(PDO::FETCH_ASSOC);
        $relAbril = $row->query($sqlAbril);
        $abril = $relAbril->fetch(PDO::FETCH_ASSOC);
        $relMaio = $row->query($sqlMaio);
        $maio = $relMaio->fetch(PDO::FETCH_ASSOC);
        $relJunho = $row->query($sqlJunho);
        $junho = $relJunho->fetch(PDO::FETCH_ASSOC);
        $relJulho = $row->query($sqlJulho);
        $julho = $relJulho->fetch(PDO::FETCH_ASSOC);
        $relAgosto = $row->query($sqlAgosto);
        $agosto = $relAgosto->fetch(PDO::FETCH_ASSOC);
        $relSetembro = $row->query($sqlSetembro);
        $setembro = $relSetembro->fetch(PDO::FETCH_ASSOC);
        $relOutubro = $row->query($sqlOutubro);
        $outubro = $relOutubro->fetch(PDO::FETCH_ASSOC);
        $relNovembro = $row->query($sqlNovembro);
        $novembro = $relNovembro->fetch(PDO::FETCH_ASSOC);
        $relDezembro = $row->query($sqlDezembro);
        $dezembro = $relDezembro->fetch(PDO::FETCH_ASSOC);

        $consolidado = $row->query($sqlConsolidado);
        $result = $consolidado->fetch(PDO::FETCH_ASSOC);
        $c = null;
        $row = null;
        return $c = array_merge($janeiro, $fevereiro, $marco, $abril, $maio, $junho, $julho, $agosto, $setembro, $outubro, $novembro, $dezembro, $result);
  }

  function exibeConsultaAgenda($row){
    echo '<div class="card-group mb-3">
    <div class="card mb-3 mx-4" >
    <!-- <div class="card-header"></div> -->
      <div class="card-body">
    
        <h5 class="card-title"><i class="ms-Icon ms-Icon--EventDate mx-1"></i><span>Consulta Agenda</span></h5>
        <table id="table-agenda-dia" class="table table-responsive-sm align-middle mb-0 bg-white" data-bs-full-pagination="true" data-bs-sm="true" data-bs-hover="true" data-bs-striped="true">
          <thead class="bg-light">
            <tr>
              <th>Hora</th>
              <th>Nome</th>
              <th>Instituição</th>
              <th>Status</th>
              <th>N. Especial</th>
              <th>Ação</th>
            </tr>
          </thead>
          <tbody>' ; 
            
                if ($row) {
                  foreach ($row as $rows) {
                    echo '<tr><td>' . $rows['HORA'] . '</td><td><div class="d-flex align-items-center"><i class="ms-Icon ms-Icon--Contact fs-2" style="width: 45px; height: 45px"></i>'.
                    '<div class="ms-3">
                    <p class="fw-bold mb-1">' . $rows['NOME'] . '</p>
                    <p class="text-muted mb-0">' . $rows['EMAIL'] . '</p>
                    </div>
                    </div>
                    </td>
                    <td>
                    <p class="fw-normal mb-1">' . $rows['INSTITUICAO'] . '</p>
                    <p class="text-muted mb-0">' . $rows['TIPO_ORGANIZACAO'] . '</p>
                    </td>
                    <td>' . 
                    funCheckStatus($rows['STATUS']) . $rows['STATUS'] . '</span>
                    </td>
                    <td>' . funCheckNecessidade($rows['N_ESPECIAL']) . '</td>
                    <td>
                    <form method="POST" action="editar.php" id="formAgenda" name="formAgenda">
                    <button name="btnEditar" value="'. $rows['FK_INSTITUICAO_RESPONSAVEL_ID'] .' " type="submit" class="btn btn-link btn-sm btn-rounded fw-bold">
                    Editar
                    </button>
                    </form>
                    </td>
                    </tr>';
                  }
                }
              
              
            echo '
          </tbody>
        </table>
      </div>
    </div>
  </div>';
  }
  function consultaRegistros($dataInicial, $dataFinal){
    $c =  new Connection;
    $sql = "SELECT * FROM INSTITUICAO_RESPONSAVEL INNER JOIN AGENDA ON INSTITUICAO_RESPONSAVEL.ID = AGENDA.FK_INSTITUICAO_RESPONSAVEL_ID WHERE DATA BETWEEN '$dataInicial' AND '$dataFinal' " ;
    // $sqlMensal = "SELECT * FROM INSTITUICAO_RESPONSAVEL INNER JOIN AGENDA ON INSTITUICAO_RESPONSAVEL.ID = AGENDA.FK_INSTITUICAO_RESPONSAVEL_ID WHERE month(DATA)= $mes " ;

    $row = $c->open('museu');
    $dados = $row->query($sql);
    return $result = $dados->fetchAll(PDO::FETCH_ASSOC);
    
    // $dadosMensal = $row->query($sqlMensal);
    // $resultMensal = $dadosMensal->fetchAll(PDO::FETCH_ASSOC);
    $c = null;
    $row = null;
  }

  function funCheckStatus($params){
    switch($params){
        case 'Agendado':
            return '<span class="badge badge-secondary rounded-pill d-inline">';
            break;
        case 'Confirmado':
            return '<span class="badge badge-primary rounded-pill d-inline">';
            break;
        case 'Concluído':
            return '<span class="badge badge-success rounded-pill d-inline">';
            break;
        case 'Faltou':
            return '<span class="badge badge-warning rounded-pill d-inline">';
            break;
        case 'Cancelado':
            return '<span class="badge badge-danger rounded-pill d-inline">';
            break;
    }
}  

function funCheckNecessidade($params){
  if($params == "on"){
      return '<i class="ms-Icon ms-Icon--Wheelchair fs-3" data-mdb-toggle="tooltip" data-mdb-placement="bottom" title="Este visitante possui necessidade especial"></i>';
  }
}

?>