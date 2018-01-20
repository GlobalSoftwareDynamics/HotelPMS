<?php
ob_start();
session_start();
// remove all session variables
session_unset();
// destroy the session
session_destroy();
include('login.php'); // Includes Login Script
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GSD HotelPMS</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="apple-touch-icon-precomposed" href="favicon152.png">
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="favicon152.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="favicon144.png">
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="favicon120.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="favicon114.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="favicon72.png">
    <link rel="apple-touch-icon-precomposed" href="favicon57.png">
    <link rel="icon" href="favicon32.png" sizes="32x32">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
</head>
<body>

<section class="login-block">
    <div class="container col-xl-8 col-lg-4 col-md-8 col-11">
        <div class="row">
            <div class="col-12 col-xl-4 login-sec">
                <div id="logo">
                    <img src="img/logo.png" width="200" class="centered">
                </div>
                <h2 class="text-center"></h2>
                <form class="login-form" method="post" action="#">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Usuario</label>
                        <input type="text" class="form-control" placeholder="Usuario" name="username">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Contraseña</label>
                        <input type="password" class="form-control" placeholder="Contraseña" autocomplete="new-password" name="password">
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input">
                            <small>Recordarme</small>
                        </label>
                        <input type="submit" class="btn btn-login float-right" name="submit" value="Iniciar Sesión">
                    </div>
                </form>
            </div>
            <div class="col-12 col-xl-8 d-none d-sm-none d-md-none d-lg-none d-xl-block banner-sec">

            </div>
        </div>
</section>

<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>