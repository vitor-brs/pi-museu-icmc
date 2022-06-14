<?php
/**
 * Cria conexões com bancos de dados
 */
final class Connection
{

    /**
     * Recebe o nome do conector de BD e instancia o objeto PDO
     */
    public static function open($name)
    {
        // verifica se existe arquivo de configuração para este banco de dados
        if (file_exists("./Config/{$name}.ini"))
        {
            // lê o INI e retorna um array
            $db = parse_ini_file("./Config/{$name}.ini");
        }
        else if (file_exists("./Config/{$name}.php"))
        {
            $db = require "./Config/{$name}.php";
        }
        else
        {
            // se não existir, lança um erro
            throw new Exception("Arquivo '$name' não encontrado");
        }
        
        // lê as informações contidas no arquivo
        $user = isset($db['user']) ? $db['user'] : NULL;
        $pass = isset($db['pass']) ? $db['pass'] : NULL;
        $name = isset($db['name']) ? $db['name'] : NULL;
        $host = isset($db['host']) ? $db['host'] : NULL;
        $port = isset($db['port']) ? $db['port'] : NULL;
        

                $port = $port ? $port : '3306';
                $conn = new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);

        // define para que o PDO lance exceções na ocorrência de erros
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
}
?>