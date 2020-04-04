<?php
session_start();
if (!isset($_SESSION['user'])) {
    $return = false;
} else {
    if ($_SESSION['user']['USER_STT'] != 2) {
        $return = false;
    } else {
        require_once '../class/Database.php';
        date_default_timezone_set('America/Fortaleza');
        
        $pass = $_POST["pass1"];
        
        //Encriptar
        $pass = base64_encode($pass);
        
        //Cria conexão com banco de dados
        $conexao = Database::conexao();
        
        //Cria o comando SQL
        $stmt = $conexao->prepare("UPDATE T_USER SET USER_PASS = '{$pass}', USER_STT = 0 WHERE USER_CPF = :id");
        
        try {
            $stmt->bindParam(':id', $_SESSION['user']['USER_CPF']);
            $stmt->execute();
            $return = $stmt->rowCount();
            $return = true;
            
        } catch (PDOException $e) {
            $return = false;
        }
        
        //Desfaz conexão com banco de dados
        $conexao = null;
    }
}

echo json_encode($return);
?>

