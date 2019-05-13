<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
    <title>Anegociar</title>
    <link rel="icon" type="image/png" href="vista/temas/img/favicon.ico"/>
    <link rel="stylesheet" href="vista/temas/css/estilosR.css">
    <link rel="stylesheet" href="vista/temas/css/estilos-preliminares.css">
    <script defer src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"
            integrity="sha384-4oV5EgaV02iISL2ban6c/RmotsABqE4yZxZLcYMAdG7FAPsyHYAPpywE9PJo+Khy"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="vista/temas/css/responsive.css">
    <link rel="stylesheet" href="vista/temas/css/estilos.css">
    <!--    core vuejs-->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <!--    fin vuejs core-->
    <script type="text/javascript" src="vista/temas/js/jquery-3.0.0.min.js"></script>
    <script>
        $(function () {
            var pathname = window.location.pathname;
            var getLast = pathname.match(/.*\/(.*)$/)[1];
            var truePath = getLast.replace(".php", "");

            if (truePath === '') {
                $('body').attr('id', 'index');
            }
            else {
                $('body').attr('id', truePath);
            }
        });
    </script>
</head>
<body>
<header id="" class="">
    <?php
    include "temas/header.php";
    ?>
</header>
<?php
include "temas/navegacion.php";
?>
<aside>
    <?php
    if ($_GET["action"] == "inicio" OR $_GET["action"] == "") {

        #echo "Tu cuenta fue correctamente activada ahora puedes inngresar";
        #header("location:usuario");
        include "temas/slider.php";
    } else {
    }
    #}
    ?>
</aside>
<main>
    <div id="contenedor">
        <div id="contenido">
            <?php

            $mvc = new EnlacesController();
            $mvc->enlacesPaginasController();
            ?>
        </div>
    </div>
</main>
<footer>
    <?php
    include "temas/footer.php";
    ?>
</footer>
<script type="text/javascript" src="vista/temas/js/validarRegistro.js"></script>
</body>
</html>