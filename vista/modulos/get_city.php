<?php
#include('dbconfig.php');
include('../../modelo/dbconfig.php');

if($_POST['id'])
{
	$id=$_POST['id'];
	
	$stmt = $DB_con->prepare("SELECT * FROM Tdistritos WHERE idprovincia=:id");
	$stmt->execute(array(':id' => $id));
	?>
	<option disabled value="" selected hidden>--Distrito--</option>
	<?php while($row=$stmt->fetch(PDO::FETCH_ASSOC))
	{
		?>
		<option value="<?php echo $row['iddistrito']; ?>"><?php echo $row['nombredistrito']; ?></option>
		<?php
	}
}
?>