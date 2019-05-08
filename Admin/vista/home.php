<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<title>Anegociar</title>
	<link rel="icon" type="image/png" href="vista/temas/imagenes/favicon.ico" />
	<link rel="stylesheet" href="vista/temas/css/estilos.css">
	<link rel="stylesheet" href="vista/temas/css/estilosR.css">
	<link rel="stylesheet" href="vista/temas/css/estilos-preliminares.css">
	<link rel="stylesheet" href="vista/temas/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="vista/temas/css/responsive.dataTables.min.css">
	<link rel="stylesheet" href="vista/temas/css/datatable.css">
	<link rel="stylesheet" href="vista/temas/css/alertify.min.css">

	<script src="vista/temas/js/jquery-3.3.1.js"></script>
	<script src="vista/temas/js/jquery.dataTables.min.js"></script>
	<script src="vista/temas/js/dataTables.responsive.min.js"></script>
	<script src="vista/temas/js/alertify.min.js"></script>
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