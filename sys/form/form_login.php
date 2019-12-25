<?php

$cpf = $_POST["cpf"];
$pass = $_POST["pass"];

require_once '../class/User.php';
$user = new User();
$return = $user->logar();
echo json_encode($return);

?>

