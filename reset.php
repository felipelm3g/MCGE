<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: main.php');
    exit;
} else {
    if ($_SESSION['user']['USER_STT'] != 2) {
        header('Location: main.php');
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

        <title>MC Gaviões da Estrada - Reset</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="img/MCGDE.png" />

        <!-- Estilos customizados para esse template -->
        <link href="css/signin.css" rel="stylesheet">
        
        <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule="" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>

            window.onload = function () {
                try {
                    toggleFullScreen();
                } catch (e) {
                    // declarações para manipular quaisquer exceções
                    console.log(e); // passa o objeto de exceção para o manipulador de erro
                }
            };

            window.onkeypress = function (e) {
                if (e['keyCode'] == 13) {
                    login();
                }
            }

            function toggleFullScreen() {
                if (!document.fullscreenElement && // alternative standard method
                        !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement) {  // current working methods
                    if (document.documentElement.requestFullscreen) {
                        document.documentElement.requestFullscreen();
                    } else if (document.documentElement.msRequestFullscreen) {
                        document.documentElement.msRequestFullscreen();
                    } else if (document.documentElement.mozRequestFullScreen) {
                        document.documentElement.mozRequestFullScreen();
                    } else if (document.documentElement.webkitRequestFullscreen) {
                        document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                    }
                } else {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    } else if (document.msExitFullscreen) {
                        document.msExitFullscreen();
                    } else if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen();
                    } else if (document.webkitExitFullscreen) {
                        document.webkitExitFullscreen();
                    }
                }
            }

            function login() {
                var info = {
                    'cpf': document.getElementById('inputEmail').value,
                    'pass': document.getElementById('inputPassword').value,
                };

                if (document.getElementById('inputEmail').value == "" ||
                    document.getElementById('inputPassword').value == "") {
                    document.getElementById("texto").innerHTML = "Preencher todos os campos!";
                    $('#exampleModal').modal();
                    
                    return;
                }

                var ajax1 = $.ajax({
                    url: "sys/form/form_login.php",
                    type: 'POST',
                    data: info,
                    beforeSend: function () {
                        console.log("Validando login...");
                    }
                })
                        .done(function (data) {
                            if (data == 0 || data == '0') {
                                console.log("Login validado com sucesso.");
                                window.location.href = "main.php";
                                return;
                            } else {
                                switch (parseInt(data)) {
                                    case 1:
                                        document.getElementById("texto").innerHTML = "CPF não cadastrado ou inválido.";
                                        $('#exampleModal').modal();
                                        console.log("CPF não cadastrado ou inválido.");
                                        break;

                                    case 2:
                                        document.getElementById("texto").innerHTML = "Senha inválida.";
                                        $('#exampleModal').modal();
                                        console.log("Senha inválida.");
                                        break;
                                }
                                return;
                            }
                        })
                        .fail(function (jqXHR, textStatus, data) {
                            console.log(jqXHR + " - " + textStatus + " - " + data)
                            return;
                        });
            }
        </script>
    </head>
    <body class="text-center" cz-shortcut-listen="true">
        <!--<a href="cadastro.php" style="float: left; position: absolute; top: 15px; right: 15px; opacity: 0.4;"><button type="button" class="btn btn-secondary btn-sm">Criar Conta</button></a>;-->
        <form class="form-signin">
            <!--<img class="mb-4" src="img/MCGE.png" alt="" width="190" height="190">-->
            <img class="mb-4" src="https://i.imgur.com/NLGDy4j.png" alt="" width="190" height="190">
            <h1 class="h3 mb-3 font-weight-normal" style="cursor: default;">Acesso</h1>
            <label for="inputEmail" class="sr-only">Endereço de email</label>
            <input type="number" id="inputEmail" class="form-control" placeholder="CPF" autocomplete="off" required="" autofocus="" style="text-align: center;">
            <label for="inputPassword" class="sr-only">Senha</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Senha" autocomplete="off" required="" style="text-align: center;">
            <div class="checkbox mb-3">
                <label>
<!--                    <input type="checkbox" value="remember-me"> Lembrar de mim-->
                    <a href="forget.php" style="text-decoration: none;color: rgba(0,0,0,0.7);">Esqueci minha senha</a>
                </label>
            </div>
            <button class="btn btn-lg btn-secondary btn-block" onclick="login();" type="button">Acessar</button>
            <p class="mt-5 mb-3 text-muted" style="cursor: default;">© 2019</p>
        </form>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Login inválido</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="text-align: left;">
                        <p id="texto">teste</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
