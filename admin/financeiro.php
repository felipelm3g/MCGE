<?php
session_start();
if (!isset($_SESSION['user'])) {
    session_destroy();
    header('Location: ../index.php');
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
        <link rel="shortcut icon" href="img/favicon.ico" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
        <!-- Estilos customizados para esse template -->        
        <style>

        </style>
        <script>
            function Logout() {
                document.getElementById("exampleModalLabel").innerHTML = "Tem certeza?";
                document.getElementById("texto").innerHTML = "Depois de deslogar não será mais possível acessar o sistema, a menos que se logue novamente.";
                document.getElementById("writebtn").innerHTML = "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Não</button>";
                document.getElementById("writebtn").innerHTML += "<button type='button' onclick='window.location.href = \"sys/forms/deslogar.php\";' class='btn btn-primary'>Sim</button>";
                $('#exampleModal').modal();
            }

            window.onload = function (e) {
                
            }
        </script>
    </head>
    <body>
        <header style="float: left;width: 100%;">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" onclick="window.history.go(-1);"><button style="font-size: 1.2em;" type="button" class="btn btn-outline-secondary btn-sm"><ion-icon style="float: left;" name="arrow-round-back"></ion-icon></button> &nbsp;Financeiro</a>
                <button style="font-size: 1.0em;" class="btn btn-outline-danger btn-sm" type="button" onclick="Logout();">Logout</button>
            </nav>
        </header>

        <main  style="float: left;width: 100%; padding: 20px;">
            
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
