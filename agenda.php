<?php
session_start();
if (!isset($_SESSION['user'])) {
    session_destroy();
    header('Location: index.php');
    exit;
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
        <link rel="shortcut icon" href="img/MCGDE.png" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
        <!-- Estilos customizados para esse template -->        
        <style>
            input[type=number]::-webkit-inner-spin-button { 
                -webkit-appearance: none;

            }
            input[type=number] { 
                -moz-appearance: textfield;
                appearance: textfield;

            }

        </style>
        <script>

            var data = new Date();
            var diacalendar = data.getDate();
            var mescalendar = data.getMonth();
            var anocalendar = data.getFullYear();

            function Logout() {
                document.getElementById("exampleModalLabel").innerHTML = "Tem certeza?";
                document.getElementById("texto").innerHTML = "Depois de deslogar não será mais possível acessar o sistema, a menos que se logue novamente.";
                document.getElementById("writebtn").innerHTML = "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Não</button>";
                document.getElementById("writebtn").innerHTML += "<button type='button' onclick='window.location.href = \"sys/form/form_logout.php\";' class='btn btn-primary'>Sim</button>";
                $('#exampleModal').modal();
            }

            function MontarCalendario(dia, mes, ano) {

                var html = "";

                var dataatual = new Date();
                var diaatual = dataatual.getDate();
                var mesatual = dataatual.getMonth();
                var anoatual = dataatual.getFullYear();

                //console.log(dataatual);

                var dataprocesso = new Date(ano, mes, dia);
                var diaprocesso = dataprocesso.getDate();
                var mesprocesso = dataprocesso.getMonth();
                var anoprocesso = dataprocesso.getFullYear();

                //console.log(dataprocesso);

                var totaldiasm = diasNoMes(mesprocesso, anoprocesso);
                var diasemana = diaDaSemana(mesprocesso, anoprocesso);

                //console.log(totaldiasm);
                //console.log(diasemana);

                var dayshow = 0;
                for (i = 0; i < 36; i++) {
                    if (i == 0 || i == 7 || i == 14 || i == 21 || i == 28) {
                        html += "<tr>";
                    }

                    if (i > diasemana) {
                        dayshow++;
                        if (dayshow > totaldiasm) {
                            html += "<td></td>";
                        } else {
                            if (diaatual == dayshow && mesatual == mesprocesso && anoatual == anoprocesso) {
                                html += "<td><button style='width: 44px;' onclick='AbrirDia(" + dayshow + "," + mesprocesso + "," + anoprocesso + ");' type='button' class='btn btn-outline-primary'>" + dayshow + "</button></td>";
                            } else {
                                html += "<td><button style='width: 44px;' onclick='AbrirDia(" + dayshow + "," + mesprocesso + "," + anoprocesso + ");' type='button' class='btn btn-outline-secondary'>" + dayshow + "</button></td>";
                            }
                        }
                    } else {
                        html += "<td></td>";
                    }


                    if (i == 6 || i == 13 || i == 20 || i == 27 || i == 34) {
                        html += "</tr>";
                    }
                }

                document.getElementById("calendardays").innerHTML = html;
            }

            function AvancarMes() {
                console.log("Avançando mês...");
                mescalendar = mescalendar + 1;
                if (mescalendar >= 12) {
                    mescalendar = 0;
                    anocalendar = anocalendar + 1;
                }
                MontarCalendario(diacalendar, mescalendar, anocalendar);
            }

            function RetrocederMes() {
                console.log("Voltando mês...");
                mescalendar = mescalendar - 1;
                if (mescalendar < 0) {
                    mescalendar = 11;
                    anocalendar = anocalendar - 1;
                }
                MontarCalendario(diacalendar, mescalendar, anocalendar);
            }

            function AbrirDia(dia, mes, ano) {
                var dt = new Date(ano, mes, dia);
                console.log(dt);
            }

            function diasNoMes(mes, ano) {
                var dt = new Date(ano, mes + 1, 0);
                return dt.getDate();
            }

            function diaDaSemana(mes, ano) {
                var dt = new Date(ano, mes, 0);
                return dt.getDay();
            }

            window.onload = function (e) {
                MontarCalendario(diacalendar, mescalendar, anocalendar);
            }
        </script>
    </head>
    <body>
        <header style="float: left;width: 100%;position: relative;">
            <!--            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <a class="navbar-brand" onclick="OpenMenu();"><button style="font-size: 1.2em;" type="button" class="btn btn-outline-secondary btn-sm"><ion-icon style="float: left;" name="menu"></ion-icon></button> &nbsp;<?php // echo $_SESSION['user']['USER_NOME'];                            ?></a>
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
            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                <button onclick="RetrocederMes();" type="button" class="btn btn-ligth"><</button>
                <button type="button" class="btn btn-ligth" disabled="">Janeiro</button>
                <button onclick="AvancarMes();" type="button" class="btn btn-ligth">></button>
            </div>
            <table style="width:100%">
                <thead style="width:100%">
                    <tr style="width:100%">
                        <th style="color: #dc3545;">Dom</th>
                        <th>Seg</th>
                        <th>Ter</th>
                        <th>Qua</th>
                        <th>Qui</th>
                        <th>Sex</th>
                        <th>Sab</th>
                    </tr>
                </thead>
                <tbody id="calendardays">
                </tbody>
            </table>
            <hr>
            <div class="alert alert-secondary" role="alert">
                Evento 1.
            </div>
            <div class="alert alert-secondary" role="alert">
                Evento 2.
            </div>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body> 
</html>
