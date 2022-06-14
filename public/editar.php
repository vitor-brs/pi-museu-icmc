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
    // $id = "";
    if(isset($_POST['btnEditar'])){
      $id = $_POST['btnEditar'];
    }
    if(isset($_SESSION['id'])){
      $id = $_SESSION['id'];
    }
    

    
    $sql = "SELECT * FROM INSTITUICAO_RESPONSAVEL WHERE ID = '$id'";
    $row = $c->open('museu');
    $dados = $row->query($sql);
    $result = $dados->fetch(PDO::FETCH_ASSOC);
    $r = $result;
    $row=null;

    $sqlAgenda = "SELECT * FROM AGENDA WHERE FK_INSTITUICAO_RESPONSAVEL_ID = $id";
    $ro = $c->open('museu');
    $dados2 = $ro->query($sqlAgenda);
    $resultAgenda = $dados2->fetchAll(PDO::FETCH_ASSOC);
    $ro=null;
  }
 
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    
    <link rel="icon" href="assets/img/museu-favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="assets/css/mdb.min.css" />
    <link rel="stylesheet" href="assets/css/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/fabric-icons-inline.css">

    <link rel="stylesheet" href="assets/css/editar/main.css" />
    <link rel="stylesheet" href="assets/css/editar/styles.css" />

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
        Agenda |
      </a>
      <span class="text-white">
        Editar
      </span>
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
              <!-- Sumário -->
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
                      >Dados Agendamento</a
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
                      <div class="card mb-3 mx-4">
                        <div class="card-header position-relative bg-white" style="border-radius: 0px; height: 80px;">
                          <div class="position-absolute top-50 start-50 translate-middle">
                            <!-- <i class="ms-Icon ms-Icon--Contact fs-2 rounded-pill bg-white" style="width: 45px; height: 45px;"></i> -->
                          </div>
                          <div class="text-start "><h5><i class="ms-Icon ms-Icon--Info fs-2 rounded-pill"></i> Detalhes do agendamento</h5></div>
                        </div>
                        <div class="card-body">
                      
                          <div class="card-group mb-3">
                            <div class="card mb-3 mx-4" style="min-width: 28rem;">
                              <div class="card-header position-relative" style="border-radius: 0px; height: 80px;">
                                <div class="text-center position-absolute top-50 start-50 translate-middle">
                                  <i class="ms-Icon ms-Icon--Contact fs-2 rounded-pill bg-white" style="width: 45px; height: 45px;"></i>
                                  <div class="text-white">Dados Responsável pela visita</div>
                                </div>
                              </div>
                              <div class="card-body">
                                
                                <form action="atualizar.php" method="POST">
                                <input name="id_instituicao" type="hidden" value="<?php echo $result['ID'];?>">  
                                <h5 class="card-title"></h5>                              
                                  <div class="row">
                                    <div class="row">
                                      <span class="my-1 col">Nome</span>
                                      <input class="input-border my-1 col" type="text" placeholder="" value="<?php echo $result['NOME'];?>" name="nome">
                                    </div>
                                    <div class="row">
                                      <span class="my-1 col">Ocupação</span>
                                      <input class="input-border my-1 col" type="text" placeholder="" value="<?php echo $result['OCUPACAO'];?>" name="ocupacao">
                                    </div>
                                    <div class="row">
                                      <span class="my-1 col">E-mail</span>
                                      <input class="input-border my-1 col" type="text" placeholder="" value="<?php echo $result['EMAIL'];?>" name="email">
                                    </div>
                                    <div class="row">
                                      <span class="my-1 col">Telefone</span>
                                      <input class="input-border my-1 col" type="text" placeholder="" value="<?php echo $result['TELEFONE'];?>" name="telefone">
                                    </div>
                               
                                  </div>

                                  <div class="my-3">
                                    <button class="btn btn-primary" type="submit">Atualizar</button>
                                  </div>
                                </form>
                              </div>
                            </div>
          
                            <div class="card mb-3 mx-4" style="min-width: 25rem;">
                              <div class="card-header bg-info position-relative" style="border-radius: 0px; height: 80px;">
                                <div class="text-center position-absolute top-50 start-50 translate-middle">
                                  <i class="ms-Icon ms-Icon--ContactInfo fs-2 rounded-pill bg-white" style="width: 45px; height: 45px;"></i>
                                  <div class="text-white">Dados Instituição</div>
                                </div>
                              </div>
                                <div class="card-body">
                                  <form action="atualizar.php" method="POST">
                                    <h5 class="card-title"></h5>
                                    <input name="id_instituicao2" type="hidden" value="<?php echo $r['ID'];?>">
                                    <div class="row">
                                      <div class="row">
                                        <span class="my-1 col">Instituição</span>
                                        <input class="input-border my-1 col" type="text" placeholder="" value=" <?php echo $r['INSTITUICAO']; ?> " name="instituicao">
                                      </div>
                                      <div class="row">
                                        <span class="my-1 col">Tipo Organização</span>
                                        <select class="form-select col select-border" required aria-label="Selecione o tipo de organização" id="group-select" name="organizacao" aria-required="true">
                                          <option selected value="<?php echo $r['TIPO_ORGANIZACAO']; ?>"><?php echo $r['TIPO_ORGANIZACAO']; ?></option>
                                          <option value="Escola pública de ensino fundamental">Escola pública de ensino fundamental</option>
                                          <option value="Escola pública de ensino médio">Escola pública de ensino médio</option>
                                          <option value="Escola pública de ensino fundamental e médio">Escola pública de ensino fundamental e médio</option>
                                          <option value="Escola privada de ensino fundamental">Escola privada de ensino fundamental</option>
                                          <option value="Escola privada de ensino médio">Escola privada de ensino médio</option>
                                          <option value="Escola privada de ensino fundamental e médio">Escola privada de ensino fundamental e médio</option>
                                          <option value="Instituição pública de ensino superior">Instituição pública de ensino superior</option>
                                          <option value="Instituição privada de ensino superior">Instituição privada de ensino superior</option>
                                          <option value="Educação especial">Educação especial</option>
                                          <option value="Empresa pública">Empresa pública</option>
                                          <option value="Empresa privada">Empresa privada</option>
                                          <option value="ONG - Organização não governamental">ONG - Organização não governamental</option>
                                          <option value="Outros">Outros</option>
                                        </select>                                      
                                      </div>
                                      <div class="row">
                                        <span class="my-1 col">CEP</span>
                                        <input class="input-border my-1 col" type="text" placeholder="" value="<?php echo $r['CEP']; ?>" name="cep">
                                      </div>
                                      <div class="row">
                                        <span class="my-1 col">Endereço</span>
                                        <input class="input-border my-1 col" type="text" placeholder="" value="<?php echo $r['RUA']; ?>" name="rua">
                                      </div>
                                      <div class="row">
                                        <span class="my-1 col">Número</span>
                                        <input class="input-border my-1 col" type="text" placeholder="" value="<?php echo $r['NUMERO']; ?>" name="numero">
                                      </div>
                                      <div class="row">
                                        <span class="my-1 col">Bairro</span>
                                        <input class="input-border my-1 col" type="text" placeholder="" value="<?php echo $r['BAIRRO']; ?>" name="bairro">
                                      </div>
                                      <div class="row">
                                        <span class="my-1 col">Cidade</span>
                                        <input class="input-border my-1 col" type="text" placeholder="" value="<?php echo $r['CIDADE']; ?>" name="cidade">
                                      </div>
                                      <div class="row">
                                        <span class="my-1 col">UF</span>
                                        <input class="input-border my-1 col" type="text" placeholder="" value="<?php echo $r['UF']; ?>" name="uf">
                                      </div>
                                      
                                      </div>
                                      <div class="my-5">
                                        <button class="btn btn-primary" type="submit">Atualizar</button>
                                      </div>
                                  </form>
                                </div>
                            </div>
                        </div>

                        </div>
                      </div>
                  
                  </div>
                <!-- Sumário end-->
                  <div
                    class="tab-pane fade"
                    id="ex2-tabs-2"
                    role="tabpanel"
                    aria-labelledby="ex2-tab-2"
                  >
                  <div class="card mb-3 mx-4">
                      <div class="card-body">
                        <h5 class="card-title"><i class="ms-Icon ms-Icon--EventDate rounded-pill bg-white"></i> Visualização do Agendamento</h5>
                      
                          <table class="table table-responsive-sm align-middle mb-0 bg-white">
                            <thead class="bg-light">
                              <tr>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>N. Visitantes</th>
                                <th>Status</th>
                                <th>N. Especial</th>
                                <th>Ação</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php 

                              if ($resultAgenda) {
                                $contador = 1;
                                foreach ($resultAgenda as $rows) { 
                                  
                                  $status = $rows['STATUS'];
                                  echo '
                                  <tr>
                                <form action="atualizar.php" name="form_editar_agenda" method="POST">
                                <input name="id_agenda'.$contador.'" type="hidden" value="'. $rows['ID'].'">
                                  <td>
                                    <input class="input-border mb-2" type="date" placeholder="" value="'.$rows['DATA'].'" name="data'.$contador.'">
                                  </td>
                                  <td>
                                    <input class="input-border mb-2" type="time" placeholder="" value="'.$rows['HORA'].'" name="hora'.$contador.'">
                                  </td>
                                  <td>
                                    <input class="input-border" type="number" placeholder="0" value="'.$rows['NUM_VISITANTES'].'" name="num_visitantes'.$contador.'">
                                  </td>
                                  <td>
                                  <select class="form-select select-border" name="group-select-status'.$contador.'">
                                  <option selected value="'.$rows['STATUS'].'">'.$rows['STATUS'].'</option>
                                  <option value="Agendado">Agendado</option>
                                  <option value="Confirmado">Confirmado</option>
                                  <option value="Concluído">Concluído</option>
                                  <option value="Faltou">Faltou</option>
                                  <option value="Cancelado">Cancelado</option>
                                  </select>
                                  </td>
                                  <td>
                                    <textarea class="textarea-border" name="textareaNecessidadeEspecial'.$contador.'" id="textareaNecessidadeEspecial1" cols="25" rows="2">'.$rows['DESCRICAO_NECESSIDADE_ESPECIAL'].'</textarea>
                                      
                                  </td>
                                  <td>
                                    <button type="submit" class="btn btn-link btn-sm btn-rounded fw-bold" data-mdb-toggle="modal" data-mdb-target="#successModal">
                                      Atualizar
                                    </button>
                                  </td>
                                  
                                </form>
                              </tr>';
                              $contador++;
                                }
                              }
                              ?>
                            </tbody>
                          </table>
                          <!--  -->
                         
                          
                          
                          
                        </div>
                      </div>
                     
                    <!-- tab 2 -->
                  </div> 

                </div>
                <!-- Tabs content -->
                  <!-- FDSFDKSAKFSDKFADKSFKSD -->
              
              
            

      
     
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
            <button type="button" class="btn btn-primary">Sim</button>
          </div>
        </div>
      </div>
    </div>

        <!-- Modal -->

        <!-- Modal -->
        <div class="modal top fade" id="successModal" tabindex="-1" aria-labelledby="successeModalLabel" aria-hidden="true" data-mdb-backdrop="true" data-mdb-keyboard="true">
          <div class="modal-dialog modal-md  modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="successeModalLabel">Atualizar registro</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body text-center"><i class="fa-solid fa-circle-check text-success fs-3"></i> Registro atualizado com sucesso!</div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success" data-mdb-dismiss="modal">
                  OK
                </button>
              </div>
            </div>
          </div>
        </div>

    <script type="text/javascript" src="assets/js/mdb.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/popper.js"></script>
    <script type="text/javascript" src="assets/js/editar/scripts.js"></script>
    <script type="text/javascript" src="assets/js/chartjs/dist/chart.min.js"></script>
    <script type="text/javascript" src="assets/js/editar/main.js"></script>
    <script type="text/javascript" src="assets/js/editar/btnStatus.js"></script>
    <script type="text/javascript" src="assets/js/editar/checkNecessidadeEspecial.js"></script>
</body>
</html>