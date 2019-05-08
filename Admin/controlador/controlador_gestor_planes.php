<?php

class GestorPlanesController{
	
	#ELIJE TU PLAN DE ACUERO ALA CATEGORIA 
	#------------------------------------
	public function mostarPlanesPorCategoriaController(){

		$datosController = $_POST["cat"] OR $datosController =$_GET["cat"];
		$datosController2 = $_GET["dep"];
		// $prueba = $datosController.$datosController2;
		echo 'holaaa'.$datosController;
		#echo $datosController2;
		// echo $prueba;

		$respuesta = GestorPlanesModel::mostrarPlanesporCategoriaModel($datosController, "Tplanes");

		foreach($respuesta as $row => $item){

			echo '<option value='.$item['idplan'].'|'.$item['nombre_plan'].'>'. $item["nombre_plan"] . '</option>';
			#echo '<br/><a href="index.php?action=ubicacion_clasificados&cat='.$categoria.'&dep='.$item["nombredepartamento"].'">'.$item["nombredepartamento"].'</a>';
		}	
	}

	#ELIJE TU PLAN DE ACUERO ALA CATEGORIA 
	#------------------------------------
	public function vistaAnunciosPlanesController(){

		#$datosController = $_POST["cat"];
		$datosController = $_POST["cat"];
		#echo $datosController;

		$datosController2 = $_SESSION["val1"];
		// $prueba = $datosController.$datosController2;
		#echo $datosController;
		#echo $datosController2;
		// echo $prueba;

		$respuesta = GestorPlanesModel::mostrarClasificadosPlanesCategoriaModel($datosController, "Tplanes");

		// $Plan1 = '1'OR'Premiun';
		// $Plan2 = '2'OR'Destacado';
		// $Plan3 = '3'OR'SIMPLE'OR'Simple'OR'simple';
		// $Plan4 = '4'OR'Gratis';

		foreach ($respuesta as $row => $item) {
			$Nombres_Planes=$item["nombre_plan"];
			$Categorias_Planes=$item["categoria_plan"];

			echo '<div class="planes-anuncio">'.
				 '<div class="categoria-plan">'.'<h1>'.$Categorias_Planes.'</h1>'.'</div>'.
				 '<div class="nombre-plan">'.'<h2>'.$Nombres_Planes.'</h2>'.'</div>'.
				 '<div class="precio-plan">'.'<h3>s/.'.$item["precio_plan"].'</h3>'.'</div>'.
				 '<div class="descripcion-plan"><ul>'
				 ;

			$descripcion_plan= $item["descripcion_plan"];
			$descripcion_plan = explode(",",$descripcion_plan);

			foreach($descripcion_plan as $x => $value) {
				echo
					 '<li>'.$value.'</li>'
					;
		    }
		    echo '</ul></div>'.
		    	 '<div class="enlace-crear-anuncio">'
		    	;

			if (($Nombres_Planes=$Nombres_Planes) && ($Categorias_Planes=$Categorias_Planes)) {
				/*foreach($descripcion_plan as $x => $value) {
		    		echo '<li>'.$value.'</li>';
		    	}*/
				#echo '<a href="index.php?action=crear_anuncio&cat=vehiculos&plan=Premiun">Continuar</a>';
				
				// echo '<a href="index.php?action=crear_anuncio&cat='.$Categorias_Planes.'&plan='.$Nombres_Planes.'">Continuar</a>';

				echo '
					<form method="post" action="crear_anuncio">
                        <button type="submit" name="cat-plan" value="'.$Categorias_Planes.'|'.$Nombres_Planes.'" class="btn-link">Continuar</button>
                    </form>
                	';
	    	}
/*
	    	if ($Nombres_Planes=="DESTACADO") {

		    	echo '<a href="index.php?action=crear_anuncio&plan=DESTACADO">Continuar</a>';
	    	}

	    	if ($Nombres_Planes=="SIMPLE") {

			    echo '<a href="index.php?action=crear_anuncio&plan=SIMPLE">Continuar</a>';
	    	}

	    	if ($Nombres_Planes=="GRATIS") {

		    	echo '<a href="index.php?action=crear_anuncio&plan=GRATIS">Continuar</a>';
	    	}
*/
	    	echo '</div>'.'</div>'
	    		;
    	}		
	}
}