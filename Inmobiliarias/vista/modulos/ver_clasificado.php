<div id="bloque-contenido-clasificado">

	<div class="contenido-clasificado">
		<link rel="stylesheet prefetch" href="https://cdn.rawgit.com/Pagawa/PgwSlideshow/master/pgwslideshow_light.min.css">
	<link rel="stylesheet prefetch" href="https://cdn.rawgit.com/Pagawa/PgwSlideshow/master/pgwslideshow.min.css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://cdn.rawgit.com/Pagawa/PgwSlideshow/master/pgwslideshow.js"></script>
			<?php
				$vistaVehiculos = new GestorAnunciosController();
				$vistaVehiculos -> mostrarClasificadosController();

			?>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
    $('.pgwSlideshow').pgwSlideshow({
    	transitionEffect:'fading',
      autoSlide: false
	    });
	});
</script>