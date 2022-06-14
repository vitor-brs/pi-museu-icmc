<?php 
  session_start();
  if(!isset($_SESSION['logged'])){
    header("Location: login.php");
    exit();
  }else{
    require_once 'Connection.php';

    $c =  new Connection;

    $data = date("Y-m-d");
    $mes = date("n");
    $ano = date("Y");

    //Dados Cartão Agendados para Hoje

    $sqlTotalAgendadosHoje = "SELECT COUNT(STATUS) as total_dia_agendado FROM AGENDA WHERE DATA = '$data' AND STATUS = 'Agendado'";
    $sqlTotalConfirmadosHoje = "SELECT COUNT(STATUS) as total_dia_agendado FROM AGENDA WHERE DATA = '$data' AND STATUS = 'Confirmado'";
    
    $row = $c->open('museu');
    $agendadosHoje = $row->query($sqlTotalAgendadosHoje);
    $resultAgendados = $agendadosHoje->fetch(PDO::FETCH_ASSOC);

    $confirmadosHoje = $row->query($sqlTotalConfirmadosHoje);
    $resultConfirmados = $confirmadosHoje->fetch(PDO::FETCH_ASSOC);

    $somaAgendamentoHoje = $resultConfirmados['total_dia_agendado'] + $resultAgendados['total_dia_agendado'];
    
    //Dados Cartão Cancelados
    $sqlTotalCancelados = "SELECT COUNT(AGENDA.STATUS) as total_cancelados FROM AGENDA WHERE STATUS = 'Cancelado'";
    $cancelados = $row->query($sqlTotalCancelados);
    $resultCancelados = $cancelados->fetch(PDO::FETCH_ASSOC);

    //Dados Cartão Faltas
    $sqlTotalFaltas = "SELECT COUNT(AGENDA.STATUS) as total_faltas FROM AGENDA WHERE STATUS = 'Faltou'";
    $faltas = $row->query($sqlTotalFaltas);
    $resultFaltaram = $faltas->fetch(PDO::FETCH_ASSOC);

    //Dados Cartão total de visitas no mês
    $sqlTotalConcluidoMes = "SELECT COUNT(AGENDA.STATUS) as total_visitas_mes FROM AGENDA WHERE STATUS = 'Concluído' AND month(DATA)= '$mes'";
    $concluidosMes = $row->query($sqlTotalConcluidoMes);
    $resultConcluidosMes = $concluidosMes->fetch(PDO::FETCH_ASSOC); 

    //Dados Cartão total de visitas no Ano
    $sqlTotalConcluidoAno = "SELECT COUNT(AGENDA.STATUS) as total_visitas_ano FROM AGENDA WHERE STATUS = 'Concluído' AND year(DATA)= '$ano'";
    $concluidosAno = $row->query($sqlTotalConcluidoAno);
    $resultConcluidosAno = $concluidosAno->fetch(PDO::FETCH_ASSOC);
    
    //Necessidade Especial para Hoje
    $sqlTotalNecessidadeEspecial = "SELECT COUNT(AGENDA.N_ESPECIAL) as total_necessidade_especial FROM AGENDA WHERE DATA = '$data' AND N_ESPECIAL = 'on' AND STATUS = 'Agendado'";
    $sqlTotalNecessidadeEspecial2 = "SELECT COUNT(AGENDA.N_ESPECIAL) as total_necessidade_especial FROM AGENDA WHERE DATA = '$data' AND N_ESPECIAL = 'on' AND STATUS = 'Confirmado'";
    $necessidadeEspecial = $row->query($sqlTotalNecessidadeEspecial);
    $resultNecessidadeEspecial = $necessidadeEspecial->fetch(PDO::FETCH_ASSOC); 

    $necessidadeEspecial2 = $row->query($sqlTotalNecessidadeEspecial2);
    $resultNecessidadeEspecial2 = $necessidadeEspecial2->fetch(PDO::FETCH_ASSOC); 

    $sumNecessidade =  $resultNecessidadeEspecial['total_necessidade_especial'] + $resultNecessidadeEspecial2['total_necessidade_especial'];


    $c = null;
    $row = null;


  }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
    <link rel="icon" href="assets/img/museu-favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="assets/css/mdb.min.css" />
    <link rel="stylesheet" href="assets/css/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/fabric-icons-inline.css">

    <link rel="stylesheet" href="assets/css/dashboard/styles.css" />
    <link rel="stylesheet" href="assets/css/dashboard/main.css" />
    
</head>
<body>
    <!-- Navbar -->
