
<div id="bloque-contenedor-categoria-vehiculos">
    <h1>Ultimos Vehiculos</h1>
    <div class="bloque-contenedor-categoria-vehiculos">
        <?php
        $categorias_y_subcategorias_inicio = new GestorCategoriasController();
        $categorias_y_subcategorias_inicio -> mostrarClasificadosPorCategoriaVehiculosController();
        ?>
    </div>
    </div>
</div>
<div id="bloque-contenedor-categorias">
	<div class="bloque-contenido-categorias">
		<div class="contenido-categorias">
			<h1>Encuentra todo lo que buscas en un solo lugar</h1>
			<?php
				$categorias_y_subcategorias_inicio = new GestorCategoriasController();
				$categorias_y_subcategorias_inicio -> MostrarCategoriasYSubcategoriasController();
			?>
		</div>
	</div>
</div>
