<?php

/* * ************************************************************************ */
/* Autor: Felipe Lopes              Desenvolvido: 14.01.2019   Versão: 0.0.1  */
/* * ************************************************************************ */
/* Modificado: Nome do modificador          Data: dd.mm.aaaa   Versão: 0.0.2  */
/* * ************************************************************************ */

class Database {
    # Variável que guarda a conexão PDO.

    protected static $db;

    # Private construct - garante que a classe só possa ser instanciada internamente.

    private function __construct() {
        # Informações sobre o banco de dados:
        $db_host = "sql122.main-hosting.eu";
        $db_nome = "u827415794_mcgde";
        $db_usuario = "u827415794_admin";
        $db_senha = "lQMZ;PeLm>";
//        $db_host = "localhost";
//        $db_nome = "db_combuston";
//        $db_usuario = "ac_system";
//        $db_senha = "12345@Flm";
        $db_driver = "mysql";
        # Informações sobre o sistema:
        $sistema_titulo = "MC Gaviões da Estrada";
        $sistema_email = "contato@mcgavioesdaestrada.com";

        try {
            # Atribui o objeto PDO à variável $db.
            self::$db = new PDO("$db_driver:host=$db_host; dbname=$db_nome", $db_usuario, $db_senha, array(PDO::MYSQL_ATTR_FOUND_ROWS => true));
            # Garante que o PDO lance exceções durante erros.
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            # Garante que os dados sejam armazenados com codificação UFT-8.
            self::$db->exec('SET NAMES utf8');
        } catch (PDOException $e) {
            # Envia um e-mail para o e-mail oficial do sistema, em caso de erro de conexão.
            #mail($sistema_email, "PDOException em $sistema_titulo", $e->getMessage());
            # Então não carrega nada mais da página.
            die("Connection Error: " . $e->getMessage());
        }
    }

    # Método estático - acessível sem instanciação.

    public static function conexao() {
        # Garante uma única instância. Se não existe uma conexão, criamos uma nova.
        if (!self::$db) {
            new Database();
        }
        # Retorna a conexão.
        return self::$db;
    }

}

?>