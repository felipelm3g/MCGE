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

        <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
        <!-- Estilos customizados para esse template -->        
        <style>
        </style>
        <script>

            var ttlo = "";
            var desc = "";
            var lat = "";
            var lng = "";
            var dat = "";

            function Logout() {
                document.getElementById("exampleModalLabel").innerHTML = "Tem certeza?";
                document.getElementById("texto").innerHTML = "Depois de deslogar não será mais possível acessar o sistema, a menos que se logue novamente.";
                document.getElementById("writebtn").innerHTML = "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Não</button>";
                document.getElementById("writebtn").innerHTML += "<button type='button' onclick='window.location.href = \"../sys/form/form_logout.php\";' class='btn btn-primary'>Sim</button>";
                $('#exampleModal').modal();
            }

            function excluir(id) {

                var info = {
                    'id': id,
                };

                var ajax1 = $.ajax({
                    url: "../sys/form/form_del_evento.php",
                    type: 'POST',
                    data: info,
                    dataType: 'json',
                    beforeSend: function () {
                        console.log("Deletando evento...");
                    }
                })
                        .done(function (data) {
                            if (data == 1) {
                                console.log("Evento deletado.");
                            } else {
                                console.log("Erro ao tentar deletar evento.");
                            }
                            return;
                        })
                        .fail(function (jqXHR, textStatus, data) {
                            console.error(jqXHR + " - " + textStatus + " - " + data);
                            return;
                        });
            }

            function criar() {
                document.getElementById("regModalLabel").innerHTML = "Criar evento";
                document.getElementById("inputTitulo").value = "";
                document.getElementById("TextareaDesc").value = "";
                document.getElementById("inputLat").value = "";
                document.getElementById("inputLog").value = "";
                document.getElementById("inputData").value = "";
                document.getElementById("writebtnreg").innerHTML = "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";
                document.getElementById("writebtnreg").innerHTML += "<button type='button' onclick='salvar(\"C\");' class='btn btn-primary'>Salvar</button>";
                $('#regModal').modal();
            }
            function exibir(id) {

                document.getElementById("inputTitulo").value = "";
                document.getElementById("TextareaDesc").value = "";
                document.getElementById("inputLat").value = "";
                document.getElementById("inputLog").value = "";
                document.getElementById("inputData").value = "";

                var info = {
                    'id': id,
                };

                var ajax1 = $.ajax({
                    url: "../sys/form/form_get_evento.php",
                    type: 'POST',
                    data: info,
                    dataType: 'json',
                    beforeSend: function () {
                        console.log("Recuperando informações de evento...");
                    }
                })
                        .done(function (data) {
                            console.log("Informações recuperadas com sucesso...");
                            document.getElementById("regModalLabel").innerHTML = "Editar evento";
                            document.getElementById("inputTitulo").value = data[0]['EVENT_TTLO'];
                            document.getElementById("TextareaDesc").value = data[0]['EVENT_DESC'];
                            document.getElementById("inputLat").value = data[0]['EVENT_LAT'];
                            document.getElementById("inputLog").value = data[0]['EVENT_LNG'];
                            document.getElementById("inputData").value = data[0]['EVENT_DATA'];
                            document.getElementById("writebtnreg").innerHTML = "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";
                            document.getElementById("writebtnreg").innerHTML += "<button type='button' onclick='salvar(" + data[0]['EVENT_ID'] + ");' class='btn btn-primary'>Salvar</button>";
                            $('#regModal').modal();
                            return;
                        })
                        .fail(function (jqXHR, textStatus, data) {
                            console.error(jqXHR + " - " + textStatus + " - " + data);
                            return;
                        });
            }
            function salvar(id) {

                ttlo = document.getElementById("inputTitulo").value;
                desc = document.getElementById("TextareaDesc").value;
                lat = document.getElementById("inputLat").value;
                lng = document.getElementById("inputLog").value;
                dat = document.getElementById("inputData").value;

                if (ttlo == "") {
                    console.log("Titulo é obrigatorio.");
                    alert("Titulo é obrigatorio.");
                    return;
                }
                if (desc == "") {
                    console.log("Descrição é obrigatorio.");
                    alert("Descrição é obrigatorio.");
                    return;
                }
                if (dat == "") {
                    console.log("Data é obrigatoria.");
                    alert("Data é obrigatoria.");
                    return;
                }

                var info = {
                    'id': id,
                    'titulo': ttlo,
                    'descri': desc,
                    'latitude': lat,
                    'longitude': lng,
                    'data': dat,
                };

                var ajax1 = $.ajax({
                    url: "../sys/form/form_salve_evento.php",
                    type: 'POST',
                    data: info,
                    dataType: 'json',
                    beforeSend: function () {
                        console.log("Salvando informações de evento...");
                    }
                })
                        .done(function (data) {
                            if (data == 1) {
                                location.reload();
                                $('#regModal').modal('hide');
                            } else {
//                                alert("Erro no banco de dados.");
                                console.log("Erro no banco de dados.");
                            }
                            return;
                        })
                        .fail(function (jqXHR, textStatus, data) {
                            console.error(jqXHR + " - " + textStatus + " - " + data);
                            return;
                        });
            }

            window.onload = function (e) {

            }
        </script>
    </head>
    <body>
        <header style="float: left;width: 100%;">
            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #000;">
                <a class="navbar-brand" onclick="window.history.go(-1);"><button style="font-size: 1.2em;" type="button" class="btn btn-outline-secondary btn-sm"><ion-icon style="float: left;" name="arrow-round-back"></ion-icon></button> &nbsp;Agenda</a>
                <button style="font-size: 1.0em;" class="btn btn-outline-danger btn-sm" type="button" onclick="Logout();">Logout</button>
            </nav>
        </header>

        <main  style="float: left;width: 100%; padding: 20px;">
            <button onclick="criar();" style="margin-bottom: 15px;" type="button" class="btn btn-secondary btn-lg btn-block"><ion-icon name="add"></ion-icon> Adicionar</button>
            <?php
            //Cria conexão com banco de dados
            $conexao = Database::conexao();

            try {
                $consulta = $conexao->query("SELECT * FROM T_EVENTOS ORDER BY EVENT_DATA DESC");
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                    $data = explode("-", $linha['EVENT_DATA']);
                    $dthj = date("Y-m-d");
                    if (strtotime($linha['EVENT_DATA']) >= strtotime($dthj)) {
                        echo "<div onclick='exibir(" . intval($linha['EVENT_ID']) . ");' class='alert alert-primary alert-dismissible fade show' role='alert'>";
                    } else {
                        echo "<div onclick='exibir(" . intval($linha['EVENT_ID']) . ");' class='alert alert-secondary alert-dismissible fade show' role='alert'>";
                    }
                    echo "<strong>" . $linha['EVENT_TTLO'] . "</strong> - <font style='font-size: 0.8em;'>" . $data[2] . "/" . $data[1] . "/" . $data[0] . "</font><br>";
                    echo $linha['EVENT_DESC'];
                    echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close' onclick='excluir(" . intval($linha['EVENT_ID']) . ");'>";
                    echo "<span aria-hidden='true'><ion-icon name='trash'></ion-icon></span>";
                    echo "</button>";
                    echo "</div>";
                }
            } catch (Exception $exc) {
                
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
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputTitulo" placeholder="Título" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="TextareaDesc" placeholder="Descrição" required></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col">
                                            <input type="number" id="inputLat" class="form-control" placeholder="Latitude">
                                        </div>
                                        <div class="col">
                                            <input type="text" id="inputLog" class="form-control" placeholder="Longitude">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="inputData" placeholder="Data" required>
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
