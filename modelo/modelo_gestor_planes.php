<?php

require_once "conexion.php";

class GestorPlanesModel{

	#MOSTRAR TODOS LOS PLANES DE ACUERDO A LA CATEGORIA
	#------------------------------------------------------
	public function mostrarPrecioPlanModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT idplan_web, nombre_plan_web, descripcion_plan_web, categoria_plan_web, precio_plan_web FROM $tabla TPlan WHERE categoria_plan_web = :plan");
		
		$stmt->bindParam(":plan", $datosModel, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
	}

	#MOSTRAR TODOS LOS PLANES DE ACUERDO A LA CATEGORIA
	#------------------------------------------------------
	public static function mostrarClasificadosPlanesCategoriaModel($datosModel, $tabla){
	    $cursor = Conexion::conectar();
		$stmt = $cursor->prepare("SELECT idplan_web, nombre_plan_web, descripcion_plan_web, categoria_plan_web, precio_plan_web 
        FROM $tabla TPlan WHERE categoria_plan_web = :cat");
		$stmt->bindParam(":cat", $datosModel, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public static function mostrarClasificadosPlanesCategoriarevistaModel($datosModel, $tabla) {
		$cursor = Conexion::conectar();
		$stmt = $cursor->prepare("SELECT idplan_revista, nombre_plan_revista, descripcion_plan_revista, categoria_plan_revista, precio_plan_revista
        FROM $tabla TPlan WHERE categoria_plan_revista = :cat");
		$stmt->bindParam(":cat", $datosModel, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	//RETORNAR LOS PLANES WEB
    public static function obtenerInfoPlanWebModel($datos, $tabla){
	    $cursor = Conexion::conectar();
	    $stmt = $cursor->prepare("SELECT idplan_web, nombre_plan_web, precio_plan_web FROM $tabla WHERE categoria_plan_web = :categoria 
        AND nombre_plan_web = :plan");
	    $stmt->bindParam(':categoria', $datos['categoria'], PDO::PARAM_STR);
	    $stmt->bindParam(':plan', $datos['planWeb'], PDO::PARAM_STR);
	    $stmt->execute();
	    return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	//RETORNAR LOS PLANES REVISTA
    public static function obtenerInfoPlanRevistaModel($datos, $tabla){
	    $cursor = Conexion::conectar();
	    $stmt = $cursor->prepare("SELECT idplan_revista, nombre_plan_revista, precio_plan_revista 
		FROM $tabla WHERE categoria_plan_revista = :categoria 
        AND nombre_plan_revista = :plan");
	    $stmt->bindParam(':categoria', $datos['categoria'], PDO::PARAM_STR);
	    $stmt->bindParam(':plan', $datos['planRevista'], PDO::PARAM_STR);
	    $stmt->execute();
	    return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}