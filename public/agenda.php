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
    $sql = "SELECT * FROM INSTITUICAO_RESPONSAVEL INNER JOIN AGENDA ON INSTITUICAO_RESPONSAVEL.ID = AGENDA.FK_INSTITUICAO_RESPONSAVEL_ID WHERE DATA = '$data' " ;
    $sqlMensal = "SELECT * FROM INSTITUICAO_RESPONSAVEL INNER JOIN AGENDA ON INSTITUICAO_RESPONSAVEL.ID = AGENDA.FK_INSTITUICAO_RESPONSAVEL_ID WHERE month(DATA)= $mes " ;

    $row = $c->open('museu');
    $dados = $row->query($sql);
    $result = $dados->fetchAll(PDO::FETCH_ASSOC);
    
    $dadosMensal = $row->query($sqlMensal);
    $resultMensal = $dadosMensal->fetchAll(PDO::FETCH_ASSOC);
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
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    
    <link rel="icon" href="assets/img/museu-favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="assets/css/mdb.min.css" />
    <link rel="stylesheet" href="assets/css/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/fabric-icons-inline.css">
    <link rel="stylesheet" type="text/css" href="assets/css/datatables/datatables.min.css"/>
    <link rel="stylesheet" href="assets/css/datatables/responsive/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/datatables/buttons/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="assets/css/agenda/styles.css" />
    <link rel="stylesheet" href="assets/css/agenda/main.css" />

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
          Dashboard |
      </a>
      <a class="text-white" href="agenda.php">
        Agenda
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
              <li class="nav-item li-active w-100 pt-0 mb-0">
                <a href="agenda.php" class="nav-link link-dark d-flex active">
                        <i class="ms-Icon ms-Icon--Calendar me-2 fs-6 my-1"></i>
                        <span id="agenda" class="collapse navbar-collapse">Agenda</span>
                </a>
              </li>
              <li class="nav-item w-100 pt-0 mb-0">
                <a href="relatorio.php" class="nav-link link-dark d-flex">
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
                  <li class="nav-item text-start" role="presentation">
                    <a
                      class="nav-link"
                      id="ex2-tab-2"
                      data-mdb-toggle="tab"
                      href="#ex2-tabs-2"
                      role="tab"
                      aria-controls="ex2-tabs-2"
                      aria-selected="false"
                      >Dados Agenda Mensal</a
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
                  
                      <div class="card-group mb-3">
                        <div class="card mb-3 mx-4" >
                        <!-- <div class="card-header"></div> -->
                          <div class="card-body">
                        
                            <h5 class="card-title"><i class="ms-Icon ms-Icon--EventDate mx-1"></i><span>Agendados para Hoje</span></h5>
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
                              <tbody>
                                <?php 

                                  if ($result) {
                                    foreach ($result as $rows) {
                                      echo "<tr><td>" . $rows['HORA'] . '</td><td><div class="d-flex align-items-center"><i class="ms-Icon ms-Icon--Contact fs-2" style="width: 45px; height: 45px"></i>
                                      <div class="ms-3">
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
                                ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                  
                    

              
              <!-- Sumário end-->
                    <!--  -->
                  </div>
                  <div
                    class="tab-pane fade py-3"
                    id="ex2-tabs-2"
                    role="tabpanel"
                    aria-labelledby="ex2-tab-2"
                  >
                    <!-- Agenda mensal -->
                        <!-- Date Input -->
                        
                        <!-- Date Input -->

                    <div class="card-group mb-3">
                      <div class="card mb-3 mx-4" >
                      <!-- <div class="card-header"></div> -->
                        <div class="card-body">
                         
                          <h5 class="card-title"><i class="ms-Icon ms-Icon--Calendar mx-1"></i><span>Agenda Mensal</span></h5>
                          
                          <table id="table-agenda-mensal" class="table table-responsive-sm align-middle mb-0 bg-white">
                            <thead class="bg-light">
                              <tr>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Nome</th>
                                <th>Instituição</th>
                                <th>Status</th>
                                <th>N. Especial</th>
                                <th>Ação</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php 

                              if ($resultMensal) {
                                foreach ($resultMensal as $rows) {
                                  echo "<tr><td>" . $rows['DATA'] . '</td>
                                  <td>' . $rows['HORA'] . '</td>
                                  <td><div class="d-flex align-items-center"><i class="ms-Icon ms-Icon--Contact fs-2" style="width: 45px; height: 45px"></i>
                                  <div class="ms-3">
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
                            ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <!-- Agenda mensal -->
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
    <script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/popper.js"></script>

    <script type="text/javascript" src="assets/js/agenda/scripts.js"></script>

    <script type="text/javascript" src="assets/js/agenda/main.js"></script>
</body>
</html>