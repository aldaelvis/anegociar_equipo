<div id="bloque-contenido-clasificados-categorias">
	<div class="anuncios-por-categorias">
<?php
	
	$crearArticulo = new GestorAnunciosController();
	#$crearArticulo -> guardarImagenController();
	$crearArticulo -> buscarClasificadoController();

?>
	</div>
</div>

<?php
if(isset($_GET["action"])){

	if($_GET["action"] == "clasificado_exitoso"){

		echo "Clasificado Exitoso si se guarda";
		#header("location:usuario");
	
	}

}

?>