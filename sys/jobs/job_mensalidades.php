<?php

require_once '../class/User.php';
require_once '../class/Database.php';
date_default_timezone_set('America/Fortaleza');

//Cria conexão com banco de dados
$conexao = Database::conexao();

$consulta = $conexao->query("SELECT * FROM T_USER WHERE NOT USER_TYP = 0;");

//Nome do arquivo
$nomearq = "logs/mensalidades/job_mensalidades_" . date("Y-m-d") . ".txt";

if (file_exists($nomearq)) {
    echo "O arquivo job_mensalidades_" . date("Y-m-d") . ".txt já existe";
    exit;
}

$texto = "";

while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {

    $user = new User($linha['USER_CPF']);

    if ($user->gerarFatura('25')) {
        echo $linha['USER_CPF'] . " - Gerado com sucesso <br>";
        $texto = $texto . $linha['USER_CPF'] . ' - Gerado com sucesso.' . " \r\n";
    } else {
        echo $linha['USER_CPF'] . " - Não foi gerado <br>";
        $texto = $texto . $linha['USER_CPF'] . ' - Não foi gerado.' . " \r\n";
    }

    $user = "";
}

if ($texto == "") {
    exit;
}

//Criamos o arquivo
$arquivo = fopen($nomearq, 'w');

//Verificamos se foi criado
if ($arquivo == false) {
    exit;
}

//Escrevemos no arquivo
fwrite($arquivo, $texto);
//Fechamos o arquivo
fclose($arquivo);

//Desfaz conexão com banco de dados
$conexao = null;

exit;
?>