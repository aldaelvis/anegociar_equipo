<?php
#$text = 'This is an example text, it contains commas and full stops. Exclamation marks, too! Question marks? All punctuation marks you know.';

$text_line = "Poll number 1, 1500, 250, 150, 100, 1000, 10000, hola";
$text_line = explode(",",$text_line);

// echo ( $text_line );  

// echo implode( $text_line );  

// echo '<pre>';
#echo $text_line[1];
// print_r ($text_line);
// echo '</pre>';

echo '<div id="lista">';
foreach($text_line as $x => $value) {
    echo '<li>'.$value.'</li>';
}
?>

<div id="crear-anuncio">
	<h1>Crear anuncio</h1>
	<form method="post" enctype="multipart/form-data">
		<!-- <input type="hidden" id="idcu" name="iducrearanuncio" value="<?php //echo $_SESSION["idusuarios"];?>" readonly="readonly"> -->
	<div class="ubicacion">
			<label for="ubicacioncrearanuncio">Ubicacion<span></span></label>
			<?php
				include "lista_ubicaciones.php";
			?>
		</div>

		<div class="tipo-anuncio">
			<label for="ubicacioncrearanuncio">Categorias<span></span></label>
			<?php
				include "lista_categorias.php";
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
			<label for="imagencrearanuncio">Subir imagen<span></span></label>				
			<input type="file" name="nombreimagen[]" class="btn btn-default" id="files" accept="image/*"  multiple required>
			<!-- onchange="validateFileType()"
			<output id="list"></output> -->
			<p>Tamaño recomendado: 800px * 400px, peso máximo 2MB</p>
			<div id="arrastreImagenArticulo">
			</div>
		</div>
		<!-- <input name="image" type="file" id="fileName" accept=".jpg,.jpeg,.png" onchange="validateFileType()"/> -->
		<!-- <script type="text/javascript">
		    function validateFileType(){
		        var files = document.getElementById("files").value;
		        var idxDot = files.lastIndexOf(".") + 1;
		        var extFile = files.substr(idxDot, files.length).toLowerCase();
		        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
		            //TO DO
		        }else{
		            alert("Only jpg/jpeg and png files are allowed!");
		        }   
		    }
		</script>
		<script type="text/javascript">
	        function handleFileSelect(evt) {
		    var files = evt.target.files;

		    // Loop through the FileList and render image files as thumbnails.
		    for (var i = 0, f; f = files[i]; i++) {

		      // Only process image files.
		      if (!f.type.match('image.*')) {
		        continue;
		      }

		      var reader = new FileReader();

		      // Closure to capture the file information.
		      reader.onload = (function(theFile) {
		        return function(e) {
		          // Render thumbnail.
		          var span = document.createElement('span');
		          span.innerHTML = 
		          [
		            '<img style="height: 75px; border: 1px solid #000; margin: 5px" src="', 
		            e.target.result,
		            '" title="', escape(theFile.name), 
		            '"/>'
		          ].join('');
		          
		          document.getElementById('list').insertBefore(span, null);
		        };
		      })(f);

		      // Read in the image file as a data URL.
		      reader.readAsDataURL(f);
		    }
		  }

		  document.getElementById('files').addEventListener('change', handleFileSelect, false);
		</script> -->
		<div class="celular">	
			<label for="celularcrearanuncio">Tel. Contacto<span></span></label>
			<input type="text" placeholder="Ingrese el numero de su celular" name="celularcrearanuncio" id="celularcrearanuncio" required="">
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