<?php require("Models/General.php");valid_session()?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>AXE Bienes Raices</title>
    <meta name="description" content="Administracion AXE">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-material-design.css">
    <link rel="stylesheet" type="text/css" href="css/ripples.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-table.min.css">
    <link rel="stylesheet" type="text/css" href="css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/dropzone.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <header id="header" class="header">
        <div class="container">
            <nav id="menu">
                <button class="btn btn-default"><i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    <?=$_SESSION["vcNombres"]?>
                </button>
                <button id="btnTerrenos" type="button" class="btn btn-default">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <span>Terrenos</span>
                </button>
                <button id="btnAsesores" type="button" class="btn btn-default">
                    <i class="fa fa-address-card" aria-hidden="true"></i>
                    <span>Asesores</span>
                </button>
            </nav>
        </div>
    </header>
    <!-- /header -->
    <main id="renderBody">
        <div class="container">
            <h3><i class="fa fa-user-circle-o" aria-hidden="true"></i> Bienvenido <?=$_SESSION["UserName"]?></h3>
        </div>
    </main>
    <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-offset-8 col-md-4">
                    <div class="text-right">
                        <b>Ultima Conexion: <?=$_SESSION["dtUltimaConexion"]?></b>
                        <p>
                            <?=$_SESSION["vcCorreo"]?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script id="loadingView" type="text/x-handlebars-template">
        <div class="loadingView">
            <div class="loadingView-title">Cargando</div>
        </div>
    </script>
    <script id="tmp-error500" type="text/x-handlebars-template">
        <div class="error500">
            <div class="error500-content">
                <img src="img/comment.svg" alt="error500">
                <div class="error500-text">Error de comunicaciones.</div>
                <button type="button" class="btn lastView">Volver</button>
            </div>
        </div>
    </script>
    <script id="tmp-options" type="text/x-handlebars-template">
        <option value="" disabled selected>Seleccione una opcion</option>
        {{#each this}}
        <option value="{{value}}">{{text}}</option>
        {{/each}}
    </script>
    <script async src="https://use.fontawesome.com/9ca1c43714.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
    <script src="js/jquery.linq.js"></script>
    <script src="js/handlebars-v4.0.5.js"></script>
    <script src="js/Core.handlebars.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/material.min.js"></script>
    <script src="js/ripples.min.js"></script>
    <script src="js/bootstrap-table.min.js"></script>
    <script src="js/select2.min.js"></script>
    <script src="js/sweetalert2.min.js"></script>
    <script src="js/dropzone.js"></script>
    <script src="js/Terrenos.js"></script>
    <script src="js/Asesores.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
