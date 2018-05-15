<?php require("Models/General.php");require("Controllers/Terreno.php");?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>AXE Bienes Raices</title>
    <meta name="description" content="AXE Bienes Raices">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="img/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="img/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="img/favicon/manifest.json">
    <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="img/favicon/favicon.ico">
    <meta name="msapplication-config" content="img/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css" />
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-minima.css" />
</head>

<body>
    <header id="header" class="header">
        <div class="container">
            <div class="header-homeContainer">
                <a href="index.php" class="header-home">
                    <img src="img/logoHeader.png" alt="AXE LOGO">
                </a>
                <div class="placesAutocomplete-container">
                    <div id="placesAutocomplete" class="placesAutocomplete">
                        <input type="search" id="address-input" placeholder="Donde quieres tu casa? &#9749; (Busca estado, municipio, calle o codigo postal)" />
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section id="info" class="info">
        <div class="container">
            <div id="renderBody">(Cargando..)</div>
        </div>
    </section>
    <?php require("Views/Shared/footer.php");?>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js"></script>
    <script src="js/jquery.linq.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.8/handlebars.js"></script>
    <script src="js/Core.handlebars.js"></script>
    <script src="js/swag.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
    <script>
        Swag.registerHelpers(Handlebars);
        var terreno = escapeSpecialChars('<?=json_encode($terreno)?>');
        terreno = JSON.parse(terreno);
    </script>
    <script src="js/terreno.js"></script>
</body>

</html>
