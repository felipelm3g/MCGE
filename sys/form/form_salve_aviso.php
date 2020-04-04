<?php

require_once '../class/Database.php';
date_default_timezone_set('America/Fortaleza');

$titulo = $_POST['titulo'];
$descri = $_POST['descri'];

//Cria conexão com banco de dados
$conexao = Database::conexao();

try {

    $stmt = $conexao->prepare('INSERT INTO T_AVISOS (AVISO_TIT, AVISO_DES) VALUES(:titulo, :descri)');
    $stmt->execute(array(
        ':titulo' => "{$titulo}",
        ':descri' => "{$descri}"
    ));

    $return = $stmt->rowCount();
} catch (PDOException $e) {
    $return = $e->getMessage();
}

//Desfaz conexão com banco de dados
$conexao = null;

echo json_encode($return);
?>
