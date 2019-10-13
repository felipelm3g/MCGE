<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <title>MC Gaviões da Estrada</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="img/MCGE.png" />

        <!-- Icones -->
        <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>

        <script>

            var txtmeses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
            var txtsemana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
            var dhj = new Date();

            var calendario = {
                'mes': dhj.getMonth(),
                'ano': dhj.getFullYear(),
            };

            window.onload = function (e) {
                montarcalendario(calendario['ano'], calendario['mes']);
            }

            function montarcalendario(ano, mes) {
                var dt = new Date(ano, mes, 1);
                document.getElementById('mes-tt').innerHTML = txtmeses[mes] + " - " + ano;

                var fdayn = txtsemana[diaDaSemana(dt.getMonth(), dt.getFullYear())];
                var ddm = diasNoMes(dt.getMonth() + 1, dt.getFullYear());
                var datainfo = {
                    'dtc': dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate(),
                    'ano': dt.getFullYear(),
                    'mes': dt.getMonth() + 1,
                    'mest': txtmeses[dt.getMonth()],
                    'diat': txtsemana[dt.getDay()],
                    'dia': dt.getDate(),
                    'ddm': diasNoMes(dt.getMonth() + 1, dt.getFullYear()),
                    'fdayt': txtsemana[diaDaSemana(dt.getMonth(), dt.getFullYear())],
                    'fdayn': diaDaSemana(dt.getMonth(), dt.getFullYear()),
                };
                console.log(datainfo);
                var cal = document.getElementById("tbcalendar");
                cal.innerHTML = "";
                var dias = 1;
                var semana = "";
                var today = 0;
                if (dt.getFullYear() == dhj.getFullYear() && dt.getMonth() == dhj.getMonth()) {
                    today = dhj.getDate();
                } else {
                    today = 0;
                }
                for (s = 0; s < 5; s++) {

                    semana += "<tr>";
                    for (d = 0; d < 7; d++) {
                        if (dias == 1) {
                            if (datainfo['fdayn'] == d) {
                                semana += "<td id='day-" + dias + "'>" + dias + "</td>";
                                dias++;
                            } else {
                                semana += "<td></td>";
                            }
                        } else {
                            if (dias <= ddm) {
                                semana += "<td id='day-" + dias + "'>" + dias + "</td>";
                                dias++;
                            } else {
                                semana += "<td></td>";
                            }
                        }
                    }
                    semana += "</tr>";

                    cal.innerHTML += semana;
                    semana = "";
                }

                if (today != 0) {
                    var vr = "day-" + today;
                    document.getElementById(vr).style.backgroundColor = "#FE2E2E";
                    document.getElementById(vr).style.color = "#FFFFFF";
                    document.getElementById(vr).style.fontWeight = "bold";
                }
            }

            function diasNoMes(mes, ano) {
                var dt = new Date(ano, mes, 0);
                return dt.getDate();
            }
            function diaDaSemana(mes, ano) {
                var dt = new Date(ano, mes, 1);
                return dt.getDay();
            }
            function aumentaData() {
                if (calendario['mes'] == 11) {
                    calendario['mes'] = 0;
                    calendario['ano']++;
                } else {
                    calendario['mes']++;
                }
                montarcalendario(calendario['ano'], calendario['mes']);
            }
            function diminuiData() {
                if (calendario['mes'] <= 0) {
                    calendario['mes'] = 11;
                    calendario['ano']--;
                } else {
                    calendario['mes']--;
                }
                montarcalendario(calendario['ano'], calendario['mes']);
            }
            function datahj() {
                calendario['mes'] = dhj.getMonth();
                calendario['ano'] = dhj.getFullYear();
                montarcalendario(calendario['ano'], calendario['mes']);
            }
        </script>
    </head>
    <body>
        <header style="float: left;width: 100%;">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="agenda.php"><ion-icon name="calendar"></ion-icon> Agenda <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><ion-icon name="person"></ion-icon> Cadastro</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><ion-icon name="logo-usd"></ion-icon> Financeiro</a>
                        </li>
                        <!--                        <li class="nav-item">
                                                    <a class="nav-link disabled" href="#">Desabilitado</a>
                                                </li>-->
                    </ul>
                </div>
                <button style="font-size: 1.0em;" class="btn btn-danger btn-sm" type="button" onclick="Logout();">Sair</button>
            </nav>
        </header>

        <main style="float: left;width: 100%; padding: 10px;">

            <div style="float: left;width: 100%; margin-bottom: 10px;">
                <button onclick="diminuiData();" style="float: left; width: 80px;" type="button" class="btn btn-light btn-sm">Anterior</button>
                <h5 id="mes-tt" style="float: left; width: calc(100% - 160px); text-align: center;"></h5>
                <button onclick="aumentaData();" style="float: left; width: 80px;" type="button" class="btn btn-light btn-sm">Proximo</button>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Dom</th>
                        <th scope="col">Seg</th>
                        <th scope="col">Ter</th>
                        <th scope="col">Qua</th>
                        <th scope="col">Qui</th>
                        <th scope="col">Sex</th>
                        <th scope="col">Sáb</th>
                    </tr>
                </thead>
                <tbody id="tbcalendar">
                </tbody>
            </table>
            <button onclick="datahj();" style="float: left;width: 100%;" type="button" class="btn btn-secondary">Data Hoje</button>
        </main>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>