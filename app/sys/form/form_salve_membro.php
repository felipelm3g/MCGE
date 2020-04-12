<?php

require_once '../class/Database.php';
require_once '../class/User.php';
date_default_timezone_set('America/Fortaleza');

$cpf = $_POST['cpf'];
$name = $_POST['nome'];
$pass = $_POST['pass'];

//Cria conexão com banco de dados
$conexao = Database::conexao();

try {

    $consulta = $conexao->query("SELECT * FROM T_USER WHERE USER_CPF =" . $cpf . " ;");
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        //Desfaz conexão com banco de dados
        $conexao = null;
        $return = 1;
        echo json_encode($return);
        exit();
    }
    
    $user = new User($cpf);
    if ($user->registrar($name, $pass)) {
        $return = 0;
    } else {
        $return = 2;
    }
    
} catch (PDOException $e) {
    $return = 2;
}

//Desfaz conexão com banco de dados
$conexao = null;

echo json_encode($return);
?>
