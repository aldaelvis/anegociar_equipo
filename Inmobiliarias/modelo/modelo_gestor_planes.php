<?php

require_once "conexion.php";

class GestorPlanesModel{

	#MOSTRAR TODOS LOS PLANES DE ACUERDO A LA CATEGORIA
	#------------------------------------------------------
	public function mostrarPrecioPlanModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT idplan, nombre_plan, descripcion_plan, categoria_plan, precio_plan FROM $tabla TPlan WHERE categoria_plan = :plan");
		
		$stmt->bindParam(":plan", $datosModel, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();

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