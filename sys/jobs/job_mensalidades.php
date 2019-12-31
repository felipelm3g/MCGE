<?php

require_once '../class/User.php';
require_once '../class/Database.php';

//Cria conexão com banco de dados
$conexao = Database::conexao();

$consulta = $conexao->query("SELECT * FROM T_USER;");

while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {

    $user = new User($linha['USER_CPF']);
    echo $user->gerarFatura('25');
    echo "<br>";
    $user = "";
}

//Desfaz conexão com banco de dados
$conexao = null;



