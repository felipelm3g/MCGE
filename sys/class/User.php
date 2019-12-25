<?php

require_once 'Database.php';
date_default_timezone_set('America/Recife');

class User {
    
    private $cpf;
    private $nome;
    private $pass;
    private $stt;
    
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
        
}
