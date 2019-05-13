<?php
ob_start();
?>
<?php
if (($_GET["action"] == "inicio") OR ($_GET["action"] == "ver_clasificado")) {
    ?>
    <nav>
        <div id="header">
            <div class="logo">
                <picture>
                    <a href="inicio"><img src="vista/temas/img/logo.png" alt="Anegociar"/></a>
                </picture>
            </div>
        </div>
        <div id="menu">
            <div id="menu-superior">
                <div class="menu-usuario">
                    <?php
                    session_start();
                    if (isset($_SESSION["user_inmobiliaria"])) {
                        echo '<div class="nombre-usuario">
                            <li>Hola: <a href="principal">' . $_SESSION["usuarioConce"] . '</a></li>
                        </div>
                        <div class="usuario">
                            <i class="fas fa-user"></i>
                            <li><a href="principal">Mi Cuenta</a></li>
                            <li><a href="salir">Salir</a></li>
                        </div>';
                    } else {
                        echo '
                        <div class="nombre-usuario">
                            <li>Hola</li>
                        </div>
                        <div class="cuenta-usuario">
                            <i class="fas fa-user"></i>
                            <li><a href="registro">Registro</a></li>
                            <li><a href="ingreso"> / Ingreso</a></li>
                        </div>';
                    }
                    ?>
                </div>
                <div class="menu-vender">
                    <li>
                        <a href="crear_anuncio">
                            <i class="fas fa-mouse-pointer"></i> Vender
                        </a>
                    </li>
                </div>
            </div>

            <?php

            header("Cache-Control: no cache");
            session_cache_limiter("private_no_expire");

            ?>
            <div id="nuscador">
                <form action="buscar" method="post">
                    <select name="cat" class="nombrecategoria">
                        <!-- <option disabled value="" selected hidden>--Cualquiera--</option> -->
                        <option value="">--Cualquiera--</option>
                        <option value="Vehiculos">Vehiculos</option>
                    </select>
                    <input type="text" placeholder="¿Que estas Buscando?" name="buscarpalabraanuncio"
                           id="buscarpalabraanuncio" autocomplete="off" required="">
                    <button type="submit" id="buscaranuncio" name="buscaranuncio" value="" class="btn-link">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </form>
            </div>

            <div id="menu-principal">
                <div class="menu-principal">
                    <label for="show-menu" class="show-menu">Mostrar Menu</label>
                    <input type="checkbox" id="show-menu" role="button">
                    <ul id="menu">
                        <li>
                            <a href="inicio">
                                <i class="fas fa-home"></i> Inicio
                            </a>
                        </li>
                        <li>
                            <a href="nosotros">
                                <i class="fas fa-address-card"></i> Nosotros</a>
                        </li>
                        <li>
                            <a href="servicios">
                                <i class="fas fa-clipboard-list"></i> Servicios</a>
                        </li>
                        <li>
                            <a href="revista">
                                <i class="far fa-newspaper"></i> Revista
                            </a>
                        </li>
                        <li>
                            <a href="contactenos">
                                <i class="fas fa-envelope"></i> Contáctenos</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <?php
} else if ((($_GET["action"]) != "inicio") && (($_GET["action"]) != "ingreso")) {
    ?>

    <nav>
        <header id="header-principal" class="">
            <div id="logo">
                <picture>
                    <a href="inicio"><img src="vista/temas/img/logo.png" alt="Anegociar"/></a>
                </picture>
            </div>
        </header>
        <div id="menu-principal">
            <div class="menu-principal">

                <ul>
                    <!--<li><a href="index.php?action=inicio" title="">Inicio</a></li>-->
                    <li><a href="principal" title="">Principal</a></li>
                    <li><a href="elije_tipo_anuncio">Anuncios Web</a></li>
                    <li><a href="ultimas_publicaciones">Publicaciones Web</a></li>
                    <li><a href="ultimos_movimientos">Saldos y Movimientos</a></li>
                </ul>
            </div>
        </div>
        <div id="menu-agente">
            <?php
            session_start();
            if (isset($_SESSION["user_concesionaria"])) {

                echo '<div class="menu-usuario-agente">
                                <ul>
                                    <li><a class="menu-hola" href="usuario">' . 'Hola:' . $_SESSION["usuarioINM"] . '</a>
                                        <ul>
                                            <li><a class="enlace-micuenta" href="usuario">Mi Cuenta</a></li>
                                            <li class="divider" role="presentation"></li>
                                            <li><a class="enlaca-salir" href="salir">Salir</a></li>
                                        </ul>
                                    </li>
                                </ul>
                              </div>
                              ';

            } else {
                echo '
                            <div class="nombre-usuario">
                                <li>Hola: </li>
                            </div>
                            ';
            }
            ?>
        </div>
    </nav>

    <?php
} else {
    #echo "no mostrar menu";
}
?>
<style>

    nav {
        background: #F6AA05;
    }
</style>
