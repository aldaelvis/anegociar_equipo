<div id="bloque-elije-plan-clasificado">
	<div class="bloque-elije-plan-clasificado">
		<?php
			$capturaCategoria = $_POST["cat"];
			echo $capturaCategoria;
			//echo '<h1 Style="color:green">Planes de Publicación - '.$capturaCategoria.'</h1>';
		?>
    	<h1>Seleccione un<span style="color: #2196F3;"> Plan de Publicación</span> * Vehiculos * </h1>
		<form method="post" enctype="multipart/form-data" action="crear_anuncio">
			<div class="titulo">
				<input type="hidden" placeholder="" value="<?php echo $_POST["cat"];?>" name="cat_crear_anuncio" id="cat_crear_anuncio">
			</div>
			<div class="Plan">
				<label for="plan_crear_anuncio">Seleccione:<span></span></label>
				<select name="plan_crear_anuncio" id="plan_crear_anuncio"">
					<?php
						//$capturaCategoria = $_GET["cat"];
						//echo '<h1 Style="color:green">Planes de Publicación - '.$capturaCategoria.'</h1>';

						$vistaVehiculos = new GestorPlanesController();
						$vistaVehiculos -> vistaAnunciosPlanesController();
					?>
				</select>
				<div class="enviar">
					<input type="submit" id="validar_plan" value="Siguiente" class="btn btn-primary">
				</div>
			</div>
		</form>
		<?php
			//$capturaCategoria = $_GET["cat"];
			//echo '<h1 Style="color:green">Planes de Publicación - '.$capturaCategoria.'</h1>';
			//$VerPlan = new GestorAnunciosController();
			//$VerPlan -> validarPlanPorCategoriaParaClasificadoController();
		?>

	</div>
</div>