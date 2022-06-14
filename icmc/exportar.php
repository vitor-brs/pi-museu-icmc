<?php 
  session_start();
  if(!isset($_SESSION['logged'])){
    header("Location: login.php");
    exit();
  }else{
    // require_once 'Connection.php';
    require_once 'csv.php';
    
    // $ano = date("Y");
    
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exportar</title>
    
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
        Exportar
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
              <li class="nav-item w-100 pt-0 mb-0">
                <a href="relatorio.php" class="nav-link link-dark d-flex">
                  <i class="ms-Icon ms-Icon--ReportDocument me-2 fs-6 my-1"></i>
                  <span id="relatorios" class="collapse navbar-collapse">Relatórios</span>
                </a>
              </li>
              <li class="nav-item li-active w-100 pt-0 mb-0">
                <a href="exportar.php" class="nav-link link-dark d-flex active">
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
                      <option value="0">Dados Instituição/Responsável pela visita</option>
                      <option value="1">Dados Agendamento</option>
                      <option value="2">Dados Livro de Visitas</option>
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
                <button class="btn btn-info" type="submit">Gerar arquivo CSV</button>
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
                        
                        if($dataInicial && $dataFinal){
                          
                          $result = tabInstituicao($dataInicial, $dataFinal);
                          $filename = 'dados_instituicao.csv';
                          $arr = ['ID', 'INSTITUICAO', 'NOME', 'TIPO_ORGANIZACAO', 'CEP', 'RUA', 'NUMERO', 'BAIRRO', 'CIDADE', 'UF', 'DT_CAD', 'OCUPACAO', 'EMAIL', 'TELEFONE'];
                          export($result, $filename, $arr);
                          echo '<div class="row">
                          <div class="col-4"><h4>Dados instituição cadastradas entre ' . $dataInicial . ' e ' . $dataFinal . '</h4></div>';
                          echo '<div class="col-8"><a type=button class="btn btn-success" href="'.$filename.'">Download <i class="ms-Icon ms-Icon--Download text-white"></i></a></div>';
                          echo '</div>';
                        }
                        break;
                  case 1:
                        
                        if($dataInicial && $dataFinal){
                          
                          $result = tabAgenda($dataInicial, $dataFinal);
                          $filename = 'dados_agendamento.csv';
                          $arr = ['ID','DATA', 'NUM_VISITANTES', 'STATUS', 'N_ESPECIAL', 'DESCRICAO_NECESSIDADE_ESPECIAL', 'FK_INSTITUICAO_RESPONSAVEL_ID', 'MOTIVO_STATUS', 'HORA'];
                          export($result, $filename, $arr);
                          echo '<div class="row">
                          <div class="col-4"><h4>Dados agendamentos entre ' . $dataInicial . ' e ' . $dataFinal . '</h4></div>';
                          echo '<div class="col-8"><a type=button class="btn btn-success" href="'.$filename.'">Download <i class="ms-Icon ms-Icon--Download text-white"></i></a></div>';
                          echo '</div>';
                        }
                        break;
                  case 2:
                        
                        if($dataInicial && $dataFinal){
                          
                          $result = tabVisitante($dataInicial, $dataFinal);
                          $filename = 'dados_livro_visita.csv';
                          $arr = ['ID','NOME', 'OCUPACAO', 'DT_NASCIMENTO', 'CIDADE', 'UF', 'MENSAGEM', 'DT_CAD'];
                          export($result, $filename, $arr);
                          echo '<div class="row">
                          <div class="col-4"><h4>Dados livro de visitas entre ' . $dataInicial . ' e ' . $dataFinal . '</h4></div>';
                          echo '<div class="col-8"><a type=button class="btn btn-success" href="'.$filename.'">Download <i class="ms-Icon ms-Icon--Download text-white"></i></a></div>';
                          echo '</div>';
                        }
                        break;           
                  
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