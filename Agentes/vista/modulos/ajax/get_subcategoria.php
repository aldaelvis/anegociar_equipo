<?php
#include('dbconfig.php');
include('../../../modelo/dbconfig.php');
if($_POST['id'])
{
	$id=$_POST['id'];
		
	$stmt = $DB_con->prepare("SELECT * FROM Tsubcategorias WHERE idcategoria=:id");
	$stmt->execute(array(':id' => $id));
	?><option selected="selected">Subcategoria :</option><?php
	while($row=$stmt->fetch(PDO::FETCH_ASSOC))
	{
		?>
        	<option value="<?php echo $row['idsubcategoria']; ?>"><?php echo $row['nombre_subcategoria']; ?></option>
        <?php
	}
}
?>