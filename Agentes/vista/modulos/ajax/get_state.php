<?php
#include('dbconfig.php');
include('../../../modelo/dbconfig.php');

if($_POST['id'])
{
	$id=$_POST['id'];
		
	$stmt = $DB_con->prepare("SELECT * FROM Tprovincias WHERE iddepartamento=:id");
	$stmt->execute(array(':id' => $id));
	?>
	<option selected="selected">Provincia:</option>
	<?php while($row=$stmt->fetch(PDO::FETCH_ASSOC))
	{
		?>
        	<option value="<?php echo $row['idprovincia']; ?>"><?php echo $row['nombreprovincia']; ?></option>
        <?php
	}
}
?>