<?php
session_start();
if (!isset($_SESSION['user'])) {
    session_destroy();
    header('Location: index.php');
    exit;
} else {
    require_once 'sys/class/Database.php';
    date_default_timezone_set('America/Fortaleza');
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

        <title>MC Gaviões da Estrada - Principal</title>

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

        </style>
        <script>
            function Logout() {
                document.getElementById("exampleModalLabel").innerHTML = "Tem certeza?";
                document.getElementById("texto").innerHTML = "Depois de deslogar não será mais possível acessar o sistema, a menos que se logue novamente.";
                document.getElementById("writebtn").innerHTML = "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Não</button>";
                document.getElementById("writebtn").innerHTML += "<button type='button' onclick='window.location.href = \"sys/form/form_logout.php\";' class='btn btn-primary'>Sim</button>";
                $('#exampleModal').modal();
            }
            function OpenMapa(lat, log) {
                var linkmap = "https://www.google.com/maps/search/?api=1&query=" + lat + "," + log;
                window.open(linkmap, "_blank");
            }
        </script>
    </head>
    <body>
        <header style="float: left;width: 100%;position: relative;">
            <!--            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <a class="navbar-brand" onclick="OpenMenu();"><button style="font-size: 1.2em;" type="button" class="btn btn-outline-secondary btn-sm"><ion-icon style="float: left;" name="menu"></ion-icon></button> &nbsp;<?php // echo $_SESSION['user']['USER_NOME'];               ?></a>
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
            <?php
            //Cria conexão com banco de dados
            $conexao = Database::conexao();

            try {
                $consulta = $conexao->query("SELECT * FROM T_MENSALIDADES WHERE MENS_USER = {$_SESSION['user']['USER_CPF']} AND MENS_STT = 1");
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {

                    $txt = "";
                    $data = explode("-", $linha['MENS_DATA']);

                    switch ($data[1]) {
                        case 1:
                            $txt = "Jan";
                            break;
                        case 2:
                            $txt = "Fev";
                            break;
                        case 3:
                            $txt = "Mar";
                            break;
                        case 4:
                            $txt = "Abr";
                            break;
                        case 5:
                            $txt = "Mai";
                            break;
                        case 6:
                            $txt = "Jun";
                            break;
                        case 7:
                            $txt = "Jul";
                            break;
                        case 8:
                            $txt = "Ago";
                            break;
                        case 9:
                            $txt = "Set";
                            break;
                        case 10:
                            $txt = "Out";
                            break;
                        case 11:
                            $txt = "Nov";
                            break;
                        case 12:
                            $txt = "Dez";
                            break;
                    }

                    $txt = $txt . "/" . $data[0];

                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>";
                    echo "<h4 class='alert-heading'>Aviso!</h4>";
                    echo "<p>Sua mensalidade do mês <strong>" . $txt . "</strong> está atrasada, por favor entrar em contato com a diretoria.</p>";
                    echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close' onclick=''>";
                    echo "<span aria-hidden='true'>&times;</span>";
                    echo "</button>";
                    echo "</div>";
                }
            } catch (Exception $exc) {
                
            }

            try {
                $consulta = $conexao->query("SELECT * FROM T_EVENTOS WHERE EVENT_DATA = CURDATE();");
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                    echo "<h4 class='alert-heading'>" . $linha['EVENT_TTLO'] . "</h4>";
                    echo "<p>" . $linha['EVENT_DESC'] . "</p>";
                    if ($linha['EVENT_LAT'] != 0 && $linha['EVENT_LNG'] != 0) {
                        echo "<hr>";
                        echo "<button type='button' onclick='OpenMapa(" . $linha['EVENT_LAT'] . ", " . $linha['EVENT_LNG'] . ");' class='btn btn-success btn-sm'>Abrir Mapa</button>";
                    }
                    echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close' onclick=''>";
                    echo "<span aria-hidden='true'>&times;</span>";
                    echo "</button>";
                    echo "</div>";
                }
            } catch (Exception $exc) {
                
            }
            
            try {
                $consulta = $conexao->query("SELECT * FROM T_AVISOS;");
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>";
                    echo "<h4 class='alert-heading'>" . $linha['AVISO_TIT'] . "</h4>";
                    echo "<p>" . $linha['AVISO_DES'] . "</p>";
                    echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close' onclick=''>";
                    echo "<span aria-hidden='true'>&times;</span>";
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body> 
</html>
