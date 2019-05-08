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

		$respuesta = GestorPlanesModel::mostrarPlanesPorCategoriaModel($datosController, "Tplanes");

		foreach($respuesta as $row => $item){

			echo '<option value='.$item['idplan'].'|'.$item['nombre_plan'].'>'. $item["nombre_plan"] . '</option>';
			#echo '<br/><a href="index.php?action=ubicacion_clasificados&cat='.$categoria.'&dep='.$item["nombredepartamento"].'">'.$item["nombredepartamento"].'</a>';
		}	
	}

	#Elvis ------
	#ELIJE TU PLAN DE ACUERDO ALA CATEGORIA
	#------------------------------------
	public function mostrarPlanesWebPorCategoriaControlador(){
	    session_start();
		$categoria = $_SESSION['cat'];
		$categoria = strtoupper($categoria);
		$rpta = GestorPlanesModel::mostrarPlanesWebPorCategoriaModel($categoria, 'Tplanes_web');
		foreach ($rpta as $key => $value) {
            $data[] = array(
                "idplan_web" => $value["idplan_web"],
                "nombre_plan_web" => $value["nombre_plan_web"],
                "descripcion_plan_web" => $value["descripcion_plan_web"],
                "categoria_plan_web" => $value["categoria_plan_web"],
                "precio_plan_web" => $value["precio_plan_web"]
            );
    	}
    	return json_encode($data);
	}

    public function mostrarPlanesRevistaPorCategoriaControlador(){
        session_start();
        $categoria = $_SESSION['cat'];
        $categoria = strtoupper($categoria);
        $rpta = GestorPlanesModel::mostrarPlanesRevistaPorCategoriaModel($categoria, 'Tplanes_revista');
        foreach ($rpta as $key => $value) {
            $data[] = array(
                "idplan_revista" => $value["idplan_revista"],
                "nombre_plan_revista" => $value["nombre_plan_revista"],
                "descripcion_plan_revista" => $value["descripcion_plan_revista"],
                "categoria_plan_revista" => $value["categoria_plan_revista"],
                "precio_plan_revista" => $value["precio_plan_revista"]
            );
        }
        return json_encode($data);
    }
}