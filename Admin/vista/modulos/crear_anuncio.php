<?php
session_start();

    if(!$_SESSION["user_agente"]){
        #echo "inisice session";
        header('location:ingreso');
    }
    else{
        #echo $_SESSION["idusuario"];
    }

?>
<!-- if (/*strcmp*/strcasecmp($capturar_cat_post,$Categoria_vehiculos)==0) { -->

<div id="bloque-contenido-crear-clasificados">
	<div class="bloque-contenido-crear-clasificados">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> <!-- CHANGE THE JQUERY FILE DEPENDING ON THE VERSION YOU HAVE DOWNLOADED -->
<script src="vista/temas/js/cambiar.js"></script>
<?php
ob_start();


session_start(); 

    header("Cache-Control: no cache");
    session_cache_limiter("private_no_expire");

/*
    if(isset($_POST['cat-plan']))
    {
    	$_SESSION['cat-plan']=$_POST['cat-plan'];
    }

	else
	{
		header('location:elije_tipo_anuncio');
	}
	*/

		$capturar_cat_plan_post = filter_input(INPUT_POST, 'cat-plan');
		$separar_valor_cat_plan_post = explode('|', $capturar_cat_plan_post);
		$valor_uno_cat = $separar_valor_cat_plan_post[0];
		$valor_dos_plan = $separar_valor_cat_plan_post[1];

	#if (isset($_POST['plan_crear_anuncio'])&&($_POST['cat_crear_anuncio'])) 

?>
		<div id="crear-anuncio">
		<h1>Crear anuncio</h1>
		<form method="post" enctype="multipart/form-data">
		<!-- <input type="text" id="idcu" name="iducrearanuncio" value="<?php //echo $_SESSION["usuario"];?>" readonly="readonly"> -->

		<div class="caracteristicas">
			<label for="ubicacioncrearanuncio">Categorias<span></span></label>
			<?php
				include "lista_categorias.php";
			?>
		</div>
	
	<div id="show">
	  <!-- ITEMS TO BE DISPLAYED HERE -->
	</div>

		<div class="ubicacion">
			<label for="ubicacioncrearanuncio">Ubicacion<span></span></label>
			<?php
				include "lista_ubicaciones.php";
			?>
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
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
			<label for="imagencrearanuncio">Subir imagen<span></span></label>				
			<input type="file" name="nombreimagen[]" class="btn btn-default" id="gallery-photo-add" accept="image/*"  multiple required>
			<p>Tamaño recomendado: 800px * 400px, peso máximo 2MB</p>
			<div id="arrastreImagenArticulo">
			</div>
			<div class="gallery"></div>
			<script type="text/javascript">
			        $(function() {
			    // Multiple images preview in browser
			    var imagesPreview = function(input, placeToInsertImagePreview) {

			        if (input.files) {
			            var filesAmount = input.files.length;

			            for (i = 0; i < filesAmount; i++) {
			                var reader = new FileReader();

			                reader.onload = function(event) {
			                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
			                }

			                reader.readAsDataURL(input.files[i]);
			            }
			        }

			    };

			    $('#gallery-photo-add').on('change', function() {
			        imagesPreview(this, 'div.gallery');
			    });
			});
    </script>
		</div>
		<div class="celular">	
			<label for="celularcrearanuncio">Tel. Contacto<span></span></label>
			<input type="text" placeholder="Ingrese el numero de su celular" name="celularcrearanuncio" id="celularcrearanuncio"required="">
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
			<input type="submit" id="guardaranuncio" name="guardaranuncio" value="Guardar anuncio" class="btn btn-primary">
		</div>
	</form>
</div>

	<?php
	#}	
	/*
	else
		//echo "Esta vacio el post";
		header("location:elije_tipo_anuncio");
		*/
?>

<?php	
	
	$crearArticulo = new GestorAnunciosController();
	#$crearArticulo -> guardarImagenController();
	$crearArticulo -> guardarClasificadoController();

?>
		<?php
ob_end_flush();
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

<?php

if(isset($_GET["action"])){

	if($_GET["action"] == "clasificado_exitoso"){

		echo "Clasificado Exitoso si se guarda";
		#header("location:usuario");
	
	}

}

?>