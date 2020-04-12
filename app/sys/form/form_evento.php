<?php

require_once '../class/Database.php';
date_default_timezone_set('America/Fortaleza');

$data = $_POST["data"];

//Cria conexão com banco de dados
$conexao = Database::conexao();

$consulta = $conexao->query("SELECT * FROM T_EVENTOS WHERE EVENT_DATA = '{$data}'");

$return = [];

while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    $return[] = $linha;
}

//Desfaz conexão com banco de dados
$conexao = null;

echo json_encode($return);
?>

