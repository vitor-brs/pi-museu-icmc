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
    $ano = date("Y");

    require_once 'consultas.php';
    
}

  function exibe($result){
    echo '<h4>Lista Agenda por período</h4>';
    echo '<table class="table table-bordered tables-font">
    <thead class="table-light">
      <tr>
        <th scope="col">NOME</th>
        <th scope="col">EMAIL</th>
        <th scope="col">TELEFONE</th>
        <th scope="col">INSTITUICAO</th>
        <th scope="col">DATA</th>
        <th scope="col">HORA</th>
        <th scope="col">NUM_VISITANTES</th>
        <th scope="col">STATUS</th>
        <th scope="col">DESCRICAO_NECESSIDADE_ESPECIAL</th>
      </tr>
    </thead>
    <tbody>';
    foreach($result as $row){
      echo '<tr>
            <td>'.$row['NOME'].'</td>
            <td>'.$row['EMAIL'].'</td>
            <td>'.$row['TELEFONE'].'</td>
            <td>'.$row['INSTITUICAO'].'</td>
            <td>'.$row['DATA'].'</td>
            <td>'.$row['HORA'].'</td>
            <td>'.$row['NUM_VISITANTES'].'</td>
            <td>'.$row['STATUS'].'</td>
            <td>'.$row['DESCRICAO_NECESSIDADE_ESPECIAL'].'</td>
            </tr>
      ';
    }
     echo '</tbody>
  </table>';
  }
  function listaAgenda($dataInicial, $dataFinal){
    $c =  new Connection;
    $sql = "SELECT * FROM AGENDA INNER JOIN INSTITUICAO_RESPONSAVEL ON INSTITUICAO_RESPONSAVEL.ID = AGENDA.FK_INSTITUICAO_RESPONSAVEL_ID WHERE DATA BETWEEN '$dataInicial' AND '$dataFinal'";
    $row = $c->open('museu');
    $relAgenda = $row->query($sql);
    return $result = $relAgenda->fetchAll(PDO::FETCH_ASSOC);
    
  }

  function consolidado($ano){
    
    $array = [];
        $sqlConsolidado = "SELECT COUNT(AGENDA.STATUS) as concluidos FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano'";
        $sqlJaneiro = "SELECT COUNT(AGENDA.STATUS) as janeiro FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano' AND month(DATA)=1";
        $sqlFevereiro = "SELECT COUNT(AGENDA.STATUS) as fevereiro FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano' AND month(DATA)=2";
        $sqlMarco = "SELECT COUNT(AGENDA.STATUS) as marco FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano' AND month(DATA)=3";
        $sqlAbril = "SELECT COUNT(AGENDA.STATUS) as abril FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano' AND month(DATA)=4";
        $sqlMaio = "SELECT COUNT(AGENDA.STATUS) as maio FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano' AND month(DATA)=5";
        $sqlJunho = "SELECT COUNT(AGENDA.STATUS) as junho FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano' AND month(DATA)=6";
        $sqlJulho = "SELECT COUNT(AGENDA.STATUS) as julho FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano' AND month(DATA)=7";
        $sqlAgosto = "SELECT COUNT(AGENDA.STATUS) as agosto FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano' AND month(DATA)=8";
        $sqlSetembro = "SELECT COUNT(AGENDA.STATUS) as setembro FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano' AND month(DATA)=9";
        $sqlOutubro = "SELECT COUNT(AGENDA.STATUS) as outubro FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano' AND month(DATA)=10";
        $sqlNovembro = "SELECT COUNT(AGENDA.STATUS) as novembro FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano' AND month(DATA)=11";
        $sqlDezembro = "SELECT COUNT(AGENDA.STATUS) as dezembro FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano' AND month(DATA)=12";
        
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

        return $c = array_merge($janeiro, $fevereiro, $marco, $abril, $maio, $junho, $julho, $agosto, $setembro, $outubro, $novembro, $dezembro, $result);
  }

  function exibeConsolidado($row, $ano){
   
      echo '<h4>Consolidado total de visitas no ano</h4>';
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
  
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>
    
    <link rel="icon" href="assets/img/museu-favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="assets/css/mdb.min.css" />
    <link rel="stylesheet" href="assets/css/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/fabric-icons-inline.css">
    <link rel="stylesheet" type="text/css" href="assets/css/datatables/datatables.min.css"/>
    <link rel="stylesheet" href="assets/css/datatables/responsive/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/datatables/buttons/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="assets/css/relatorio/styles.css" />
    <link rel="stylesheet" href="assets/css/relatorio/main.css" />

</head>
<body>
    <!-- Navbar -->
<nav class="navbar text-white fixed-top nav-bar">
    <!-- Container wrapper -->
    <div class="container-fluid">
      <div class="justify-content-start">
        <!-- Toggle button -->
      <button
      id="btnMenuExpand"
      class="navbar-toggler p-0 mx-1"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target=".navbar-collapse"
      aria-controls="home agenda relatorios visitantes"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="ms-Icon ms-Icon--GlobalNavButton text-white"></i>
    </button>

  <!-- Collapsible wrapper -->
      <!-- Navbar brand navbar-brand -->
      <a id="menuExpand" class="text-white mx-4" href="dashboard.php">
          Dashboard |
      </a>
      <a class="text-white" href="relatorio.php">
        Relatórios
    </a>
      </div>
      <!-- Collapsible wrapper -->

      <!-- Right elements -->
      <div class="d-flex align-items-center">
        <!-- Icon -->
        <a class="text-reset me-3" href="#" type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#aboutModal">
          <i class="ms-Icon ms-Icon--Help"></i>
        </a>
  

        <!-- Avatar -->
        <div class="dropdown">
          <a
            class="dropdown-toggle d-flex align-items-center hidden-arrow text-white"
            href="#"
            id="navbarDropdownMenuAvatar"
            role="button"
            data-mdb-toggle="dropdown"
            aria-expanded="false"
          >
            <img
              src="assets/img/dashboard/user_ink.svg"
              class="rounded-circle"
              height="25"
              alt="Figura com desenho de avatar"
              loading="lazy"
            />
          </a>
          <ul
            class="dropdown-menu dropdown-menu-end"
            aria-labelledby="navbarDropdownMenuAvatar"
          >
            <li>
              <a class="dropdown-item" href="#" type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#logoutModal">Logout</a>
            </li>
          </ul>
        </div>
      </div>
      <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
  </nav>
  <!-- Navbar -->
    

    <aside>
        <div id="sidebarMenu" class="d-flex flex-column flex-shrink-0 align-items-top sidebarMenuExpand">    
            <ul class="nav flex-column mb-0">
                <li class="nav-item w-100 pt-0 mb-0">
                        <a href="dashboard.php" class="nav-link link-dark d-flex">
                        <i class="ms-Icon ms-Icon--Home me-2 fs-6 my-1"></i>
                        <span id="home" class="collapse navbar-collapse my-1">Home</span>
                        </a>
                </li>
            </ul>
            <hr class="my-1">
            <ul class="nav flex-column mb-auto">
              <li class="nav-item w-100 pt-0 mb-0">
                <a href="agenda.php" class="nav-link link-dark d-flex">
                        <i class="ms-Icon ms-Icon--Calendar me-2 fs-6 my-1"></i>
                        <span id="agenda" class="collapse navbar-collapse">Agenda</span>
                </a>
              </li>
              <li class="nav-item li-active w-100 pt-0 mb-0">
                <a href="relatorio.php" class="nav-link link-dark d-flex active">
                  <i class="ms-Icon ms-Icon--ReportDocument me-2 fs-6 my-1"></i>
                  <span id="relatorios" class="collapse navbar-collapse">Relatórios</span>
                </a>
              </li>
              <li class="nav-item w-100 pt-0 mb-0">
                <a href="exportar.php" class="nav-link link-dark d-flex">
                    <i class="ms-Icon ms-Icon--Export me-2 fs-6 my-1"></i>
                    <span id="exportar" class="collapse navbar-collapse">Exportar</span>
                </a>
              </li>
            </ul>
            <hr>
          </div>        
    </aside>
    
    <main id="main" class="main w-100">
            <nav class="navbar navbar-expand-lg nav-bg container-fluid">
              <div class="row">
                <form method="POST">
                  <div class="row">
                    <span class="col-3">Relatório</span>
                    <select class="form-select form-select-sm col mb-3" aria-label=".form-select-sm example" name="relatorio">
                      <option value="0">Consolidado</option>
                      <option value="1">Agenda</option>
                      <option value="2">Visitantes por mês no ano</option>
                      <option value="3">Consultar registro da Agenda</option>
                    </select>
                  </div>
                  <div class="row">
                    <div class="col row">
                      <span class="col">Data de Início</span>
                      <input class="form-control form-control-sm col" id="formFileSm" type="date" name="data-inicial">    
                    </div>
                    <div class="col row">
                      <span class="col">Data de Fim</span>
                      <input class="form-control form-control-sm col" id="formFileSm" type="date" name="data-final">
                    </div>
                  </div>
              </div>
              
              <div class="mx-5">
                <button class="btn btn-info" type="submit">Ver Relatório</button>
              </div>
              </form>
            </nav>
            <div class="p-2">
              <?php 
              if(isset($_POST['relatorio'])){
                $relatorio = $_POST['relatorio'];
                $dataInicial = $_POST['data-inicial'];
                $dataFinal = $_POST['data-final'];
                switch ($relatorio) {
                  case 0:
                        $inicial = date_create($dataInicial);
                        $final = date_create($dataFinal);
                        $dInicial = date_format($inicial, "Y");
                        $dFinal = date_format($final, "Y");
                        if($dInicial == $dFinal){
                          $ano = $dInicial;
                          $r = consolidado($ano);
                          exibeConsolidado($r, $ano);
                        }else{
                          $arr = array($dInicial, $dFinal);
                          foreach($arr as $a){                          
                            exibeConsolidado(consolidado($a), $a);
                          }                          
                        }
                        break;      
                  case 1:
                        $r = listaAgenda($dataInicial, $dataFinal);        
                        exibe($r);
                        break;
                  case 2:
                        $inicial = date_create($dataInicial);
                        $final = date_create($dataFinal);
                        $dInicial = date_format($inicial, "Y");
                        $dFinal = date_format($final, "Y");
                        if($dInicial == $dFinal){
                          $ano = $dInicial;
                          $r = visitantesPorMes($ano);
                          exibeVisitantesPorMes($r, $ano);
                        }else{
                          $arr = array($dInicial, $dFinal);
                          foreach($arr as $a){                          
                            exibeVisitantesPorMes(visitantesPorMes($a), $a);
                          }                          
                        }
                        break;
                  case 3:
                        $result = consultaRegistros($dataInicial, $dataFinal);
                        exibeConsultaAgenda($result);

                }
              }
              
              ?>
            </div>
    </main>



    <!-- Modal -->
    <div class="modal top " id="aboutModal" tabindex="-1" aria-labelledby="aboutModalLabel" aria-hidden="true" data-mdb-backdrop="true" data-mdb-keyboard="true">
      <div class="modal-dialog modal-lg  modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="aboutModalLabel">Sobre</h5>
            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <p class="text-center">
              Desenvolvido pelos alunos da <img src="assets/img/Univesp_logo_png_rgb.png" alt="Logo marca da Universidade Virtual do Estado de São Paulo" width="200px">
              <p class="text-center">
              BRUNA DOS SANTOS SAMPAIO <br>
              DOUGLAS TOFFOLETTO <br>
              FERNANDA MARIA DIAS DE GOZ <br>
              MARCELO LAZARO DE OLIVEIRA <br>
              PAULO SOUZA DANEU <br>
              VITOR B. R. SILVA <br>
              VIVIANE BEZERRA CAMPOS
              </p>

            </p>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
              Fechar
            </button>
            
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal top fade" id="logoutModal" tabindex="-1" aria-labelledby="logouModalLabel" aria-hidden="true" data-mdb-backdrop="true" data-mdb-keyboard="true">
      <div class="modal-dialog modal-sm  modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="logouModalLabel">Logout</h5>
            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">Deseja realmente sair do sistema?</div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
              Não
            </button>
            <!-- <button type="button" class="btn btn-primary" >Sim</button> -->
            <a href="logout.php" type="button" class="btn btn-primary" >Sim</a>
          </div>
        </div>
      </div>
    </div>


    <script type="text/javascript" src="assets/js/mdb.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/popper.js"></script>
    <script type="text/javascript" src="assets/js/relatorio/scripts.js"></script>
</body>
</html>