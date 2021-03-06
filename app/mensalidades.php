<?php
session_start();
if (!isset($_SESSION['user'])) {
    session_destroy();
    header('Location: index.php');
    exit;
} else {
    if ($_SESSION['user']['USER_TYP'] == 0) {
        header('Location: index.php');
        exit;
    }
    if ($_SESSION['user']['USER_STT'] == 2) {
        header('Location: reset.php');
        exit;
    }
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

        <title>MC Gaviões da Estrada - Mensalidades</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="img/MCGDE.png" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule="" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.js"></script>
        <!-- Estilos customizados para esse template -->        
        <style>
            input[type=number]::-webkit-inner-spin-button { 
                -webkit-appearance: none;

            }
            input[type=number] { 
                -moz-appearance: textfield;
                appearance: textfield;

            }
            .mensalidadetable {
                border: 1px solid #898989;
                border-collapse: collapse;
            }
            .mensalidadetable tr th {
                border: 1px solid #898989;
                border-collapse: collapse;
                padding: 5px;
                text-align: left;
            }
            .mensalidadetable tr td {
                border: 1px solid #898989;
                border-collapse: collapse;
                padding: 5px;
                text-align: left;
            }
        </style>
        <script>

            var mes = ['N/A', 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

            function Logout() {
                document.getElementById("exampleModalLabel").innerHTML = "Tem certeza?";
                document.getElementById("texto").innerHTML = "Depois de deslogar não será mais possível acessar o sistema, a menos que se logue novamente.";
                document.getElementById("writebtn").innerHTML = "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Não</button>";
                document.getElementById("writebtn").innerHTML += "<button type='button' onclick='window.location.href = \"sys/form/form_logout.php\";' class='btn btn-primary'>Sim</button>";
                $('#exampleModal').modal();
            }

            function Open(id) {

                var info = {
                    'id': id,
                };

                var ajax2 = $.ajax({
                    url: "sys/return/return_mensalidade.php",
                    type: 'POST',
                    data: info,
                    dataType: 'json',
                    beforeSend: function () {
                        console.log("Buscando detalhes...");
                    }
                })
                        .done(function (data) {
                            console.log("Busca concluída...");

                            document.getElementById("ModalDetalheLabel").innerHTML = "Mensalidade";

                            var html = "";
                            var difvlr = parseFloat(data[0]['MENS_VLR']) - parseFloat(data[0]['MENS_DES']);
                            var txt = "";

                            var date1 = data[0]['MENS_DATA'].split('-');
                            txt = mes[parseInt(date1[1])] + "/" + date1[0];

                            document.getElementById("textomensal").innerHTML = txt;

                            html += "<tr><td>Vencimento</td><td>" + date1[2] + "/" + date1[1] + "/" + date1[0] + "</td></tr>";
                            html += "<tr><td>Valor</td><td>R$ " + data[0]['MENS_VLR'] + "</td></tr>";
                            html += "<tr><td>Desconto</td><td>R$ " + data[0]['MENS_DES'] + "</td></tr>";
                            if (data[0]['MENS_OBS'] != null) {
                                html += "<tr><td>Observação</td><td>" + data[0]['MENS_OBS'] + "</td></tr>";
                            }
                            html += "<tr><td>Total</td><td>R$ " + difvlr.toFixed(2) + "</td></tr>";

                            document.getElementById('mensaltable').innerHTML = html;

                            if (data[0]['MENS_PAGT'] != null) {
                                var date2 = data[0]['MENS_PAGT'].split('-');
                                document.getElementById("datapagmt").innerHTML = "Dt pgmt. " + date2[2] + "/" + date2[1] + "/" + date2[0];
                            }
                            $('#ModalDetalhe').modal();

                            return;
                        })
                        .fail(function (jqXHR, textStatus, data) {
                            console.error(jqXHR + " - " + textStatus + " - " + data)
                            return;
                        });


            }

            function MontarMensalidade() {

                var ajax1 = $.ajax({
                    url: "sys/return/return_mensalidades.php",
                    type: 'POST',
                    dataType: 'json',
                    beforeSend: function () {
                        console.log("Recuperando informaçoes de mensalidades...");
                    }
                })
                        .done(function (data) {
                            console.log("Informações recuperadas com sucesso...")
//                            console.log(data);
                            var html = "";
                            var difvlr;
                            var txt = "";

                            for (i = 0; i < data.length; i++) {

                                difvlr = parseFloat(data[i]['MENS_VLR']) - parseFloat(data[i]['MENS_DES']);
                                var date1 = data[i]['MENS_DATA'].split('-');

                                txt = mes[parseInt(date1[1])] + "/" + date1[0];

                                html += "<tr onclick='Open(" + data[i]['MENS_ID'] + ");'>";
                                html += "<th scope='row'>" + txt + "</th>";
                                html += "<td>R$ " + difvlr.toFixed(2) + "</td>";
                                switch (data[i]['MENS_STT']) {
                                    case "0":
                                        html += "<td style='color: #E0A800;'><ion-icon name='time'></ion-icon></td>";
                                        break;
                                    case "1":
                                        html += "<td style='color: #C82333;'><ion-icon name='alarm'></ion-icon></td>";
                                        break;
                                    case "2":
                                        html += "<td style='color: #218838;'><ion-icon name='checkmark'></ion-icon></td>";
                                        break;
                                }
                                html += "</tr>";
                                document.getElementById('tablemensal').innerHTML += html;
                                html = "";
                            }
                            return;
                        })
                        .fail(function (jqXHR, textStatus, data) {
                            console.error(jqXHR + " - " + textStatus + " - " + data);
                            return;
                        });
            }

            window.onload = function (e) {
                MontarMensalidade();
            }
        </script>
    </head>
    <body>
        <header style="float: left;width: 100%;position: relative;">
            <!--            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <a class="navbar-brand" onclick="OpenMenu();"><button style="font-size: 1.2em;" type="button" class="btn btn-outline-secondary btn-sm"><ion-icon style="float: left;" name="menu"></ion-icon></button> &nbsp;<?php // echo $_SESSION['user']['USER_NOME'];                         ?></a>
                            <button style="font-size: 1.0em;" class="btn btn-outline-danger btn-sm" type="button" onclick="Logout();">Logout</button>
                        </nav>-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="float: left; width: 100%;">
                <a class="navbar-brand" href="main.php"><?php echo $_SESSION['user']['USER_NOME']; ?></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <?php
                        switch ($_SESSION['user']['USER_TYP']) {
                            case 0:
                                echo "<a class='nav-item nav-link' href='agenda.php'><ion-icon name='calendar'></ion-icon> Agenda</a>";
                                break;

                            case 1:
                                echo "<a class='nav-item nav-link' href='agenda.php'><ion-icon name='calendar'></ion-icon> Agenda</a>";
                                echo "<a class='nav-item nav-link' href='mensalidades.php'><ion-icon name='logo-usd'></ion-icon> Mensalidades</a>";
                                break;

                            case 2:
                                echo "<a class='nav-item nav-link' href='administracao.php'><ion-icon name='podium'></ion-icon> Administração</a>";
                                echo "<a class='nav-item nav-link' href='agenda.php'><ion-icon name='calendar'></ion-icon> Agenda</a>";
                                echo "<a class='nav-item nav-link' href='mensalidades.php'><ion-icon name='logo-usd'></ion-icon> Mensalidades</a>";
                                break;
                        }
                        ?>
                        <a class='nav-item nav-link' href='#' onclick="Logout();"><ion-icon name='power'></ion-icon> Sair</a>
                    </div>
                </div>
            </nav>
        </header>

        <main  style="float: left;width: 100%; padding: 20px;">
            <p style="font-size: 0.8em; opacity: 0.5;"><ion-icon name="information-circle-outline"></ion-icon> Clique para obter detalhes.</p>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Mês</th>
                    <th scope="col">Valor</th>
                    <th scope="col">St</th>
                </tr>
            </thead>
            <tbody id="tablemensal"><!--
                <tr onclick="Open(1);">
                    <th scope="row">Jan/2020</th>
                    <td>R$ 5,00</td>
                    <td style="color: #218838;"><ion-icon name="checkmark"></ion-icon></td>
            </tr>
            <tr onclick="Open(2);">
                <th scope="row">Fev/2020</th>
                <td>R$ 25,00</td>
                <td style="color: #C82333;"><ion-icon name="alarm"></ion-icon></td>
            </tr>
            <tr onclick="Open(3);">
                <th scope="row">Mar/2020</th>
                <td>R$ 25,00</td>
                <td style="color: #E0A800;"><ion-icon name="time"></ion-icon></td>
            </tr>-->
            </tbody>
        </table>
    </main>

    <!-- Modal Logout -->
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

    <!-- Modal Detalhe -->
    <div class="modal fade" style="" id="ModalDetalhe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalDetalheLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <b><p id="textomensal">Mes/0000 <font style="color: #218838;"><ion-icon name="checkmark"></ion-icon></font></p></b>
                    <table class="mensalidadetable" id="mensaltable">

                    </table>
                    <p id="datapagmt" style="margin-bottom: 1px; margin-top: 10px; font-weight: normal; font-size: 0.8em; color: rgba(0, 0, 0, 0.5);"></p>
                </div>
                <div class="modal-footer" id="writebtn">
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body> 
</html>
