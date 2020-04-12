<?php

require_once '../class/Database.php';

//Cria conexão com banco de dados
$conexao = Database::conexao();

//Cria sessão do usuario
session_start();

$consulta = $conexao->query("SELECT * FROM T_MENSALIDADES WHERE MENS_USER = {$_SESSION['user']['USER_CPF']};");

while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    $return[] = $linha;
}

//Desfaz conexão com banco de dados
$conexao = null;

echo json_encode($return);

?>
