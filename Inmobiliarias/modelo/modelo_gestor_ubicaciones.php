<?php

require_once "conexion.php";

class GestorUbicacionesModel{

	#VISTA crear anuncios
	#-------------------------------------
	public function vistaCrearAnunciosUbicacionModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT iddepartamento, nombredepartamento FROM $tabla");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	#MOSTRAR TODOS LOS CKLASIFICADOS DE LIMA
	#------------------------------------------------------
	public function mostrarClasificadosCategoriasPorUbicacionModel($datosModel1, $datosModel2, $tabla){

		#$stmt = Conexion::conectar()->prepare("SELECT idclasificado, titulo, descripcion, nombrepais,nombredepartamento ,nombreprovincia,nombredistrito FROM $tabla TClas INNER JOIN Tdetalles_ubicaciones_clasificados TDetU ON TClas. iddetalle_ubicacion_clasificado = TDetU. iddetalle_ubicacion_clasificado INNER JOIN Tpaises TPais ON TDetU. idpais = TPais. idpais INNER JOIN Tdepartamentos TDep ON TDetU. iddepartamento = TDep. iddepartamento INNER JOIN Tprovincias TPro ON TDetU. idprovincia = TPro. idprovincia INNER JOIN Tdistritos TDis ON TDetU. iddistrito = TDis. iddistrito WHERE nombredepartamento = :id ORDER BY TClas. idclasificado DESC");

		$stmt = Conexion::conectar()->prepare("SELECT TClas. idclasificado, titulo, descripcion, tipo_moneda, precio, celular, precio_tipo, cod_revista, fechacreacion, Tgaleria_imagenes_clasificados. idclasificado, nombreimagen FROM Tclasificados TClas INNER JOIN Tgaleria_imagenes_clasificados ON TClas. idclasificado = Tgaleria_imagenes_clasificados. idclasificado INNER JOIN Tdetalles_caracteristicas_clasificados TDetC ON TClas. iddetalle_caracteristica_clasificado = TDetC. iddetalle_caracteristica_clasificado INNER JOIN Tcategorias TCat ON TDetC. idcategoria = TCat. idcategoria INNER JOIN Tdetalles_ubicaciones_clasificados TDetU ON TClas. iddetalle_ubicacion_clasificado = TDetU. iddetalle_ubicacion_clasificado INNER JOIN Tpaises TPais ON TDetU. idpais = TPais. idpais INNER JOIN Tdepartamentos TDep ON TDetU. iddepartamento = TDep. iddepartamento INNER JOIN Tprovincias TPro ON TDetU. idprovincia = TPro. idprovincia INNER JOIN Tdistritos TDis ON TDetU. iddistrito = TDis. iddistrito WHERE nombre_categoria = :cat AND nombredepartamento = :dep AND TClas. estado = '1' GROUP BY Tgaleria_imagenes_clasificados. idclasificado DESC");


		$stmt->setFetchMode(PDO::FETCH_ASSOC);

		$stmt->bindParam(":cat", $datosModel1, PDO::PARAM_INT);
		$stmt->bindParam(":dep", $datosModel2, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();	
	}

	#MOSTRAR TODOS LOS CKLASIFICADOS DE LIMA
	#------------------------------------------------------
	public function mostrarClasificadosCategoriasYSubcategoriasPorUbicacionPorUbicacionModel($datosModel, $datosModel1, $datosModel2, $tabla){

		#$stmt = Conexion::conectar()->prepare("SELECT idclasificado, titulo, descripcion, nombrepais,nombredepartamento ,nombreprovincia,nombredistrito FROM $tabla TClas INNER JOIN Tdetalles_ubicaciones_clasificados TDetU ON TClas. iddetalle_ubicacion_clasificado = TDetU. iddetalle_ubicacion_clasificado INNER JOIN Tpaises TPais ON TDetU. idpais = TPais. idpais INNER JOIN Tdepartamentos TDep ON TDetU. iddepartamento = TDep. iddepartamento INNER JOIN Tprovincias TPro ON TDetU. idprovincia = TPro. idprovincia INNER JOIN Tdistritos TDis ON TDetU. iddistrito = TDis. iddistrito WHERE nombredepartamento = :id ORDER BY TClas. idclasificado DESC");

		$stmt = Conexion::conectar()->prepare("SELECT idclasificado, titulo, descripcion FROM Tclasificados TClas INNER JOIN Tdetalles_caracteristicas_clasificados TDetC ON TClas. iddetalle_caracteristica_clasificado = TDetC. iddetalle_caracteristica_clasificado INNER JOIN Tcategorias TCat ON TDetC. idcategoria = TCat. idcategoria INNER JOIN Tsubcategorias Tsubcat ON TCat. idcategoria = Tsubcat. idcategoria INNER JOIN Tdetalles_ubicaciones_clasificados TDetU ON TClas. iddetalle_ubicacion_clasificado = TDetU. iddetalle_ubicacion_clasificado INNER JOIN Tpaises TPais ON TDetU. idpais = TPais. idpais INNER JOIN Tdepartamentos TDep ON TDetU. iddepartamento = TDep. iddepartamento INNER JOIN Tprovincias TPro ON TDetU. idprovincia = TPro. idprovincia INNER JOIN Tdistritos TDis ON TDetU. iddistrito = TDis. iddistrito WHERE nombre_categoria = :cat AND nombre_subcategoria = :subcat AND nombredepartamento = :dep ORDER BY TClas. idclasificado DESC");

		$stmt->setFetchMode(PDO::FETCH_ASSOC);

		$stmt->bindParam(":cat", $datosModel, PDO::PARAM_INT);
		$stmt->bindParam(":subcat", $datosModel1, PDO::PARAM_INT);
		$stmt->bindParam(":dep", $datosModel2, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();	
	}
}