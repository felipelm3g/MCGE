<?php

require_once '../class/Database.php';
date_default_timezone_set('America/Fortaleza');

$id = $_POST['id'];
$act = $_POST['act'];

//Cria conexão com banco de dados
$conexao = Database::conexao();

session_start();

$vlr = 0;

switch ($act) {
    case "P":
        $consulta = $conexao->query("SELECT * FROM T_USER  WHERE USER_CPF = '{$id}'");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $vlr = intval($linha['USER_TYP']) + 1;
        }
        if ($_SESSION['user']['USER_CPF'] == $id) {
            $_SESSION['user']['USER_TYP'] = $vlr;
        }
        $stmt = $conexao->prepare("UPDATE T_USER SET USER_TYP = {$vlr} WHERE USER_CPF = :id");
        break;
    case "R":
        $consulta = $conexao->query("SELECT * FROM T_USER  WHERE USER_CPF = '{$id}'");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $vlr = intval($linha['USER_TYP']) - 1;
        }
        if ($_SESSION['user']['USER_CPF'] == $id) {
            $_SESSION['user']['USER_TYP'] = $vlr;
        }
        $stmt = $conexao->prepare("UPDATE T_USER SET USER_TYP = {$vlr} WHERE USER_CPF = :id");
        break;
    case "B":
        $stmt = $conexao->prepare('UPDATE T_USER SET USER_STT = 1 WHERE USER_CPF = :id');
        break;
    case "D":
        $stmt = $conexao->prepare('UPDATE T_USER SET USER_STT = 0 WHERE USER_CPF = :id');
        break;
    case "RP":
        $str = intval($id);
        $carac = strlen($str);
        $dif = 11 - intval($carac);
        for ($i = 1; $i <= $dif; $i++) {
            $str = "0" . $str;
        }
        $pass = $str;
        $pass = base64_encode($pass);
        $stmt = $conexao->prepare("UPDATE T_USER SET USER_PASS = '{$pass}', USER_STT = 2 WHERE USER_CPF = :id");
        break;
}

try {
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $return = $stmt->rowCount();
} catch (PDOException $e) {
    $return = $e->getMessage();
}

//Desfaz conexão com banco de dados
$conexao = null;

echo json_encode($return);
?>
