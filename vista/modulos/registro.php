<?php
ob_start();
?>
<div id="bloque-contenedor-registro">
<?php
if(isset($_GET["action"])){

	if($_GET["action"] == "registro_exitoso"){

		echo '
				<div id="mensaje">
					<div class="mensaje">
						<span>Usted se registro correctamente, se le envio un correo para poder activar su cuenta </span>
					</div>
				</div>
			';
		#header("location:usuario");
	
	}

}
?>
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

<style type="text/css">
.pop-up {
  position: absolute;
  top: 0;
  left: -500em;
}
.pop-up:target {
  position: static;
  left: 0;
}
.popBox {
  background-color: #fff;

  /* alternatively fixed width / height and negative margins from 50% */
  position: absolute;
  left: 30%;
  right: 30%;
  top: 30%;
  bottom: 30%;
  z-index: 6;
  border: 1px solid #3a3a3a;
  /*border-radius: 0.25rem;*/
  border-radius: 5px;
  box-shadow: 0 0.5rem 0.5rem rgba(0, 0, 0, 0.5);
  opacity: 0;
  transition: opacity 0.5s ease-out;
	max-height: 200px;
}
:target .popBox {
  position: fixed;
  opacity: 1;
}
.popBox:hover {
  box-shadow: 0 0 0.5rem 0.5rem rba(255, 0, 0, 0.5);
}
.lightbox {
  display: none;
  text-indent: -200em;
  background-color: rgba(0,0,0,.4);
  width: 100%;
  height: 100%;
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  z-index: 5;
}
:target .lightbox {
  display: block;
}
.close:link,
.close:visited {
  position: absolute;
  top: -0.75em;
  right: -0.75em;
  display: block;
  width: 2em;
  height: 2em;
  line-height: 1.8;
  padding: 0;
  text-align: center;
  text-decoration: none;
  background-color: #000;
  border: 2px solid #fff;
  color: #fff;
  border-radius: 50%;
  box-shadow: 0 0 .5rem .5rem rba(0,0,0,.5);
}
.close:before {content:"X";}
.close:hover,
.close:active,
.close:focus {
  box-shadow: 0 0 .5rem .5rem rba(255,0,0,.5);
  background-color: #c00;
  color: #fff;
}
.close span {
  text-indent: -200em;
  display: block;
}
.popScroll {
  position: absolute;
  top: 1rem;
  left: 1rem;
  right: 1rem;
  bottom: 1rem;
  overflow-y: auto;
  *overflow-y: scroll;
  padding-right: 0.5em;
}
</style>

<div id="pop2" class="pop-up">
  	<div class="popBox">
    	<div class="popScroll">
      	<h2>Anegociar peru</h2>
      		<p>Anegociar peru se creo con la intencion de que cualquier persona pueda publicar de manera gratuita cualquier anuncio que tenga.</p>
    	</div>
    	<a href="#links" class="close"><span>Close</span></span></a>
  	</div>
  	<a href="#links" class="lightbox">Back to links</a>
</div>
<!-- <script src="vista/temas/js/validarRegistro.js"></script> -->
<?php

//Librerías para el envío de mail
include_once('vista/librerias/class.phpmailer.php');
include_once('vista/librerias/class.smtp.php');

$registro = new GestorUsuariosController();
$registro -> registroUsuarioController();

/*
if(isset($_GET["action"])){

	if($_GET["action"] == "registro_exitoso"){

		echo "Registro Exitoso";
		#header("location:usuario");
	
	}

}
*/
ob_end_flush();
?>
