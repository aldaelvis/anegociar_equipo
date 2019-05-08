<?php
session_start();

	if($_SESSION["user_colaborador"]){

  		header("location:inicio");

  		exit();
	}
?>
<?php
ob_start();
?>
<div id="bloque-contenedor-ingreso">
	<div class="bloque-ingreso">
		<div id="logo-ingreso">
			<picture>
				<img src="vista/temas/img/pagina/usuarios/agentes/logo_colaboradores.png" alt="Anegociar" />
			</picture>
		</div>
	<h1>Ingresar</h1>
		<form method="post">
			<label for="usuarioRegistro">Usuario</label>
			<input type="text" placeholder="Usuario" name="usuarioIngreso" required>

			<label for="passwordRegistro">Contraseña</label>
			<input type="password" placeholder="Contraseña" name="passwordIngreso" required>

			<div class="boton-enviar-ingreso">
				<input type="submit" value="Enviar">
			</div>
		</form>
	</div>
</div>

<?php

$ingreso = new GestorUsuariosController();
$ingreso -> ingresoUsuarioAgenteController();

/*
if(isset($_GET["action"])){

	if($_GET["action"] == "fallo"){

		echo "Fallo al ingresar";
	
	}

	if($_GET["action"] == "fallo3intentos"){

		echo "Ha fallado 3 veces para ingresar, favor llenar el captcha";
	
	}

}
*/
?>

		<?php
ob_end_flush();
?>