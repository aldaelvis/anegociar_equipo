<h1>Categorías destacadas</h1>
<div class="contenido-categorias-destacadas">

	<div class="anegociar-categorias-destacadas">
		<div class="categorias-destacadas">
			<a href="Vehiculos.html">
			<!-- <a href="index.php?action=categorias_clasificados&cat=Vehiculos"> -->
			<img src="..\vista\temas\img\vehiculos.jpg" alt="anwegociarperu-imagen-categorias" class="img-responsive">
			<h2>Vehiculos</h2>
			</a>
		</div>
	</div>
	<div class="anegociar-categorias-destacadas">
		<div class="categorias-destacadas">
			<a href="Inmuebles.html">
			<img src="..\vista\temas\img\inmuebles.jpg" alt="anwegociarperu-imagen-categorias" class="img-responsive">
			<h2>Inmuebles</h2>
			</a>
		</div>
	</div>
	<div class="anegociar-categorias-destacadas">
		<div class="categorias-destacadas">
			<a href="Empleos.html">
		<img src="..\vista\temas\img\empleos.jpg" alt="anwegociarperu-imagen-categorias" class="img-responsive">
		<h2>Empleos</h2>
			</a>
		</div>
	</div>
	<div class="anegociar-categorias-destacadas">
		<div class="categorias-destacadas">
			<a href="Telefonos - moviles.html">
		<img src="..\vista\temas\img\informatica.jpg" alt="anwegociarperu-imagen-categorias" class="img-responsive">
		<h2>Tecnologia</h2>
			</a>
		</div>
	</div>
</div>
<div id="bloque-contenedor-categoria-vehiculos">
    <h1>Ultimos Vehiculos</h1>
	<?php var_dump($_SESSION); ?>
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
