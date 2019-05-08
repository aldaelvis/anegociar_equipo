<?php

require_once "conexion.php";

class GestorPlanesModel{

	#MOSTRAR TODOS LOS PLANES DE ACUERDO A LA CATEGORIA
	#------------------------------------------------------
	public function consultarPrecioPlanPorCategoriaModel($datosModel1, $datosModel2, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT precio_plan FROM $tabla TPlan  WHERE nombre_plan = :n_plan AND categoria_plan = :c_plan");
		
		$stmt->bindParam(":n_plan", $datosModel1, PDO::PARAM_INT);
		$stmt->bindParam(":c_plan", $datosModel2, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
	}

	#MOSTRAR TODOS LOS PLANES DE ACUERDO A LA CATEGORIA
	#------------------------------------------------------
	public function mostrarPrecioPlanModel($datosModel1, $datosModel2, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT idplan, nombre_plan, descripcion_plan, categoria_plan, precio_plan FROM $tabla TPlan  WHERE nombre_plan = :n_plan AND categoria_plan = :c_plan");
		
		$stmt->bindParam(":n_plan", $datosModel1, PDO::PARAM_INT);
		$stmt->bindParam(":c_plan", $datosModel2, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
	}

	#MOSTRAR TODOS LOS PLANES DE ACUERDO A LA CATEGORIA
	#------------------------------------------------------
	public function mostrarPlanesporCategoriaModel($datosModel, $tabla){

		#$stmt = Conexion::conectar()->prepare("SELECT idclasificado, titulo, descripcion, nombrepais,nombredepartamento ,nombreprovincia,nombredistrito FROM $tabla TClas INNER JOIN Tdetalles_ubicaciones_clasificados TDetU ON TClas. iddetalle_ubicacion_clasificado = TDetU. iddetalle_ubicacion_clasificado INNER JOIN Tpaises TPais ON TDetU. idpais = TPais. idpais INNER JOIN Tdepartamentos TDep ON TDetU. iddepartamento = TDep. iddepartamento INNER JOIN Tprovincias TPro ON TDetU. idprovincia = TPro. idprovincia INNER JOIN Tdistritos TDis ON TDetU. iddistrito = TDis. iddistrito WHERE nombredepartamento = :id ORDER BY TClas. idclasificado DESC");

		$stmt = Conexion::conectar()->prepare("SELECT idplan, nombre_plan, descripcion_plan, categoria_plan, precio_plan FROM $tabla TPlan WHERE categoria_plan = :cat");
		
		$stmt->bindParam(":cat", $datosModel, PDO::PARAM_INT);

		$stmt->execute();

		#return $stmt->fetch();
		return $stmt->fetchAll();

		$stmt->close();
	}

	#MOSTRAR TODOS LOS PLANES DE ACUERDO A LA CATEGORIA
	#------------------------------------------------------
	public function mostrarClasificadosPlanesCategoriaModel($datosModel, $tabla){

		#$stmt = Conexion::conectar()->prepare("SELECT idclasificado, titulo, descripcion, nombrepais,nombredepartamento ,nombreprovincia,nombredistrito FROM $tabla TClas INNER JOIN Tdetalles_ubicaciones_clasificados TDetU ON TClas. iddetalle_ubicacion_clasificado = TDetU. iddetalle_ubicacion_clasificado INNER JOIN Tpaises TPais ON TDetU. idpais = TPais. idpais INNER JOIN Tdepartamentos TDep ON TDetU. iddepartamento = TDep. iddepartamento INNER JOIN Tprovincias TPro ON TDetU. idprovincia = TPro. idprovincia INNER JOIN Tdistritos TDis ON TDetU. iddistrito = TDis. iddistrito WHERE nombredepartamento = :id ORDER BY TClas. idclasificado DESC");

		$stmt = Conexion::conectar()->prepare("SELECT idplan, nombre_plan, descripcion_plan, categoria_plan, precio_plan FROM $tabla TPlan WHERE categoria_plan = :cat");
		
		$stmt->bindParam(":cat", $datosModel, PDO::PARAM_INT);

		$stmt->execute();

		#return $stmt->fetch();
		return $stmt->fetchAll();

		$stmt->close();
	}
}