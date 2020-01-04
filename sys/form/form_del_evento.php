<?php

require_once '../class/Database.php';
date_default_timezone_set('America/Fortaleza');

$id = $_POST['id'];

//Cria conexão com banco de dados
$conexao = Database::conexao();

try {
   
  $stmt = $conexao->prepare('DELETE FROM T_EVENTOS WHERE EVENT_ID = :id');
  $stmt->bindParam(':id', $id); 
  $stmt->execute();
     
  $return = $stmt->rowCount();
  
} catch(PDOException $e) {
  $return = $e->getMessage();
}

//Desfaz conexão com banco de dados
$conexao = null;

echo json_encode($return);
?>
