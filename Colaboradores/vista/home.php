<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<title>Anegociar</title>
	<link rel="icon" type="image/png" href="vista/temas/imagenes/favicon.ico" />
	<link rel="stylesheet" href="vista/temas/css/estilos.css">
	<link rel="stylesheet" href="vista/temas/css/estilosR.css">
	<link rel="stylesheet" href="vista/temas/css/estilos-preliminares.css">
	<style></style>
	<script type="text/javascript" src="vista/temas/js/jquery-1.4.1.min.js"></script>
	<script src="vista/temas/js/jquery-3.0.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
 	<script>
		$(function() {
		  var pathname = window.location.pathname;
		  var getLast = pathname.match(/.*\/(.*)$/)[1];
		  var truePath = getLast.replace(".php","");

		  if(truePath === '') {
		    $('body').attr('id', 'index');
		  }
		  else {
		    $('body').attr('id', truePath);
		  }
		});
	</script>
</head>
<body>
		<?php
			include "temas/header.php";
		?>
		<?php
			include "temas/navegacion.php";
		?>
	<aside>
	</aside>
	<section>
		<div id="contenedor">
			<div id="contenido">
				<?php 

				$mvc = new EnlacesController();
				$mvc -> enlacesPaginasController();
				 ?>
			</div>
		</div>
	</section>
	<footer>
		<?php
			include "temas/footer.php";
		?>
	</footer>
<!-- <script src="views/js/validarRegistro.js"></script>
<script src="views/js/validarIngreso.js"></script>
<script src="views/js/validarCambio.js"></script> -->
	
</body>

</html>