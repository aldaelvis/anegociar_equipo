<?php
	#include_once 'dbconfig.php';
	include_once 'modelo/dbconfig.php';

?>
<script type="text/javascript" src="vista/modulos/jquery-3.3.1.min.js">
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#loding1").hide();
        $("#loding2").hide();
        $(".ubicacioncrearanunciodep").change(function() {
            $("#loding1").show();
            var id = $(this).val();
            var dataString = 'id=' + id;
            //$(".ubicacioncrearanunciop").find('option').remove();
            //$(".ubicacioncrearanunciod").find('option').remove();
            $.ajax({
                type: "POST",
                url: "./vista/modulos/get_state.php",
                data: dataString,
                cache: false,
                success: function(html) {
                    $("#loding1").hide();
                    $(".ubicacioncrearanuncioprov").html(html);
                    
                }
            });
        });


        $(".ubicacioncrearanuncioprov").change(function() {
            $("#loding2").show();
            var id = $(this).val();
            var dataString = 'id=' + id;

            $.ajax({
                type: "POST",
                url: "vista/modulos/get_city.php",
                data: dataString,
                cache: false,
                success: function(html) {
                    $("#loding2").hide();
                    $(".ubicacioncrearanunciodis").html(html);
                }
            });
        });

    });
</script>

<div class="ubicaciondepartamento">
    <label for="ubicacioncrearanuncio"> <span></span></label>
    <select name="ubicacioncrearanunciodep" class="ubicacioncrearanunciodep" required>
        <option disabled value="" selected hidden>--Departamento--</option>
        <?php
				$sql = "SELECT * FROM Tdepartamentos";
				$stmt = $DB_con->prepare($sql); // Prevent MySQl injection. $stmt means statement
				$stmt->execute();
				while($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					?>
        <option value="<?php echo $row['iddepartamento']; ?>">
            <?php echo $row['nombredepartamento']; ?>
        </option>
        <?php
				} 
			?>
    </select>
</div>
<div class="ubicacionprovincia">
    <label for="ubicacioncrearanuncio"> <span></span></label>
    <select name="ubicacioncrearanuncioprov" class="ubicacioncrearanuncioprov" required>
        <option disabled value="" selected hidden>--Provincia--</option>
    </select>
    <!-- <img src="vista/modulos/ajax-loader.gif" id="loding1"></img> -->
</div>
<div class="ubicaciondistrito">
    <label for="ubicacioncrearanuncio"> <span></span></label>
    <select name="ubicacioncrearanunciodis" class="ubicacioncrearanunciodis" required>
        <option disabled value="" selected hidden>--Distrito--</option>
    </select>
    <!-- <img src="vista/modulos/ajax-loader.gif" id="loding2"></img> -->
</div>