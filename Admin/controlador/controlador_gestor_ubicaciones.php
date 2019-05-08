<?php

class GestorUbicacionesController{

	#SELECTLIST DE CREAR ANUNCIOS LISTAS CATEGORIAS
	#------------------------------------
	public function vistaAnunciosUbicacionController(){

		$respuesta = GestorUbicacionesModel::vistaCrearAnunciosUbicacionModel("Tdepartamentos");

		$categoria = $_GET["cat"];
		echo $categoria;
		foreach($respuesta as $row => $item){
			#echo '<a href="index.php?action=lima&id=vehiculos&ubi='.$item["nombredepartamento"].'">'.$item["nombredepartamento"].'</a>';

			#echo $item["nombredepartamento"];
			echo '<br/><a href="index.php?action=ubicacion_clasificados&cat='.$categoria.'&dep='.$item["nombredepartamento"].'">'.$item["nombredepartamento"].'</a>';
			#echo '<br/>'.$item["nombredepartamento"];

		}
	}

	public function mostrarClasificadosPorUbicacionController(){

		$datosController = $_GET["cat"];
		$datosController2 = $_GET["dep"];
		// $prueba = $datosController.$datosController2;
		//echo $datosController;
		//echo $datosController2;
		// echo $prueba;

		$respuesta = GestorUbicacionesModel::mostrarClasificadosPorUbicacionModel($datosController, $datosController2, "Tclasificados");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
		
		foreach($respuesta as $row => $item){
		
		echo'
				<div class="vista-vehiculos">
		 			<div class="vista-campos">
						<div class="vista-campo-imagen">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificado"].'">
							<img src="'.$item["imagen"].'" class="img-thumbnail">
							</a>							
						</div>
						<div class="vista-campo-titulo">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificado"].'">
							<h1>'.$item["titulo"].'</h1>
							</a>
						</div>
						<div class="vista-campo-tipo-moneda">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificado"].'">
							<p>'.$item["tipo_moneda"].'</p>
							</a>
						</div>
						<div class="vista-campo-precio">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificado"].'">
							<p>'.$item["precio"].'</p>
							</a>
						</div>
						<div class="vista-campo-descripcion">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificado"].'">
							<p>'.$item["descripcion"].'</p>
							</a>
						</div>
						<div class="vista-campo-fecha-creacion">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificado"].'">
							<p>'.$item["fechacreacion"].'</p>
							</a>
						</div>
					</div>
				</div>
			';
		}
	}
}