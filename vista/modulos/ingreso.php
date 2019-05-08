<?php
ob_start();

?>
<div id="bloque-contenedor-ingreso">
<?php
if(isset($_GET["action"])){

	if($_GET["action"] == "activacion_exitosa"){

		echo '
				<div id="mensaje">
					<div class="mensaje">
						<span>Tu cuenta fue correctamente activada puedes ingresar</span>
					</div>
				</div>
			';
		#header("location:usuario");
	
	}
	if($_GET["action"] == "fallo"){

		echo '
				<div id="mensaje">
					<div class="mensaje">
						<span>Tu usuario o contraseña no coinciden vuelve a intentarlo</span>
					</div>
				</div>
			';
		#header("location:usuario");
	
	}

}
?>
	<div class="bloque-ingreso">
	<h1>Ingrese a su cuenta</h1>
		<form method="post">
			<label for="usuarioRegistro">Usuario o Correo</label>
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
$ingreso -> ingresoUsuarioController();

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