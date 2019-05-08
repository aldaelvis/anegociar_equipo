<?php
	#include_once 'dbconfig.php';
	include_once 'modelo/dbconfig.php';
?>
<script type="text/javascript" src="vista/modulos/jquery-1.4.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
	$("#loding1").hide();
	$("#loding2").hide();

	$(".marca-modelo").hide();

	$(".categoriacrearanuncio").change(function()
	{
		$("#loding1").show();
		var id=$(this).val();
		var dataString = 'id='+ id;

			if (id === '1|Vehiculos') {
				$('.marca-modelo').show();
				$('.marcas').show();
				$('.modelos').show();
			}
			if (id != '1|Vehiculos') {
				$(".marca-modelo").hide();
				$(".marcas").hide();
				$(".modelos").hide();
			}

		$(".subcategoriacrearanuncio").find('option').remove();
		// $(".ubicacioncrearanunciod").find('option').remove();
		$.ajax
		({
			type: "POST",
			url: "vista/modulos/get_subcategoria.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$("#loding1").hide();
				$(".subcategoriacrearanuncio").html(html);
			} 
		});
	});
	
	$(".subcategoriacrearanuncio").change(function()
	{
		$("#loding2").show();
		var id=$(this).val();
		var dataString = 'id='+ id;
		$(".marcacrearanuncio").find('option').remove();
		// $(".ubicacioncrearanunciod").find('option').remove();
		$.ajax
		({
			type: "POST",
			url: "vista/modulos/get_marca.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$("#loding2").hide();
				$(".marcacrearanuncio").html(html);
			} 
		});
	});

	$(".marcacrearanuncio").change(function()
	{
		$("marcacrearanuncio").show();
		var id=$(this).val();
		var dataString = 'id='+ id;
		// $('.modelo').find('input:text').val('');
		$(".modelocrearanuncio").find('option').remove();
		// $(".modelo").val(" ");
		$(".modelo").attr("placeholder", "Escribe o selecciona").val("").focus().blur();
		$.ajax
		({
			type: "POST",
			url: "vista/modulos/get_modelo.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				// $(".marcacrearanuncio").hide();
				$(".modelocrearanuncio").html(html);
			} 
		});
	});
	
	
});
</script>
	<div class="categoria">
		<label for="categoriacrearanuncio"> <span></span></label>
		<select name="categoriacrearanuncio" class="categoriacrearanuncio" id="categoriacrearanuncio" required >
		<option disabled value="" selected hidden>--Categoria--</option>
			<?php
				$stmt = $DB_con->prepare("SELECT * FROM Tcategorias");
				$stmt->execute();
				while($row=$stmt->fetch(PDO::FETCH_ASSOC))
				{
					?>
			        <option value="<?php echo $row['idcategoria'].'|'.$row['nombre_categoria'];?>"><?php echo $row['nombre_categoria']; ?>
			        </option>
			        <?php
				} 
			?>
		</select>
	</div>
	<div class="sub-categoria">
		<label for="subcategoriacrearanuncio"> <span></span></label>
		<select name="subcategoriacrearanuncio" class="subcategoriacrearanuncio" required>
			<option disabled value="" selected hidden>--Subcategoria--</option>
		</select>
		<!-- <img src="vista/modulos/ajax-loader.gif" id="loding1"></img> -->
	</div>

	<div class="marca-modelo">
	<label for="marcacrearanuncio">Marca / Modelo<span></span></label>
	<div class="marcas">
		<label for="marcacrearanuncio"> <span></span></label>
		<select name="marcacrearanuncio" class="marcacrearanuncio">
			<!-- <option selected="selected"></option> -->
			<option disabled value="" selected hidden>Elije una subcategoria antes</option>
		</select>
		<!-- <img src="vista/modulos/ajax-loader.gif" id="loding1"></img> -->
	</div>

	<div class="modelos">
		<label for="modelocrearanuncio"> <span></span></label>
		<input list="modelocrearanuncio" name="modelo" class="modelo" placeholder="Escribe o selecciona" autocomplete="off" style="width:150px;">
 		<datalist id="modelocrearanuncio" name="modelo" class="modelocrearanuncio">
		<!-- <select name="modelocrearanuncio" class="modelocrearanuncio" required> -->
			<option disabled value="" selected hidden>Debe elegir una marca</option>
		</datalist>
		<!-- </select> -->
		<!-- <img src="vista/modulos/ajax-loader.gif" id="loding1"></img> -->
	</div>

<!-- <style>
    .año input::-webkit-datetime-edit-month-field,
    ::-webkit-datetime-edit-day-field,
    ::-webkit-datetime-edit-text {
      display:none;
    }
  </style> -->
	<div class="año">
		<label for="fabricacioncrearanuncio"> <span></span></label>
		<input type="number" name="fabricacioncrearanuncio" class="fabricacioncrearanuncio" placeholder="Año" maxlength="4" min="1950" max="2018">
	</div>

	</div>