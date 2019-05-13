<div id="bloque-contenido-clasificados-categorias">
<?php  
    $captura_Categoria = $_GET["cat"];
    #echo $captura_Categoria;
    if ($captura_Categoria=="inmuebles") {
        echo ' ';
    }
?>
	<div class="bloque-ubicaciones-categoria">
		<div class="ubicaciones-categoria">
			<div class="ubicaciones-por-anuncio">
				<?php
					
					$vistaUbicacionVehiculos = new GestorUbicacionesController();
					$vistaUbicacionVehiculos -> mostrarUbicacionesPorCategoriasYSubcategoriasController();
				?>
			</div>
			<div class="anuncios-por-categorias">
				<!--<h1>vehiculos</h1>-->

				<?php
					$vistaVehiculos = new GestorCategoriasController();
					$vistaVehiculos -> mostrarClasificadosPorTipoCategoriaController();
				?>
			</div>
		</div>
	</div>
</div>

