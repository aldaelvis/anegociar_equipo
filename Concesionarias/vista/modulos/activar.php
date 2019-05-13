<?php

	$vistaVehiculos = new GestorUsuariosController();
	$vistaVehiculos -> activarRegistroUsuarioController();


if(isset($_GET["action"])){

	if($_GET["action"] == "activacion_exitosa"){

		echo "Activacion Exitosa";
		#header("location:usuario");
	
	}

}