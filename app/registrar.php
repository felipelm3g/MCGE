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

        <title>MC Gaviões da Estrada - Registrar</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="img/MCGDE.png" />

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
                    cadastrar();
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

            function cadastrar() {

                var cpf, name, pass1, pass2;

                if (document.getElementById('InputCPF').value == "" ||
                        document.getElementById('InputName').value == "" ||
                        document.getElementById('InputPassword1').value == "" ||
                        document.getElementById('InputPassword2').value == "") {

                    document.getElementById("texto").innerHTML = "Preencher todos os campos!";
                    $('#exampleModal').modal();
                    return;
                } else {

                    cpf = document.getElementById('InputCPF').value;
                    name = document.getElementById('InputName').value;
                    pass1 = document.getElementById('InputPassword1').value;
                    pass2 = document.getElementById('InputPassword2').value;

                    if (cpf.length != 11) {
                        document.getElementById("texto").innerHTML = "CPF inválido";
                        $('#exampleModal').modal();
                        return;
                    }

                    if (pass1 != pass2) {
                        document.getElementById('InputPassword1').value = ""
                        document.getElementById('InputPassword2').value = ""
                        document.getElementById("texto").innerHTML = "As senhas não coincidem";
                        $('#exampleModal').modal();
                        return;
                    }

                }

                var info = {
                    'cpf': cpf,
                    'nome': name,
                    'pass': pass1,
                };

                var ajax1 = $.ajax({
                    url: "sys/form/form_salve_membro.php",
                    type: 'POST',
                    data: info,
                    beforeSend: function () {
                        console.log("Cadastrando usuario...");
                    }
                })
                        .done(function (data) {
                            console.log(data);
                            if (data == 0 || data == '0') {
                                console.log("Cadastrado com sucesso.");
                                document.getElementById('InputCPF').value = "";
                                document.getElementById('InputName').value = "";
                                document.getElementById('InputPassword1').value = "";
                                document.getElementById('InputPassword2').value = "";
                                document.getElementById("texto").innerHTML = "Parabéns <b>" + name + "</b> você foi cadastrado com sucesso! Logo seu acesso a nossa aplicação será liberado.";
                                $('#exampleModal').modal();
                                setTimeout(function(){ window.location.href = "index.php"; }, 1000);
                                return;
                            } else {
                                switch (parseInt(data)) {
                                    case 1:
                                        document.getElementById("texto").innerHTML = "CPF já cadastrado.";
                                        $('#exampleModal').modal();
                                        console.log("CPF já cadastrado.");
                                        break;

                                    case 2:
                                        document.getElementById("texto").innerHTML = "Erro no banco de dados. Por favor tentar novamente. Se o erro persistir por favor entrar em contato com a diretoria.";
                                        $('#exampleModal').modal();
                                        console.log("Erro banco de dados.");
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
    <body style="padding: 20px;">
        <h4>MC Gaviões da Estrada</h4>
        <h5>Folha de Cadastro</h5>
        <hr>
        <form>
            <div class="form-group">
                <input type="number" class="form-control" id="InputCPF" placeholder="Digite seu CPF">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="InputName" placeholder="Digite seu Nome">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="InputPassword1" placeholder="Digite sua Senha">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="InputPassword2" placeholder="Confirmar Senha">
            </div>
            <button type="button" onclick="cadastrar();" class="btn btn-primary">Cadastrar</button>
        </form>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Aviso</h5>
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
