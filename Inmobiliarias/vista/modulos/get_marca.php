<?php
#include('dbconfig.php');
include('../../modelo/dbconfig.php');
if($_POST['id'])
{
	$id=$_POST['id'];
		
	$stmt = $DB_con->prepare("SELECT * FROM Tmarcas WHERE idsubcategoria=:id");
	$stmt->execute(array(':id' => $id));
	?>
	<!-- <option selected="selected"></option> -->
	<option disabled value="" selected hidden>Elija una opcion</option>
	<?php
	while($row=$stmt->fetch(PDO::FETCH_ASSOC))
	{
		?>
        	<option value="<?php echo $row['idmarca']; ?>"><?php echo $row['nombre_marca']; ?></option>
        <?php
	}
}
?>