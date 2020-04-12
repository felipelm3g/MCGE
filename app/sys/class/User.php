<?php

require_once 'Database.php';
date_default_timezone_set('America/Fortaleza');

class User {

    private $cpf;
    private $nome;
    private $pass;
    private $stt;

    function __construct($cpf) {
        $this->cpf = $cpf;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getPass() {
        return $this->pass;
    }

    public function getStt() {
        return $this->stt;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setPass($pass) {
        $this->pass = $pass;
    }

    public function setStt($stt) {
        $this->stt = $stt;
    }

    private function getMes() {
        return date("m");
    }
    
    private function getVencimento() {
        return date("Y-m-d");
    }
    
    public function registrar($name, $pass){
        //Encriptar
        $this->setNome($name);
        $this->setPass(base64_encode($pass));
        
        //Cria conexão com banco de dados
        $conexao = Database::conexao();
        
        try {
            $stmt = $conexao->prepare("INSERT INTO T_USER (USER_CPF, USER_NOME, USER_PASS) VALUES(:cpf, :name, :pass)");
            $stmt->execute(array(
                ':cpf' => $this->getCpf(),
                ':name' => $this->getNome(),
                ':pass' => $this->getPass()
            ));
            
            //Desfaz conexão com banco de dados
            $conexao = null;
            return true;
        } catch (Exception $exc) {
            //Desfaz conexão com banco de dados
            $conexao = null;
            return false;
        }
    }

    public function gerarFatura($vlr) {

        //Cria conexão com banco de dados
        $conexao = Database::conexao();

        //Cria o comando SQL
        $sql = "SELECT * FROM T_MENSALIDADES WHERE MENS_USER = '{$this->getCpf()}' AND MONTH(MENS_DATA) = '{$this->getMes()}';";
        
        //Executa o comando SQL
        $stmt = $conexao->query($sql);

        //Prepara o resultado em um Array[]
        $consulta = $stmt->fetch(PDO::FETCH_ASSOC);

        //Verifica se a seleção retorna dados
        if (empty($consulta)) {
            
            $stmt = $conexao->prepare("INSERT INTO T_MENSALIDADES (MENS_USER, MENS_DATA, MENS_VLR) VALUES(:user, :data, :valr)");
            $stmt->execute(array(
                ':user' => $this->getCpf(),
                ':data' => $this->getVencimento(),
                ':valr' => $vlr
            ));
            
            return true;
        } else {

            //Desfaz conexão com banco de dados
            $conexao = null;
            return false;
        }
    }

}
