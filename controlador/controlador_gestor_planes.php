<?php

class GestorPlanesController{
	
	#ELIJE TU PLAN DE ACUERO ALA CATEGORIA 
	#------------------------------------
	public static function vistaAnunciosPlanesController()
    {
        //Recuperamos la categoría
        $datosControllerWeb = strtoupper($_SESSION["val1"]);
        $respuestaweb = GestorPlanesModel::mostrarClasificadosPlanesCategoriaModel($datosControllerWeb, "tplanes_web");
		echo '<form method="post" > <br />';
        foreach ($respuestaweb as $row => $item) {
            $nPlanWeb = $item["nombre_plan_web"];
            $Categorias_Planes = $item["categoria_plan_web"];
			
            echo '<div class="planes-anuncio">' .
                '<div class="categoria-plan">' . '<h1>' . $Categorias_Planes . '</h1>' . '</div>' .
                '<div class="nombre-plan">' . '<h2>' . $nPlanWeb . '</h2>' . '</div>' .
                '<div class="precio-plan">' . '<h3>s/.' . $item["precio_plan_web"] . '</h3>' . '</div>' .
                '<div class="descripcion-plan"><ul>';

            $descripcion_plan = $item["descripcion_plan_web"];
            $descripcion_plan = explode(",", $descripcion_plan);
            foreach ($descripcion_plan as $x => $value) {
                echo
                    '<li>' . $value . '</li>';
            }
            echo '</ul></div>' .
                '<div class="enlace-crear-anuncio">';

            if (($nPlanWeb = $nPlanWeb) && ($Categorias_Planes = $Categorias_Planes)) {
                echo '
					<input type="radio" name="n-plan-web" value="' . $nPlanWeb .'">Elegir
                	';
            }
            echo '</div>' . '</div>';
		}
		
		//Recuperamos la categoría
        $datosControllerRevista = strtoupper($_SESSION["val1"]);
		$respuestaRevita = GestorPlanesModel::mostrarClasificadosPlanesCategoriarevistaModel($datosControllerRevista, "tplanes_revista");
		echo '<input  type="checkbox" onclick="mostrarPlan()"> Deseo el plan revista';
		echo '<div id="planes_revista" style="display: none;">';
        foreach ($respuestaRevita as $row => $item) {
            $nPlanRevista = $item["nombre_plan_revista"];
            $Categorias_Planes = $item["categoria_plan_revista"];
            
            echo '<div class="planes-anuncio">' .
                '<div class="categoria-plan">' . '<h1>' . $Categorias_Planes . '</h1>' . '</div>' .
                '<div class="nombre-plan">' . '<h2>' . $nPlanRevista . '</h2>' . '</div>' .
                '<div class="precio-plan">' . '<h3>s/.' . $item["precio_plan_revista"] . '</h3>' . '</div>' .
                '<div class="descripcion-plan"><ul>';

            $descripcion_plan = $item["descripcion_plan_revista"];
            $descripcion_plan = explode(",", $descripcion_plan);

            foreach ($descripcion_plan as $x => $value) {
                echo
                    '<li>' . $value . '</li>';
            }
            echo '</ul></div>' .
                '<div class="enlace-crear-anuncio">';

            if (($nPlanRevista = $nPlanRevista) && ($Categorias_Planes = $Categorias_Planes)) {
                echo '<input id="planRevista" type="radio" name="n-plan-revista" value="' . $nPlanRevista .'">Elegir';
            }
            echo '</div>' . '</div>';
        }
        echo '</div>';
        echo '<div class="cont-enviar">   
            <input type="submit" name="enviar_plan" class="btn-link" value="Aceptar" >
        </div>';
        echo '</form>';
	}
}