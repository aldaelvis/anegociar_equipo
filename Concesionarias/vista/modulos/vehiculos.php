<!-- <a href="index.php?action=ubicacion_clasificados&id=lima">Lima</a>

<a href="index.php?action=ubicacion_clasificados&id=vehiculos&ubi=cusco">Cusco</a>
-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"> </script>
	<?php
		
		$vistaUbicacionVehiculos = new GestorUbicacionesController();
		$vistaUbicacionVehiculos -> vistaAnunciosUbicacionController();
	?>
 
<!-- <script type="text/javascript" charset="utf-8" async defer>
    $(document).ready(function(){
  var uri = window.location.toString();
  if (uri.indexOf("?") > 0) {
      var clean_uri = uri.substring(0, uri.indexOf("?"));
      window.history.replaceState({}, document.title, clean_uri);
  }
});
</script> -->


<div class="elije-ubicacion-anuncio">
	<h1>¿Que deseas Publicar?</h1>
	<div class="ubicacion">
		<a href="index.php?action=elije_plan_anuncio&id=1" name="tab1" value="elje-tipo-anuncio">
			<img src="vista\temas\imgg\publicacion-vehiculos.png" alt="Icon" class="img-responsive">
		</a>
	</div>
</div>
<div id="contenido-empleos">
	<!--<h1>vehiculos</h1>-->

	<?php
		$vistaVehiculos = new GestorCategoriasController();
		$vistaVehiculos -> mostrarClasificadosVehiculosController();
	?>
</div>


