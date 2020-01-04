<?php

require_once '../class/Database.php';
date_default_timezone_set('America/Fortaleza');

$id = $_POST['id'];
$titulo = $_POST['titulo'];
$descri = $_POST['descri'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$data = $_POST['data'];

//Cria conexão com banco de dados
$conexao = Database::conexao();

try {

    if ($id == "C") {
        $stmt = $conexao->prepare('INSERT INTO T_EVENTOS (EVENT_TTLO, EVENT_DESC, EVENT_LAT, EVENT_LNG, EVENT_DATA) VALUES(:titulo, :descri, :latitude, :longitude, :data)');
        $stmt->execute(array(
            ':titulo' => $titulo,
            ':descri' => $descri,
            ':latitude' => $latitude,
            ':longitude' => $longitude,
            ':data' => $data
        ));
    } else {
        $stmt = $conexao->prepare('UPDATE T_EVENTOS SET EVENT_TTLO = :titulo, EVENT_DESC = :descri, EVENT_LAT = :latitude, EVENT_LNG = :longitude, EVENT_DATA = :data WHERE EVENT_ID = :id');
        $stmt->execute(array(
            ':id' => $id,
            ':titulo' => $titulo,
            ':descri' => $descri,
            ':latitude' => $latitude,
            ':longitude' => $longitude,
            ':data' => $data
        ));
    }

    $return = $stmt->rowCount();
    
} catch (PDOException $e) {
    $return = $e->getMessage();
}

//Desfaz conexão com banco de dados
$conexao = null;

echo json_encode($return);
?>
