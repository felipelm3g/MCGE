<?php

require_once '../class/Database.php';
date_default_timezone_set('America/Fortaleza');

$cpf = $_POST["cpf"];
$pass = $_POST["pass"];

//Encriptar
$pass = base64_encode($pass);

//Cria conexão com banco de dados
$conexao = Database::conexao();

//Cria o comando SQL
$sql = "SELECT * FROM T_USER WHERE USER_CPF = '{$cpf}'";

//Executa o comando SQL
$stmt = $conexao->query($sql);

//Prepara o resultado em um Array[]
$consulta = $stmt->fetch(PDO::FETCH_ASSOC);

//Verifica se a seleção retorna dados
if (empty($consulta)) {

    $return = 1;

    //Valida se a senha está correta    
} elseif ($pass == $consulta['USER_PASS']) {

    //Deleta o campo senha do array e retorna para o sistema
    unset($consulta['USER_PASS']);

    //Cria sessão do usuario
    session_start();
    $_SESSION['user'] = $consulta;

    $return = 0;
} else {

    $return = 2;
}

//Desfaz conexão com banco de dados
$conexao = null;

echo json_encode($return);
?>

