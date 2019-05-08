<?php

class EnlacesController{
	
 	#ENLACES
 	#-------------------------------------
 	public function enlacesPaginasController(){

 		if(isset( $_GET['action'])){
			
 			$enlaces = $_GET['action'];

 			#echo $enlaces;
		
 		}

 		else{

 			$enlaces = "index";
 		}

 		$respuesta = EnlacePaginas::enlacesPaginasModel($enlaces);

 		include $respuesta;

 	}
}
	