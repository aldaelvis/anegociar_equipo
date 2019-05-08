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
	$(".categoriacrearanuncio").change(function()
	{
		$("#loding1").show();
		var id=$(this).val();
		var dataString = 'id='+ id;
		$(".subcategoriacrearanuncio").find('option').remove();
		// $(".ubicacioncrearanunciod").find('option').remove();
		$.ajax
		({
			type: "POST",
			url: "vista/modulos/ajax/get_subcategoria.php",
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
	
		$.ajax
		({
			type: "POST",
			url: "vista/modulos/get_city.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$("#loding2").hide();
				$(".ubicacioncrearanunciod").html(html);
			} 
		});
	});
	
});
</script>
	<div class="categoria">
		<label for="categoriacrearanuncio"> <span></span></label>
		<select name="categoriacrearanuncio" class="categoriacrearanuncio" required >
		<option selected="selected">--Categoria--</option>
			<?php
				$stmt = $DB_con->prepare("SELECT * FROM Tcategorias");
				$stmt->execute();
				while($row=$stmt->fetch(PDO::FETCH_ASSOC))
				{
					?>
			        <option value="<?php echo $row['idcategoria']; ?>"><?php echo $row['nombre_categoria']; ?></option>
			        <?php
				} 
			?>
		</select>
	</div>
	<div class="sub-categoria">
		<label for="subcategoriacrearanuncio"> <span></span></label>
		<select name="subcategoriacrearanuncio" class="subcategoriacrearanuncio" required>
			<option selected="selected">--subcategoria--</option>
		</select>
		<!-- <img src="vista/modulos/ajax-loader.gif" id="loding1"></img> -->
	</div>
