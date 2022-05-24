<?php
/* configuração de acesso */
include ('config.php');

/* cria numero unico para não haver conflito no DB*/
$sessao = hrtime(true);

/* variaveis passadas pelo post */
$fullname = htmlspecialchars($_POST['fullname']);
$institution = $_POST['institution'];
$tipo_org= $_POST['tipo_org'];
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
$visitantes1 = $_POST['visitantes1'];
$visitantes2 = ""; //$_POST['visitantes2'];
$visitantes3 = ""; //$_POST['visitantes3'];
// necessidade especial
$n_especial = $_POST['n_especial'];

$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

// na falha de conexão o script encerra e apresenta erro
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Grava dados na tabela INSTITUICAO_RESPONSAVEL

$sql="INSERT INTO INSTITUICAO_RESPONSAVEL (NOME, INSTITUICAO, TIPO_ORGANIZACAO, CEP, RUA, NUMERO, BAIRRO,CIDADE, UF, OCUPACAO, EMAIL, TELEFONE, SESSAO) 
VALUES('$fullname','$institution' ,'$tipo_org', '$cep' ,'$rua','$numero','$bairro','$cidade','$uf', '$employment','$email','$phonenumber','$sessao')";


if (mysqli_query($conn, $sql) == NULL) {
    echo "Error: " . $sql . ":-" . mysqli_error($conn);
    mysqli_close($conn);
    exit();
}


 $sqls = "SELECT * FROM INSTITUICAO_RESPONSAVEL WHERE SESSAO = '$sessao'" ;

 if (mysqli_query($conn, $sqls) == NULL) {
    echo "Error: " . $sql . ":-" . mysqli_error($conn);
    mysqli_close($conn);
    exit();
}
$result = mysqli_query($conn, $sqls);
 $linha = mysqli_fetch_assoc($result);
 // Chave estrangeira
 $chave_id = $linha['ID'];

// Grava tabela **** AGENDA *****

$sql="INSERT INTO AGENDA (DATA, NUM_VISITANTES, N_ESPECIAL, FK_INSTITUICAO_RESPONSAVEL_ID)
VALUES('$data1', '$visitantes1', '$n_especial' ,'$chave_id')";

if (mysqli_query($conn, $sql) == NULL) {
    echo "Error: " . $sql . ":-" . mysqli_error($conn);
    mysqli_close($conn);
    exit();
}

// verifica se foi agendada uma segunda data e salva
if ($data2 != NULL){
    $sql="INSERT INTO AGENDA (DATA, NUM_VISITANTES, N_ESPECIAL, FK_INSTITUICAO_RESPONSAVEL_ID)
    VALUES('$data2', '$visitantes2', '$n_especial' ,'$chave_id')";

    if (mysqli_query($conn, $sql) == NULL) {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
        mysqli_close($conn);
        exit();
    }
// verifica se foi agendada uma segunda data e salva
    if ($data3 != NULL) {
        $sql = "INSERT INTO AGENDA (DATA, NUM_VISITANTES, N_ESPECIAL, FK_INSTITUICAO_RESPONSAVEL_ID)
        VALUES('$data3', '$visitantes3', '$n_especial' ,'$chave_id')";

        if (mysqli_query($conn, $sql) == NULL) {
            echo "Error: " . $sql . ":-" . mysqli_error($conn);
            mysqli_close($conn);
            exit();
        }
    }
}





mysqli_close($conn);
?>
