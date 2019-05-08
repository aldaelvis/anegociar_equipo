<?php
session_start();

    if(!$_SESSION["user_agente"]){
        #echo "inisice session";
        header('location:ingreso');
    }
    else{
        #echo $_SESSION["idusuario"];
    }

?>
<div id="bloque-elije-plan-clasificado">
	<div class="bloque-elije-plan-clasificado">
		<?php
ob_start();
        
        /*
		 if (isset($_SESSION['val1'])) {
             $algo=$_SESSION['val1'];
             $algo2=$_SESSION['val2'];
             echo $algo;
             echo $algo2;
        }
        */
        header("Cache-Control: no cache");
        session_cache_limiter("private_no_expire");
        if(isset($_POST['cat']))
            {
                $_SESSION['cat']=$_POST['cat'];
            }

            else
            {
                header('location:elije_tipo_anuncio');
            }

            $capturaCategoria = $_POST["cat"];
			echo '<h1>Planes de Publicación - '.$capturaCategoria.'</h1>';

			$vistaVehiculos = new GestorPlanesController();
			$vistaVehiculos -> vistaAnunciosPlanesController();
            
		?>
        </div>
    </div>


<?php

            //$vistaVehiculos = new GestorAnunciosController();
            //$vistaVehiculos -> activarClasificadoController();

?>
        <?php
ob_end_flush();
?>
