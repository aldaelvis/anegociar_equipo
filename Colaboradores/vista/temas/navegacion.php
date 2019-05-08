<?php
if (isset($_GET["action"])) {

    if ($_GET["action"] == "ingreso") {
    } else {
        ?>
        <nav>
            <header id="header" class="">
                <div id="logo">
                    <picture>
                        <a href="inicio"><img src="vista/temas/img/logo.png" alt="Anegociar" /></a>
                    </picture>
                </div>
            </header>
            <div id="menu-principal">
                <div class="menu-principal">
                    <ul>
                        <li><a href="inicio" title="">Principal</a></li>
                        <li><a href="elije_tipo_anuncio">Anuncios Web</a></li>
                        <li><a href="ultimas_publicaciones">Publicaciones Web</a></li>
                        <li><a href="ultimos_movimientos">Saldos y Movimientos</a></li>
                    </ul>
                </div>
            </div>
            <div id="menu-agente">
                <?php
                session_start();
                if (isset($_SESSION["user_colaborador"])) {
                    #$role = $_SESSION['nombre_rol'];
                    #if(isset($_SESSION['nombre_rol'])==="agente"){
                    #if(isset($_SESSION["agente"], $_SESSION["nombre_rol"]) && $_SESSION["nombre_rol"] == 'agente'){
                    echo '<div class="menu-usuario-agente">
			  					<ul>
									<li><a class="menu-hola" href="usuario">' . 'Hola:' . $_SESSION["usuarioCol"] . '</a>
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
    }

}
?>