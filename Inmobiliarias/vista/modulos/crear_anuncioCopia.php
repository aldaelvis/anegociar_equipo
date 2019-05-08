<?php
session_start();

	if(!$_SESSION["validar"]){

		header("location:ingresar");

		exit();

	}
?>
<div id="crear-anuncio">
	<h1>Crear anuncio</h1>
	<form method="post" enctype="multipart/form-data">
		<input type="hidden" id="idcu" name="iducrearanuncio" value="<?php echo $_SESSION["idusuarios"];?>" readonly="readonly">
		<div class="ubicacion">
			<label for="ubicacioncrearanuncio">Ubicacion<span></span></label>
			<select name="ubicacioncrearanuncio">
				<?php
					$vistaCrearAnunciosUbicacion = new MvcController();
					$vistaCrearAnunciosUbicacion -> vistaCrearAnunciosUbicacionController();
				?>
			</select>
		</div>
		<div class="ubicaciondepartamento">
			<label for="ubicacioncrearanuncio"><span> </span></label>
			<select name="ubicacioncrearanuncio">
				<?php
					$vistaCrearAnunciosUbicacion = new MvcController();
					$vistaCrearAnunciosUbicacion -> vistaCrearAnunciosDepartamentoController();
				?>
			</select>
		</div>
		<div class="ubicacionprovincia">
			<label for="ubicacioncrearanuncio"><span> </span></label>
			<select name="ubicacioncrearanuncio">
				<?php
					$vistaCrearAnunciosUbicacion = new MvcController();
					$vistaCrearAnunciosUbicacion -> vistaCrearAnunciosProvinciaController();
				?>
			</select>
		</div>
		<div class="ubicaciondistrito">
			<label for="ubicacioncrearanuncio"><span> </span></label>
			<select name="ubicacioncrearanuncio">
				<?php
					$vistaCrearAnunciosUbicacion = new MvcController();
					$vistaCrearAnunciosUbicacion -> vistaCrearAnunciosDistritoController();
				?>
			</select>
		</div>
		<div class="categoria">
			<label for="categoriacrearanuncio">Categoria<span></span></label>
			<select name="categoriacrearanuncio">
				<?php
					$vistaCrearAnunciosCategoria = new MvcController();
					$vistaCrearAnunciosCategoria -> vistaCrearAnunciosCategoriaController();
				?>
			</select>
		</div>
		<div class="sub-categoria">
			<label for="subcategoriacrearanuncio"> <span></span></label>
			<select name="subcategoriacrearanuncio">
				<?php
					$vistaCrearAnunciosSubcategoria = new MvcController();
					$vistaCrearAnunciosSubcategoria -> vistaCrearAnunciosSubcategoriaController();
				?>
			</select>
		</div>
		<div class="titulo">
			<label for="titulocrearanuncio">Titulo<span></span></label>
			<input type="text" placeholder="Escriba el titulo de su anuncio" name="titulocrearanuncio" id="titulocrearanuncio" required>
		</div>
		<div class="descripcion">
			<label for="descripcioncrearanuncio">Descripcion<span></span></label>
			<textarea name="descripcioncrearanuncio" id="descripcioncrearanuncio" placeholder="Escriba una descripcion de su anuncio" required></textarea>
		</div>
		<div class="imagen">	
			<label for="imagencrearanuncio">Subir imagen<span></span></label>				
			<input type="file" name="imagen" class="btn btn-default" id="subirFoto" required>
			<p>Tamaño recomendado: 800px * 400px, peso máximo 2MB</p>
			<div id="arrastreImagenArticulo">
			</div>
		</div>
		<div class="tipomoneda">	
			<label for="tipomonedacrearanuncio">Tipo de moneda<span></span></label>
			<select name="tipomonedacrearanuncio">
				<option value="S/.">S/.</option>
				<option value="$">$</option>
				<option value="€">€</option>
			</select>
			<!--<input type="text" placeholder="Ingrese el precio de su anuncio" name="tipomoneda" id="" required>-->
		</div>
		<div class="precio">	
			<label for="preciocrearanuncio">Precio<span></span></label>
			<input type="number" step="any" placeholder="Ingrese el precio de su anuncio" name="preciocrearanuncio" id="preciocrearanuncio" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||  
     event.charCode == 44 || event.charCode == 0 " required>
		</div>

		<div class="enviar">
			<input type="submit" id="guardaranuncio" value="Guardar anuncio" class="btn btn-primary">
		</div>
	</form>
</div>
<?php
	$crearArticulo = new GestorAnunciosController();
	$crearArticulo -> guardarArticuloController();
?>

<div id="consejos">
	<h3>Algunos Consejos</h3>
	<p class="lead" style="font-size: 16px;">
		Publicar y vender en Anegociar es muy simple, pero si sigues estos consejos, tendrás aún más chances de vender rápido:
	</p>
	<ul>
		<li>
			<b>¡Las fotos hablan por si solas!</b><br>
				Un anuncio con fotos recibe hasta 5 veces mas visitas. 
		</li>
		<li>
			<b>¡El precio vende!</b> <br>
				Introduce el precio correcto de tu producto. Si no sabes cuánto pedir por el mismo, te recomendamos buscar productos similares.
		</li>
		<li>
			<b>¡El título atrae!</b> <br>
				Incluye información relevante en el mismo. Los datos infaltables en un buen título son: tipo de producto, marca, modelo.
		</li>
		<li>
			<b>¡La descripción cuenta la historia de tu producto!</b><br>
				Indica todas las características de tu producto: si es usado, si es nuevo, en qué estado se encuentra, qué accesorios trae, etc.
		</li>					
	</ul>
</div>