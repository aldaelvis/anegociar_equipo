<?php

class GestorPlanesController{
	
	#ELIJE TU PLAN DE ACUERO ALA CATEGORIA 
	#------------------------------------
	public function vistaAnunciosPlanesController(){

		#$datosController = $_POST["cat"];
		$datosController2 = $_GET["dep"];

		$datosController = $_SESSION["val1"];
		// $prueba = $datosController.$datosController2;
		#echo $datosController;
		#echo $datosController2;
		// echo $prueba;

		$respuesta = GestorPlanesModel::mostrarClasificadosPlanesCategoriaModel($datosController, "tplanes_web");

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
					<form method="post">
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
/*
		echo '<div class="elije-plan-anuncio">	
			<h1 class="title">Planes de Publicación - Vehículos</h2>
			<div class="popular text-center">
				<h2>RECOMENDADO</h2>
			</div>			
			<h2>PREMIUM</h2>
			<h3><sup>S/.</sup>50<span>.00</span></h3>
							
			<div class="pric-menu">
				<ul>
							<li>- 60 Dias de Publicacion Web</li>
						
							<li>- 7 Dias de Publicacion en Portada Revista Anegociar F/C</li>
						
							<li>- 20 Fotos</li>
						
							<li>- Prioridad en Listado Alta</li>
						
							<li>- Publicacion de Anuncio en Grupo de Facebook Anegociar</li>
						
				</ul>
					<a href="index.php?action=crear_anuncio&id=1" class="btn btn-primary btn-block">Continuar &nbsp;&nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
			</div>
				

			<h2>DESTACADO</h2>
			<h3><sup>S/.</sup>35<span>.00</span></h3>
							
			<div class="pric-menu">
				<ul>
							<li>- 45 Dias de Publicacion Web</li>
						
							<li>- 7 Dias de Publicacion en Interior Revista Anegociar F/C</li>
						
							<li>- 15 Fotos</li>
						
							<li>- Prioridad en Listado Media</li>
						
							<li>- Publicacion de Anuncio en Grupo de Facebook Anegociar</li>
						
				</ul>
				<a href="detalles.php?plan=destacado" class="btn btn-primary btn-block">Continuar &nbsp;&nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
			</div>
				

			<div class="popular text-center">
				<h2>SIMPLE</h2>
			</div>
			<h3><sup>S/.</sup>20<span>.00</span></h3>
							
			<div class="pric-menu">
				<ul>
							<li>- 30 Dias de Publicacion Web</li>
						
							<li>- 7 Dias de Publicacion en Interior Revista Anegociar B/N</li>
						
							<li>- 10 Fotos</li>
						
							<li>- Prioridad en Listado Regular</li>
						
							<li>- Publicacion de Anuncio en Grupo de Facebook Anegociar</li>
						
				</ul>
				<a href="detalles.php?plan=simple" class="btn btn-primary btn-block">Continuar &nbsp;&nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
			</div>
						
			<div class="popular text-center">
				<h2>GRATIS</h2>
			</div>
					
			<h3><sup>S/.</sup>0<span>.00</span></h3>
			
			<div class="pric-menu">
				<ul>
							<li>- 30 Dias de Publicacion Web</li>
						
							<li>- No Tiene Publicacion en Revista Anegociar</li>
						
							<li>- 5 Fotos</li>
						
							<li>- Prioridad en Listado Baja</li>
						
							<li>- No Tiene Publicacion en Grupo de Facebook Anegociar</li>
						
				</ul>
				<a href="detalles.php?plan=gratis" class="btn btn-primary btn-block">Continuar &nbsp;&nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
			</div>
		</div>
	';
	}

}
	*/