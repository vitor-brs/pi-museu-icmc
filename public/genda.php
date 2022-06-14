<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Formulário de Agendamento</title>
    <!-- MDB icon -->
    <link rel="icon" href="assets/img/museu-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link
        rel="stylesheet" href="assets/css/fontawesome-free/css/all.min.css"/>
    <!-- Google Fonts Roboto -->
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />

    <!-- MDB -->
    <link rel="stylesheet" href="assets/css/mdb.min.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
</head>
<body class="d-flex flex-column min-vh-100">

<header class="text-center bg-image p-0"
        style="
      background-image: url('./img/porta.jpg');
      height: 535px;

    ">
    <div id="id-header" class="vh-100 d-flex flex-column p-0" style="background-color: rgba(0, 0, 0, 0.877);">
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
                    <i class="fas fa-bars text-white"></i>
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
                        <li class="nav-item active">
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

        <div class="d-flex justify-content-center align-items-center px-3">
            <div class="text-white justify-content-center align-items-center">
                <h1 class="mb-3">Agendamento de Visita Guiada</h1>
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <hr class="hr-light col-sm-6">

                    <p class="mb-3 col-sm-6" style="text-align: justify;">
                        O Museu de Computação Prof. Odelar Leite Linhares mantém um acervo único, visando documentar e contar a história da computação.
                        No museu é possível verificar as peças que estão em exposição, além, de informações sobre a mesma, fazendo com que o visitante tenha uma noção
                        de como o computador funcionava antigamente.
                        Monitores treinados guiam e interagem com os visitantes esclarecendo suas dúvidas, despertando a curiosidade e o interesse pelo computador.</p>
                    </p>
                </div>
            </div>
        </div>


    </div>
</header>

<?php
/* configuração de acesso */
include ('config.php');

/* cria numero unico para não haver conflito no DB **** Removido não é necessário*/
$sessao = "";

/* variaveis passadas pelo post */
$fullname = htmlspecialchars($_POST['fullname']);
$institution = $_POST['institution'];
$tipo_org= $_POST['tipo_org'];

/* verifica se foi selecionado outros e altera */
if (isset($_POST['outros'])){
    $tipo_org = $_POST['outros'];
    }

