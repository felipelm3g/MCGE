<!DOCTYPE html>
<?php
$titlesite = "404 Not Found";
$descricaosite = "Página inválida, por favor acessar um link válido.";
$keywordssite = "err,erro,404,not,found";
$authorsite = "FelipeLm3g";
$robotssite = "noindex,nofollow";

$sitename = "FelipeLopes";
$dominiosite = "www.felipelopes.eti.br";
$imgsite = "http://cloudnett.esy.es/wp-content/uploads/2015/02/magento-404-not-found-640x270.jpg";
$imgtype = "image/jpeg";
$imgwidth = "640";
$imgheight = "270";

$locale = "pt_BR";
$localealternate = "pt_BR";

/* TWITTER */
/* FACEBOOK */
$page_id = "100013484824797";
?>
<html lang="pt-br">
    <head>
        <title>
            <?php echo $titlesite; ?>
        </title>
        <meta charset="utf-8">
        <meta http-equiv="Content-Language" content="pt-br">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- SEO -->
        <meta name="description" content="<?php echo $descricaosite; ?>">
        <meta name="keywords" content="">
        <meta name="author" content="<?php echo $authorsite; ?> ">
        <meta name="robots" content="<?php echo $robotssite; ?> ">

        <meta property="og:type" content="website">
        <meta property="og:site_name" content="<?php echo $sitename; ?>">
        <meta property="og:title" content="<?php echo $titlesite; ?>">
        <meta property="og:description" content="<?php echo $descricaosite; ?>">
        <meta property="og:url" content="<?php echo $dominiosite; ?>">
        <meta property="og:image" content="<?php echo $imgdosite; ?>">
        <meta property="og:image:type" content="<?php echo $imgtype; ?>">
        <meta property="og:image:width" content="<?php echo $imgwidth; ?>">
        <meta property="og:image:height" content="<?php echo $imgheigth; ?>">

        <meta property="og:locale" content="<?php echo $locale; ?>">
        <meta property="og:locale:alternate" content="<?php echo $localealternate; ?>">

        <meta property="fb:page_id" content="<?php echo $imgdosite; ?>">

        <!-- Required meta tags -->
        <meta charset="utf-8">


        <link rel="icon" type="image/ico" href="img/favicon.ico" />

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <style type="text/css">
            .principal {
                position:absolute;
                top:0;
                left:0;
                background-color: rgba(0,0,0,0.01);
                width:100%;
                height:100%;
                text-align: center;
                cursor: default;
            }
            .error-template {
                position:absolute;
                top: calc(50% - 125px);
                left:0;
                width:100%;
                text-align: center;
                margin: 0px;
                padding: 0px;
            }
        </style>

    </head>

    <body>
        <main class="principal">
            <div class="error-template">
                <h1>
                    Oops!</h1>
                <h2>
                    404 Not Found</h2>
                <div class="error-details">
                    Desculpe, ocorreu um erro, a página Solicitada não foi encontrada!
                </div>
                <br>
                <div class="error-actions">
                    <?php
                    $url = explode("public_html/", getcwd());
                    if (isset($url[1])) {
                        $pastas = $url[1];
                    } else {
                        $pastas = "";
                    }
                    $link = "<a href='http://{$_SERVER['HTTP_HOST']}/{$pastas}/' class='btn btn-primary btn-lg'>Página Inicial</a>";
                    $link = str_replace("//", "/", $link);
                    echo $link;
                    ?>
                </div>
            </div>
        </main>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
