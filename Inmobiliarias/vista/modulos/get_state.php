<?php
#include('dbconfig.php');
include('../../modelo/dbconfig.php');

if($_POST['id'])
{
	$id=$_POST['id'];
	$stmt = $DB_con->prepare("SELECT * FROM Tprovincias WHERE iddepartamento=:id");
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	// $stmt->execute(array(':id' => $id));
	$stmt->execute();
	
	?>
	<option disabled value="" selected hidden>--Provincia--</option>
	<?php while($row=$stmt->fetch(PDO::FETCH_ASSOC))
	{
		echo '<option value="'. $row['idprovincia'] . '"> '. $row['nombreprovincia'].' </option>';
	}
}
?>