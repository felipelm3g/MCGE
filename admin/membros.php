<?php
session_start();
if (!isset($_SESSION['user'])) {
    session_destroy();
    header('Location: ../index.php');
    exit;
} else {
    require_once '../sys/class/Database.php';
    date_default_timezone_set('America/Fortaleza');
}
?>
<!doctype html>
<html lang="pt-BR">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <title>MC Gaviões da Estrada - Agenda</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="../img/MCGDE.png" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule="" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.js"></script>
        <!-- Estilos customizados para esse template -->        
        <style>

        </style>
        <script>
            function Logout() {
                document.getElementById("exampleModalLabel").innerHTML = "Tem certeza?";
                document.getElementById("texto").innerHTML = "Depois de deslogar não será mais possível acessar o sistema, a menos que se logue novamente.";
                document.getElementById("writebtn").innerHTML = "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Não</button>";
                document.getElementById("writebtn").innerHTML += "<button type='button' onclick='window.location.href = \"../sys/form/form_logout.php\";' class='btn btn-primary'>Sim</button>";
                $('#exampleModal').modal();
            }
            
            function editar(id) {
                console.log(id);
            }
            
            function resetar(id) {
                var info = {
                    'id': id,
                    'act': 'RP',
                };
                var ajax1 = $.ajax({
                    url: "../sys/form/form_action_membro.php",
                    type: 'POST',
                    data: info,
                    dataType: 'json',
                    beforeSend: function () {
                        console.log("Resetando senha do membro...");
                    }
                })
                        .done(function (data) {
                            console.log(data);
                            if (data == 1) {
                                location.reload();
                            }
                            return;
                        })
                        .fail(function (jqXHR, textStatus, data) {
                            console.log(jqXHR + " - " + textStatus + " - " + data)
                            return;
                        });
            }
            
            function promover(id) {  
                var info = {
                    'id': id,
                    'act': 'P',
                };
                var ajax1 = $.ajax({
                    url: "../sys/form/form_action_membro.php",
                    type: 'POST',
                    data: info,
                    dataType: 'json',
                    beforeSend: function () {
                        console.log("Promovendo membro...");
                    }
                })
                        .done(function (data) {
                            console.log(data);
                            if (data == 1) {
                                location.reload();
                            }
                            return;
                        })
                        .fail(function (jqXHR, textStatus, data) {
                            console.log(jqXHR + " - " + textStatus + " - " + data)
                            return;
                        });
            }
            function rebaixar(id) {
                var info = {
                    'id': id,
                    'act': 'R',
                };
                var ajax1 = $.ajax({
                    url: "../sys/form/form_action_membro.php",
                    type: 'POST',
                    data: info,
                    dataType: 'json',
                    beforeSend: function () {
                        console.log("Rebaixando membro...");
                    }
                })
                        .done(function (data) {
                            console.log(data);
                            if (data == 1) {
                                location.reload();
                            }
                            return;
                        })
                        .fail(function (jqXHR, textStatus, data) {
                            console.log(jqXHR + " - " + textStatus + " - " + data)
                            return;
                        });
            }
            function bloquear(id) {
                var info = {
                    'id': id,
                    'act': 'B',
                };
                var ajax1 = $.ajax({
                    url: "../sys/form/form_action_membro.php",
                    type: 'POST',
                    data: info,
                    dataType: 'json',
                    beforeSend: function () {
                        console.log("Bloqueando membro...");
                    }
                })
                        .done(function (data) {
                            console.log(data);
                            if (data == 1) {
                                location.reload();
                            }
                            return;
                        })
                        .fail(function (jqXHR, textStatus, data) {
                            console.log(jqXHR + " - " + textStatus + " - " + data)
                            return;
                        });
            }
            function desbloquear(id) {
                var info = {
                    'id': id,
                    'act': 'D',
                };
                var ajax1 = $.ajax({
                    url: "../sys/form/form_action_membro.php",
                    type: 'POST',
                    data: info,
                    dataType: 'json',
                    beforeSend: function () {
                        console.log("Desbloqueando membro...");
                    }
                })
                        .done(function (data) {
                            console.log(data);
                            if (data == 1) {
                                location.reload();
                            }
                            return;
                        })
                        .fail(function (jqXHR, textStatus, data) {
                            console.log(jqXHR + " - " + textStatus + " - " + data)
                            return;
                        });
            }
            
            window.onload = function (e) {
                
            }
        </script>
    </head>
    <body>
        <header style="float: left;width: 100%;">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" onclick="window.history.go(-1);"><button style="font-size: 1.2em;" type="button" class="btn btn-outline-secondary btn-sm"><ion-icon style="float: left;" name="arrow-round-back"></ion-icon></button> &nbsp;Membros</a>
                <button style="font-size: 1.0em;" class="btn btn-outline-danger btn-sm" type="button" onclick="Logout();">Logout</button>
            </nav>
        </header>

        <main  style="float: left;width: 100%; padding: 20px;">
            <?php
            //Cria conexão com banco de dados
            $conexao = Database::conexao();

            try {
                $consulta = $conexao->query("SELECT * FROM T_USER ORDER BY USER_TYP DESC");
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='alert alert-secondary alert-dismissible' role='alert'>";
//                    echo "<strong>" . $linha['USER_NOME'] . "</strong><br>";
                    echo "<table style='width:100%;margin: 0px;padding: 0px;'>";
                    echo "<tr>";
                    echo "<th>" . $linha['USER_NOME'] . "</th>";
                    switch (intval($linha['USER_TYP'])) {
                        case 0:
                            echo "<td>Amigo</td>";
                            break;
                        case 1:
                            echo "<td>Membr</td>";
                            break;
                        case 2:
                            echo "<td>Diret</td>";
                            break;
                    }
                    switch (intval($linha['USER_STT'])) {
                        case 0:
                            echo "<td><ion-icon name='lock' style='opacity: 0.3;'></ion-icon></td>";
                            break;
                        case 1:
                            echo "<td><ion-icon name='lock'></ion-icon></td>";
                            break;
                        case 2:
                            echo "<td><ion-icon name='sync'></ion-icon></td>";
                            break;
                    }
                    echo "</tr>";
                    echo "</table>";
                    echo "<button type='button' class='close'  aria-label='Close' id='dropdownMenuButton' data-toggle='dropdown'>";
                    echo "<span aria-hidden='true'><ion-icon name='more'></ion-icon></span>";
                    echo "</button>";
                    echo "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>";
                    echo "<a class='dropdown-item' onclick='editar(" . intval($linha['USER_CPF']) . ");' href='#'><ion-icon name='create'></ion-icon> Editar</a>";
                    switch (intval($linha['USER_TYP'])) {
                        case 0:
                            echo "<a onclick='promover(" . intval($linha['USER_CPF']) . ");' class='dropdown-item' href='#'><ion-icon name='trending-up'></ion-icon> Promover a membro</a>";
                            break;
                        case 1:
                            echo "<a onclick='rebaixar(" . intval($linha['USER_CPF']) . ");' class='dropdown-item' href='#'><ion-icon name='trending-down'></ion-icon> Rebaixar a amigo</a>";
                            echo "<a onclick='promover(" . intval($linha['USER_CPF']) . ");' class='dropdown-item' href='#'><ion-icon name='trending-up'></ion-icon> Promover a diretoria</a>";
                            break;
                        case 2:
                            echo "<a onclick='rebaixar(" . intval($linha['USER_CPF']) . ");' class='dropdown-item' href='#'><ion-icon name='trending-down'></ion-icon> Rebaixar a membro</a>";
                            break;
                    }
                    echo "<a class='dropdown-item' onclick='resetar(" . intval($linha['USER_CPF']) . ");' href='#'><ion-icon name='sync'></ion-icon> Resetar Senha</a>";
                    switch (intval($linha['USER_STT'])) {
                        case 0:
                            echo "<a onclick='bloquear(" . intval($linha['USER_CPF']) . ");' class='dropdown-item' href='#'><ion-icon name='lock'></ion-icon> Bloquear Usuario</a>";
                            break;
                        case 1:
                            echo "<a onclick='desbloquear(" . intval($linha['USER_CPF']) . ");' class='dropdown-item' href='#'><ion-icon name='unlock'></ion-icon> Desbloquear Usuario</a>";
                            break;
                    }
                    echo "</div>";
                    echo "</div>";
                }
            } catch (Exception $exc) {
                echo "<p>MYSQL - Erro ao selecionar eventos...</p>";
            }

            //Desfaz conexão com banco de dados
            $conexao = null;
            ?>
        </main>

        <!-- Modal -->
        <div class="modal fade" style="" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="texto">teste</p>
                    </div>
                    <div class="modal-footer" id="writebtn">
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" style="" id="regModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="regModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Posto</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPosto" placeholder="Nome Posto" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Combs.</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputCombs" placeholder="Combustivel" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Litro</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="inputLitro" placeholder="Litros" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Vlr R$</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="inputVlr" placeholder="Valor Pago" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Data</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="inputData" placeholder="Data" readonly>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer" id="writebtnreg">
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body> 
</html>