$cep = $_POST['cep'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$uf = $_POST['uf'];
$employment = $_POST['employment'];
$email = $_POST['email'];
$phonenumber = $_POST['phonenumber'];
// datas e numero de visitantes (3 datas)
$data1 = $_POST['data1'];
$data2 = ""; // $_POST['data2'];
$data3 = ""; // $_POST['data3'];
$visitantes1 = $_POST['num-visitante1'];
$visitantes2 = ""; //$_POST['visitantes2'];
$visitantes3 = ""; //$_POST['visitantes3'];
$n_especial = "";
$q_especial = "";
$n_especial2 = "";
$q_especial2 = "";
$n_especial3 = "";
$q_especial3 = "";

// necessidade especial
if(isset($_POST['n_especial'])){
    $n_especial = $_POST['n_especial'];
    $q_especial = $_POST['q_especial'];
}

$data = date("Y-m-d");

if(isset($_POST['data2'])){
    $data2 = $_POST['data2'];
    $visitantes2 = $_POST['visitante2'];
    if (isset($_POST['n_especial2'])) {
        $n_especial2 = $_POST['n_especial2'];
        $q_especial2 = $_POST['q_especial2'];
    }
}


if(isset($_POST['data3'])){
    $data3 = $_POST['data3'];
    $visitantes3 = $_POST['visitante3'];
    if (isset($_POST['n_especial3'])) {
        $n_especial3 = $_POST['n_especial3'];
        $q_especial3 = $_POST['q_especial3'];
    }
}

/* começo alteração PDO */

try {

    $pdo = new PDO ("mysql:host=$servidor;dbname=$dbname","$usuario","$senha");
} catch (PDOException $e) {
    echo "Erro de Conexão " . $e->getMessage() . "\n";
    exit;
}

// Grava dados na tabela INSTITUICAO_RESPONSAVEL

$agendamento = array('NOME'=>$fullname,
    'INSTITUICAO'=>$institution,
    'TIPO_ORGANIZACAO'=>$tipo_org,
    'CEP'=>$cep,
    'RUA'=>$rua,
    'NUMERO'=>$numero,
    'BAIRRO'=>$bairro,
    'CIDADE'=>$cidade,
    'UF'=>$uf,
    'OCUPACAO'=>$employment,
    'EMAIL'=>$email,
    'TELEFONE'=>$phonenumber,
    'DT_CAD'=>$data);

$pdo->prepare('INSERT INTO INSTITUICAO_RESPONSAVEL (NOME, INSTITUICAO, TIPO_ORGANIZACAO, CEP, RUA, NUMERO, BAIRRO,CIDADE, UF, OCUPACAO, EMAIL, TELEFONE, DT_CAD)
    VALUES (:NOME, :INSTITUICAO, :TIPO_ORGANIZACAO, :CEP, :RUA, :NUMERO, :BAIRRO,:CIDADE, :UF, :OCUPACAO, :EMAIL, :TELEFONE, :DT_CAD)')
    ->execute($agendamento);

// Chave estrangeira
$chave_id = $pdo->lastInsertId();

// Grava tabela **** AGENDA *****
$agenda = array('DATA'=>$data1,
    'NUM_VISITANTES'=>$visitantes1,
    'N_ESPECIAL'=>$n_especial,
    'FK_INSTITUICAO_RESPONSAVEL_ID'=>$chave_id,
    'STATUS'=>"Agendado",
    'DESCRICAO_NECESSIDADE_ESPECIAL'=>$q_especial,
    'HORA'=>"00:00:00");

$pdo->prepare('INSERT INTO AGENDA (DATA, NUM_VISITANTES, N_ESPECIAL, FK_INSTITUICAO_RESPONSAVEL_ID, STATUS, DESCRICAO_NECESSIDADE_ESPECIAL, HORA)
    VALUES (:DATA, :NUM_VISITANTES, :N_ESPECIAL, :FK_INSTITUICAO_RESPONSAVEL_ID, :STATUS, :DESCRICAO_NECESSIDADE_ESPECIAL, :HORA)')
    ->execute($agenda);
unset($agenda);

// verifica se foi agendada uma segunda data e salva
if ($data2 != NULL) {
    $agenda2 = array('DATA' => $data2,
        'NUM_VISITANTES' => $visitantes2,
        'N_ESPECIAL' => $n_especial2,
        'FK_INSTITUICAO_RESPONSAVEL_ID' => $chave_id,
        'STATUS' => "Agendado",
        'DESCRICAO_NECESSIDADE_ESPECIAL' => $q_especial2,
        'HORA'=>"00:00:00");

    $pdo->prepare('INSERT INTO AGENDA (DATA, NUM_VISITANTES, N_ESPECIAL, FK_INSTITUICAO_RESPONSAVEL_ID, STATUS, DESCRICAO_NECESSIDADE_ESPECIAL, HORA)
    VALUES (:DATA, :NUM_VISITANTES, :N_ESPECIAL, :FK_INSTITUICAO_RESPONSAVEL_ID, :STATUS, :DESCRICAO_NECESSIDADE_ESPECIAL, :HORA)')
        ->execute($agenda2);
    unset($agenda2);

// verifica se foi agendada uma terceira data e salva
    if ($data3 != NULL) {
        $agenda3 = array('DATA' => $data3,
            'NUM_VISITANTES' => $visitantes3,
            'N_ESPECIAL' => $n_especial3,
            'FK_INSTITUICAO_RESPONSAVEL_ID' => $chave_id,
            'STATUS' => "Agendado",
            'DESCRICAO_NECESSIDADE_ESPECIAL' => $q_especial3,
            'HORA'=>"00:00:00");

        $pdo->prepare('INSERT INTO AGENDA (DATA, NUM_VISITANTES, N_ESPECIAL, FK_INSTITUICAO_RESPONSAVEL_ID, STATUS, DESCRICAO_NECESSIDADE_ESPECIAL, HORA)
    VALUES (:DATA, :NUM_VISITANTES, :N_ESPECIAL, :FK_INSTITUICAO_RESPONSAVEL_ID, :STATUS, :DESCRICAO_NECESSIDADE_ESPECIAL, :HORA)')
            ->execute($agenda3);
        unset($agenda3);
    }
}

unset($agendamento);
unset($pdo);
?>

<!-- main -->
<main class="d-flex flex-column justify-content-center align-items-center fonts-custom-2">
    <div>
        <h1 class="fonts-custom">Sucesso</h1>
    </div>
    <div class="p-3 mb-3">

        <!-- Dados visitante -->
        <section class="mb-3">
            <h5 class="fonts-custom fs-4">Prezado(a): <?php echo $fullname ?></h1>
                <p>Ficamos grato por seu agendamento! Um representante do museu entrará em contato com você para confirmar sua visita. <br>
                    Por favor, use os links acima para continuar navegando em nosso site.</p>
        </section>
    </div>
</main>

<!-- main -->

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


<!-- MDB -->
<script type="text/javascript" src="assets/js/mdb.min.js"></script>
<!-- Custom scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/script.js"></script>
<script src="assets/js/popper.js"></script>


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
