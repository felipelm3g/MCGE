<?php

require_once '../class/Database.php';

$id = $_POST["id"];

//Cria conexão com banco de dados
$conexao = Database::conexao();

//Cria o comando SQL
$consulta = $conexao->query("SELECT * FROM T_MENSALIDADES WHERE MENS_ID = {$id};");

while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    $return[] = $linha;
}

//Desfaz conexão com banco de dados
$conexao = null;

echo json_encode($return);
?>
