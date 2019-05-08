<div id="bloque-contenedor-registro">
	<div class="bloque-registro">
		<h1>Registro de Cuenta Nueva</h1>
		<form method="post" onsubmit="return validarRegistro()">
			
			<label for="usuarioRegistro">Usuario<span></span></label>
			<input type="text" placeholder="Máximo 10 caracteres" maxlength="10" name="usuarioRegistro" id="usuarioRegistro" required>
			<span for="usu_reg"></span>

			<label for="passwordRegistro">Contraseña</label>
			<input type="password" placeholder="Mínimo 6 caracteres, incluir número(s) y una mayúscula" minlength="6" name="passwordRegistro" id="passwordRegistro" required>
			<!-- <input type="password" placeholder="Mínimo 6 caracteres, incluir número(s) y una mayúscula" name="passwordRegistro" id="passwordRegistro" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required> -->

			<label for="emailRegistro">Correo electrónico<span></span></label>
			<input type="email" placeholder="Escriba su correo electrónico correctamente" name="emailRegistro" id="emailRegistro" required>
			<span for="email_reg"></span>
			
			<div class="terminos-condiciones">
				<div class="check-terminos-condiciones">
					<input type="checkbox" id="terminos" required>
				</div>
				<div class="mostrar-terminos-condiciones">
					<p><a href="#pop2">Acepta términos y condiciones</a></p>
				</div>
			</div>

			<div class="boton-enviar-registro">
				<input type="submit" value="Enviar">
			</div>

		</form>
	</div>
</div>

<?php

//Librerías para el envío de mail
// include_once('vista/librerias/class.phpmailer.php');
// include_once('vista/librerias/class.smtp.php');

$registro = new GestorUsuariosController();
$registro -> registroUsuarioController();

?>