<nav class="navbar text-white fixed-top">
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
          Dashboard
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
                <li class="nav-item w-100 pt-0 mb-0 li-active">
                        <a href="dashboard.php" class="nav-link link-dark d-flex active">
                        <i class="ms-Icon ms-Icon--Home me-2 fs-6 my-1"></i>
                        <span id="home" class="collapse navbar-collapse my-1">Home</span>
                        </a>
                </li>
            </ul>
            <hr class="my-1">
            <ul class="nav flex-column mb-auto">
              <li class="nav-item">
                <a href="agenda.php" class="nav-link link-dark d-flex">
                        <i class="ms-Icon ms-Icon--Calendar me-2 fs-6 my-1"></i>
                        <span id="agenda" class="collapse navbar-collapse">Agenda</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="relatorio.php" class="nav-link link-dark d-flex">
                  <i class="ms-Icon ms-Icon--ReportDocument me-2 fs-6 my-1"></i>
                  <span id="relatorios" class="collapse navbar-collapse">Relatórios</span>
                </a>
              </li>
              <li class="nav-item">
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
          <div class="container-fluid">
            <div class="">
              <!-- Tabs navs -->
                <ul class="nav nav-tabs nav-justified mb-3" id="ex1" role="tablist">
                  <li class="nav-item text-start" role="presentation">
                    <a
                      class="nav-link active"
                      id="ex2-tab-1"
                      data-mdb-toggle="tab"
                      href="#ex2-tabs-1"
                      role="tab"
                      aria-controls="ex2-tabs-1"
                      aria-selected="true"
                      >Sumário</a
                    >
                  </li>
                </ul>
                <!-- Tabs navs -->

                <!-- Tabs content -->
                <div class="tab-content" id="ex2-content">
                  <div
                    class="tab-pane fade show active py-3"
                    id="ex2-tabs-1"
                    role="tabpanel"
                    aria-labelledby="ex2-tab-1"
                  >
                    <!-- Tab 1 content -->
                      <!-- Sumário -->
                  <div class="card-group">
                      <div class="card mb-3 mx-4 bg-primary" style="min-width: 12rem; max-height: 10rem;">

                        <div class="card-body text-white">
                          <h5 class="card-title"><i class="ms-Icon ms-Icon--EventDate mx-1"></i><span>Agendados para Hoje</span></h5>
                          <p class="card-text text-center fs-1">
                          <?php 
                            echo $somaAgendamentoHoje;
                           ?></p>
                        </div>
                      </div>
                      <div class="card mb-3 mx-4 bg-danger" style="min-width: 12rem; max-height: 10rem;">
  
                        <div class="card-body text-white">
                          <h5 class="card-title"><i class="ms-Icon ms-Icon--EventDeclined mx-1"></i>Cancelados</h5>
                          <p class="card-text text-center fs-1">
                          <?php 
                            echo $resultCancelados['total_cancelados'];
                           ?>
                          </p>
                        </div>
                      </div>
                      <div class="card mb-3 mx-4 bg-warning" style="min-width: 12rem; max-height: 10rem;">
  
                        <div class="card-body text-white">
                          <h5 class="card-title"><i class="ms-Icon ms-Icon--EventDateMissed12 mx-1"></i>Faltaram</h5>
                          <p class="card-text text-center fs-1">
                          <?php 
                            echo $resultFaltaram['total_faltas'];
                           ?>
                          </p>
                        </div>
                      </div>
                      <div class="card mb-3 mx-4 bg-info" style="min-width: 12rem; max-height: 10rem;">
    
                          <div class="card-body text-white">
                            <h5 class="card-title"><i class="ms-Icon ms-Icon--Calendar mx-1"></i>Total de visitas Mês</h5>
                            <p class="card-text text-center fs-1">
                              <?php 
                                echo $resultConcluidosMes['total_visitas_mes'];
                              ?>
                            </p>
                          </div>
                      </div>
                      <div class="card mb-3 mx-4 bg-info" style="min-width: 12rem; max-height: 10rem;">
        
                              <div class="card-body text-white">
                                <h5 class="card-title"><i class="ms-Icon ms-Icon--Calendar mx-1"></i>Total de Visitas Ano</h5>
                                <p class="card-text text-center fs-1">
                                  <?php 
                                    echo $resultConcluidosAno['total_visitas_ano'];
                                  ?>
                                </p>
                              </div>
                      </div>
              </div>
              <div id="" class="card-group">
                <?php 
                  if ($sumNecessidade != 0) {
                    echo '<div class="card mb-3 mx-4 bg-warning" style="max-width: 18rem;">';
                  }else{
                    echo '<div class="card mb-3 mx-4 bg-success" style="max-width: 18rem;">';
                  }
                ?>
                
                    <div class="card-body text-white">
                      <h5 class="card-title"><i class="ms-Icon ms-Icon--EventInfo mx-1"></i>Necessidade Especial</h5>
                      <p class="card-text text-center"><strong>
                        <?php 
                          echo $sumNecessidade;
                        ?>
                      </strong> Registros para visitantes com necessidade especial para hoje.</p>
                    </div>
                </div>

              </div>
             
                 
                </div>
                <!-- Tabs content -->
            </div>
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
            <a href="logout.php" type="button" class="btn btn-primary">Sim</a>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript" src="assets/js/mdb.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/popper.js"></script>
    <script type="text/javascript" src="assets/js/dashboard/scripts.js"></script>

    
</body>
</html>