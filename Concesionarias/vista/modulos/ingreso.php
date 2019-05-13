<?php
ob_start();
session_start();
if($_SESSION["user_concesionaria"]){
	header("location:principal");
	exit();
}
?>
<div id="bloque-contenedor-ingreso">
	<div class="bloque-ingreso">
		<div id="logo-ingreso">
			<picture>
				<img src="vista/temas/img/pagina/usuarios/agentes/logo_agentes.png" alt="Anegociar" />
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
GestorUsuariosController::ingresoConcesionariaController();
ob_end_flush();
?>