<?php 

    require_once 'livro.php';

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livro de Visitas</title>

    <link rel="icon" href="assets/img/museu-favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="assets/css/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/fabric-icons-inline.css">
    <link rel="stylesheet" href="assets/css/mdb.min.css">
    <link rel="stylesheet" href="assets/css/livro-visita/styles.css">
</head>
<body>
<div class="body-background-image d-flex flex-column min-vh-100">
    <div class="body-background min-vh-100 d-flex flex-column p-0">

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg container-fluid">
          <div class="ms-auto">
            
            <button
              class="navbar-toggler"
              type="button"
              data-mdb-toggle="collapse"
              data-mdb-target="#navbarMenu"
              aria-controls="navbarMenu"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <i class="bi bi-list text-white"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarMenu">
              <div class="position-absolute top-0 start-0 p-3 p-t-3 text-white">
                <p class="fs-5">
                  <img src="assets/img/logo_museu.png" alt="Logo do museu de computação" width="80">
                  Site Museu ICMC
                </p> 
              </div>
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="https://mc.icmc.usp.br/">Museu</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://mc.icmc.usp.br/sobre-o-museu">Sobre o Museu</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://mc.icmc.usp.br/exposições-virtuais">Exposições Virtuais</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://mc.icmc.usp.br/exposições-locais">Exposições Locais</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://mc.icmc.usp.br/doações">Doações</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="index.html">Visita Guiada</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://mc.icmc.usp.br/museu-na-mídia">Museu na mídia</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- Navbar -->
  
        <div class="position-absolute start-0 py-5">
          <p class="py-3 px-2 text-white" id="alunos-top">
            Desenvolvido pelos alunos da <br> <a href="https://www.univesp.br"> <img src="assets/img/Univesp_logo_png_rgb.png" alt="Logo marca da universidade virtual do estado de são paulo" width="200px"></a> <br>
            BRUNA DOS SANTOS SAMPAIO <br>
            DOUGLAS TOFFOLETTO <br>
            FERNANDA MARIA DIAS DE GOZ <br>
            MARCELO LAZARO DE OLIVEIRA <br>
            PAULO SOUZA DANEU <br>
            VITOR B. R. SILVA <br>
            VIVIANE BEZERRA CAMPOS
          </p>
        </div>

      <div class="top-content">
          <div class="container">
              <div class="row">
                  <div class="col-sm-7 text fonts">
                      <h1 class="text mb-3">Livro de Visitas</h1>
                      <div>
                          <p class="">
                              Conte-nos como foi sua visita ao museu, sua opinião é muito importante para nós. 
                          </p>
                      </div>
                  </div>
                  <div class="col-sm-5 form-box mb-3">
                      <div class="form-top">
                          <div class="form-top-left">
                              <h3 class="">Registre sua visita</h3>
                              <p class="">Leva apenas um minuto.</p>
                          </div>
                          <div class="form-top-right">
                              <i class="bi bi-pencil form-top-right"></i>
                          </div>
                      </div>
                      <div class="form-bottom mb-3">
                          <form role="form" method="post">
                              <div class="form-group">
                                  <label for="fullname" class=""></label>
                                  <input type="text" id="fullname" placeholder="Nome completo" class="form-control" name="nome">
                              </div>
                              <div class="form-group mb-3">
                                    <label for="profession" class=""></label>
                                    <input type="text" id="profession" placeholder="Ocupação" class="form-control" name="ocupacao">
                              </div>
                              <div class="form-group">
                                      <label for="age" class="">Data de nascimento</label>
                                      <input type="date" id="age" placeholder="" class="form-control" name="data-nascimento">
                              </div>                              
                              <div class="form-group row">
                                  <div class="col-9">
                                      <label for="cidade" class=""></label>
                                      <input type="text" id="cidade" placeholder="Cidade" class="form-control" name="cidade">
                                  </div>
                                  <div class="col-3">
                                      <label for="uf" class=""></label>
                                      <input type="text" id="uf" placeholder="UF" class="form-control" name="uf">
                                  </div>
                              </div>
                              <div class="form-group mb-3">
                                  <label for="comment" class=""></label>
                                  <textarea type="text" id="comment" placeholder="Críticas, sugestões ou reclamações..." class="form-control" name="comentarios"></textarea>
                              </div>
                              <button type="submit" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#Modal">Enviar</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
</div>

<!-- Modal -->
<div id="Modal" class="modal fade" tabindex="-1" role="Caixa de dialogo com mensagem de envio com sucesso">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Sucesso</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" data-mdb-toggle="modal"></button>
      </div>
      <div class="modal-body">
        <p>Visita registrada. Obrigado!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-mdb-toggle="modal" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->

