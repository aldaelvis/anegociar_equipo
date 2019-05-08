<?php
#include('dbconfig.php');
include('../../modelo/dbconfig.php');
if($_POST['id'])
{
	$id=$_POST['id'];
		
	$stmt = $DB_con->prepare("SELECT * FROM Tmodelos WHERE idmarca=:id");
	$stmt->execute(array(':id' => $id));
	?>
	<option disabled value="" selected hidden>Elija un modelo</option>
	<?php
	while($row=$stmt->fetch(PDO::FETCH_ASSOC))
	{
		?>
        	<!-- <option value="<?php //echo $row['idmodelo']; ?>"><?php //echo $row['nombre_modelo']; ?></option> -->
        	<!-- <option value="<?php //echo $row['nombre_modelo']; ?>"></option> -->
        	<option value="<?php echo $row['nombre_modelo']; ?>"></option>
        <?php
	}
}
?>