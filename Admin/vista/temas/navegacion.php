<?php
if(isset($_GET["action"])){

	if($_GET["action"] == "ingreso"){

		#echo "Tu cuenta fue correctamente activada ahora puedes inngresar";
		#header("location:usuario");
	}

	else {
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
						<!--<li><a href="index.php?action=inicio" title="">Inicio</a></li>-->
						<li><a href="principal" title="">Principal</a></li>
						<li><a href="panel_de_administracion" title="">Administracion</a></li>
						<li><a href="panel_de_anuncios">Anuncios</a></li>
						<li><a href="portal_Interacciones">Iteraciones</a></li>
						<li><a href="datos_y_configuraciones">Configuracion</a></li>
					</ul>
			    </div>
			</div>
			<div id="menu-agente">
				<?php 
					session_start();
					if(isset($_SESSION["user_admin"])){
					#$role = $_SESSION['nombre_rol'];
					#if(isset($_SESSION['nombre_rol'])==="agente"){
					#if(isset($_SESSION["agente"], $_SESSION["nombre_rol"]) && $_SESSION["nombre_rol"] == 'agente'){
			  			echo '<div class="menu-usuario-agente">
			  					<ul>
									<li><a class="menu-hola" href="usuario">'.'Hola:'.$_SESSION["usuarioAdmin"].'</a>
										<ul>
											<li><a class="enlace-micuenta" href="usuario">Mi Cuenta</a></li>
											<li class="divider" role="presentation"></li>
											<li><a class="enlaca-salir" href="salir">Salir</a></li>
										</ul>
									</li>
								</ul>
							  </div>
							  ';

						}
					else {
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