<!-- Footer -->
<footer class="bg-dark text-center text-white mt-auto">
  <!-- Grid container -->
  <div class="container p-4">
              <!-- Section: Social media -->
              <section class="mb-4">
                <!-- Facebook -->
                <a class="btn btn-outline-light btn-floating m-1" href="https://www.facebook.com/icmc.usp" role="button"
                  ><i class="fab fa-facebook-f"></i
                ></a>

                <!-- Twitter -->
                <a class="btn btn-outline-light btn-floating m-1" href="https://twitter.com/icmc_usp" role="button"
                  ><i class="fab fa-twitter"></i
                ></a>

                <!-- Google -->
                <a class="btn btn-outline-light btn-floating m-1" href="https://www.youtube.com/c/ICMCTV/featured" role="button"
                  ><i class="fab fa-youtube"></i
                ></a>

                <!-- Instagram -->
                <a class="btn btn-outline-light btn-floating m-1" href="https://www.instagram.com/icmc.usp" role="button"
                  ><i class="fab fa-instagram"></i
                ></a>

              </section>
              <!-- Section: Social media -->
      
      <!-- Grid row -->
      <div class="row text-md-start">
              <!-- Section: Text -->
              <section class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <div class="row">
                    <p>
                      <div class="mb-3">ENDEREÇO</div>
                      <div class="mb-3">Museu de Computação Prof. Odelar Leite Linhares <br> Instituto de Ciências e Matemáticas e de Computação - ICMC <br> Universidade de São Paulo - USP
                        <br>
                        Avenida Trabalhador São-Carlense, nº 400, Centro. <br> CEP 13566-590 - São Carlos - SP
                      </div>                      
                      <div class="mb-3">HORÁRIO DE FUNCIONAMENTO</div>
                      <div class="mb-3">Segunda à Sexta-feira <br> das 8h00 às 18h00</div>
                      <div class="mb-3">CONTATO</div>
                      <div>Telefone: (16) 3373-9146 <br> E-mail: museu@icmc.usp.br</div>
                    </p>
                    <p>
                      Desenvolvido pelos alunos da <a href="https://www.univesp.br"> <img src="assets/img/Univesp_logo_png_rgb.png" alt="Logo marca da universidade virtual do estado de são paulo" width="200px"></a> <br>
                      BRUNA DOS SANTOS SAMPAIO <br>
                      DOUGLAS TOFFOLETTO <br>
                      FERNANDA MARIA DIAS DE GOZ <br>
                      MARCELO LAZARO DE OLIVEIRA <br>
                      PAULO SOUZA DANEU <br>
                      VITOR B. R. SILVA <br>
                      VIVIANE BEZERRA CAMPOS
                    </p>
                </div>
              </section>
              <!-- Section: Text -->

              

              <!-- Section: Links -->
              <section class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <!--Grid row-->
                <div class="row">
                  <!--Grid column-->
                  <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Museu</h5>

                    <ul class="list-unstyled mb-0">
                      <li>
                        <a href="https://mc.icmc.usp.br/museu/o-fundador" class="text-white">O Fundador</a>
                      </li>
                      <li>
                        <a href="https://mc.icmc.usp.br/museu/história-do-museu" class="text-white">História do Museu</a>
                      </li>
                      <li>
                        <a href="https://mc.icmc.usp.br/sobre-o-museu" class="text-white">Sobre o Museu</a>
                      </li>
                      <li>
                        <a href="https://mc.icmc.usp.br/exposições-virtuais" class="text-white">Exposições Virtuais</a>
                      </li>
                      <li>
                        <a href="https://mc.icmc.usp.br/exposições-locais" class="text-white">Exposições Locais</a>
                      </li>
                      <li>
                        <a href="https://mc.icmc.usp.br/museu-na-mídia" class="text-white">Museu na mídia</a>
                      </li>
                    </ul>
                  </div>
                  <!--Grid column-->

                  <!--Grid column-->
                  <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Links</h5>

                    <ul class="list-unstyled mb-0">
                      <li>
                        <a href="https://mc.icmc.usp.br/doações" class="text-white">Doações</a>
                      </li>
                      <li>
                        <a href="index.html" class="text-white">Agendamento de Visita Guiada</a>
                      </li>
                      <li>
                        <a href="livroDeVisitas.php" class="text-white">Livro de Visitas</a>
                      </li>
                    </ul>
                  </div>
                  <!--Grid column-->
                  <!--Grid column-->
                  <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Links</h5>

                    <ul class="list-unstyled mb-0">
                      <li>
                        <a href="login.php" class="text-white">Acesso Museu</a>
                      </li>
                    </ul>
                  </div>
                  <!--Grid column-->
                  
                </div>
                <!--Grid row-->
              </section>
              <!-- Section: Links -->
      </div>
      <!-- Grid row -->
 </div>
 <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2022 Copyright:
    <a class="text-white" href="https://mc.icmc.usp.br/">mc.icmc.usp.br</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->


<script type="text/javascript" src="assets/js/mdb.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/popper.js"></script>
<script type="text/javascript" src="assets/js/livro-visita/scripts.js"></script>
<!-- Libras -->
<div vw class="enabled">
  <div vw-access-button class="active"></div>
  <div vw-plugin-wrapper>
    <div class="vw-plugin-top-wrapper"></div>
  </div>
</div>
<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script>
  new window.VLibras.Widget('https://vlibras.gov.br/app');
</script>
<!-- Libras -->
</body>
</html>