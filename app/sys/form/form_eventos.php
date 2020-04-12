<?php

require_once '../class/Database.php';
date_default_timezone_set('America/Fortaleza');

//Cria conexão com banco de dados
$conexao = Database::conexao();

$consulta = $conexao->query("SELECT * FROM T_EVENTOS");

$return = [];

while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    if (in_array($linha['EVENT_DATA'], $return)) {
        //Fazer nada
    } else {
        $return[] = $linha['EVENT_DATA'];
    }
}

//Desfaz conexão com banco de dados
$conexao = null;

echo json_encode($return);
?>

