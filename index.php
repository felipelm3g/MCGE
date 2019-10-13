<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <title>MC Gaviões da Estrada</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="img/MCGE.png" />

        <!-- Estilos customizados para esse template -->
        <link href="css/signin.css" rel="stylesheet">

        <style>
            
        </style>

    </head>
    <body class="text-center" cz-shortcut-listen="true">
        <form class="form-signin">
            <img class="mb-4" src="img/MCGE.png" alt="" width="200" height="200">
            <h1 class="h3 mb-3 font-weight-normal" style="cursor: default;">Gaviões da Estrada</h1>
            <label for="inputEmail" class="sr-only">Endereço de email</label>
            <input type="text" id="inputCPF" class="form-control" placeholder="CPF" autocomplete="off" required="" autofocus="">
            <label for="inputPassword" class="sr-only">Senha</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Senha" autocomplete="off" required="">
            <div class="checkbox mb-3">
                <label>
<!--                    <input type="checkbox" value="remember-me"> Lembrar de mim-->
                    <a href="forget.php" style="text-decoration: none;color: rgba(0,0,0,0.7);" data-toggle="modal" data-target="#exampleModalLong">Esqueci minha senha</a>
                </label>
            </div>
            <button class="btn btn-lg btn-dark btn-block" onclick="login();" type="button">Login</button>
        </form>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
