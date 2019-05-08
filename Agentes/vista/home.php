<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<title>Anegociar</title>
	<link rel="icon" type="image/png" href="../vista/temas/img/favicon.ico" />
	<link rel="stylesheet" href="vista/temas/css/estilos.css">
	<link rel="stylesheet" href="vista/temas/css/estilosR.css">
	<link rel="stylesheet" href="vista/temas/css/estilos-preliminares.css">
	<style></style>
	<script type="text/javascript" src="vista/temas/js/jquery-1.4.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.2.0/js/all.js" 
		integrity="sha384-4oV5EgaV02iISL2ban6c/RmotsABqE4yZxZLcYMAdG7FAPsyHYAPpywE9PJo+Khy" crossorigin="anonymous"></script>
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
<div id="app">
</div>
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
</div>
</body>
</html>
