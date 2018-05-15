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
    <link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <div id="login-container">
        <div id="login">
            <a id="logo" href="#" title="LOGO">
                <img src="img/logoHeader.png" alt="LOGO">
            </a>
            <form id="frm-login" class="form-horizontal" action="Controllers/LoginController.php" method="post">
                <div class="form-group">
                    <label for="vcCorreo" class="control-label col-md-3">Correo</label>
                    <div class="col-md-9">
                        <input type="email" name="vcCorreo" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="vcPassword" class="control-label col-md-3">Contraseña</label>
                    <div class="col-md-9">
                        <input type="password" name="vcPassword" class="form-control" required>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-login">Entrar</button>
                </div>
            </form>
        </div>
    </div>
    <script async src="https://use.fontawesome.com/9ca1c43714.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/material.min.js"></script>
    <script src="js/ripples.min.js"></script>
    <script src="js/sweetalert2.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
