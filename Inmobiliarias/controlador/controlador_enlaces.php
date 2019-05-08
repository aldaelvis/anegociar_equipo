<?php

class EnlacesController{
	
 	#ENLACES
 	#-------------------------------------
 	public function enlacesPaginasController(){

 		if(isset( $_GET['action'])){
 			$enlaces = $_GET['action'];
 			#echo $enlaces;
 			echo '<span class="titulo">'.$enlaces.'</span>';
/*
 			if(($_GET['action'])==" "){
 				$enlaces = $_GET['action'];
 				#echo $enlaces;
 				header('location: inicio');
 			}
 			*/
 		}
 		else if(($_GET['action'])==""){
 			$enlaces = $_GET['action'];
 			header('location: inicio');
 		}
 		else{
 			$enlaces = "index";
 		}
 		$respuesta = EnlacePaginas::enlacesPaginasModel($enlaces);
 		include $respuesta;
 	}
}
	