<?php

require_once "conexion.php";

class GestorAnunciosModel{

	public function verificarEstadoClasificadosModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT idclasificado, estado FROM $tabla");

		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	#ACTIVAR CLASIFICADO
	#-------------------------------------
	public function activarClasificadoModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = 1 WHERE idclasificado = :id");

		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}


	#GUARDAR GALERIA IMAGENES
	#------------------------------------------------------------
	public function guardarCaracteristicasClasificadosModel($datosModel, $tabla){

		$PDO = Conexion::conectar();
		$stmt= $PDO->prepare("INSERT INTO $tabla (idcategoria, idsubcategoria, idmarca, idmodelo, fabricacion_vehiculo, tipo_modelo_vehiculo, tipo_combustible, tipo_transmision, condicion_vehiculo, kilometraje_vehiculo, tipo_operacion_inmueble, tipo_categoria_inmueble, nro_habitaciones, nro_servicios_higienicos, metros_cuandrados_inmuebles /* idclasificados*/) VALUES (:idcategoria, :idsubcategoria, :idmarca, :idmodelo, :fabricacion_vehiculo, :tipo_modelo_vehiculo, :tipo_combustible, :tipo_transmision, :condicion_vehiculo, :kilometraje_vehiculo, :tipo_operacion_inmueble, :tipo_categoria_inmueble, :nro_habitaciones, :nro_servicios_higienicos, :metros_cuandrados_inmuebles /*:idclasificados*/)");

			$stmt -> bindParam(":idcategoria", $datosModel["idcategoria"], PDO::PARAM_INT);
			$stmt -> bindParam(":idsubcategoria", $datosModel["idsubcategoria"], PDO::PARAM_INT);

			$stmt -> bindParam(":idmarca",  $datosModel["idmarca"], PDO::PARAM_INT);
			$stmt -> bindParam(":idmodelo", $datosModel["idmodelo"], PDO::PARAM_INT);

			$stmt -> bindParam(":fabricacion_vehiculo", $datosModel["fabricacion_vehiculo"], PDO::PARAM_INT);
			$stmt -> bindParam(":tipo_modelo_vehiculo", $datosModel["tipo_modelo_vehiculo"], PDO::PARAM_INT);
			$stmt -> bindParam(":tipo_combustible", $datosModel["tipo_combustible"], PDO::PARAM_INT);
			$stmt -> bindParam(":tipo_transmision", $datosModel["tipo_transmision"], PDO::PARAM_INT);
			$stmt -> bindParam(":condicion_vehiculo", $datosModel["condicion_vehiculo"], PDO::PARAM_INT);
			$stmt -> bindParam(":kilometraje_vehiculo", $datosModel["kilometraje_vehiculo"], PDO::PARAM_INT);

			$stmt -> bindParam(":tipo_operacion_inmueble", $datosModel["tipo_operacion_inmueble"], PDO::PARAM_INT);
			$stmt -> bindParam(":tipo_categoria_inmueble", $datosModel["tipo_categoria_inmueble"], PDO::PARAM_INT);
			$stmt -> bindParam(":nro_habitaciones", $datosModel["nro_habitaciones"], PDO::PARAM_INT);
			$stmt -> bindParam(":nro_servicios_higienicos", $datosModel["nro_servicios_higienicos"], PDO::PARAM_INT);
			$stmt -> bindParam(":metros_cuandrados_inmuebles", $datosModel["metros_cuandrados_inmuebles"], PDO::PARAM_INT);

#		if(empty($datosModel == "" ||  $datosModel == NULL)){
			
/*			
			$stmt -> bindParam(":año_vehiculo", $datosModel = NULL, PDO::PARAM_INT);
			$stmt -> bindParam(":tipo_vehiculo", $datosModel = NULL, PDO::PARAM_INT);
			$stmt -> bindParam(":tipo_combustible", $datosModel = NULL, PDO::PARAM_INT);
			$stmt -> bindParam(":tipo_transmision", $datosModel = NULL, PDO::PARAM_INT);
			$stmt -> bindParam(":condicion_vehiculo", $datosModel = NULL, PDO::PARAM_INT);
			$stmt -> bindParam(":kilometraje_vehiculo", $datosModel = NULL, PDO::PARAM_INT);
*/
#		}

		if($stmt->execute()){

			#return "ok";
			$workorderid = $PDO->lastInsertId();
			return $workorderid;
			#return "success";
		}

		else{

			return "error";
		}

		$stmt->close();

	}

	#GUARDAR GALERIA IMAGENES
	#------------------------------------------------------------
	public function guardarUbicacionesClasificadosModel($datosModel, $tabla){

		$PDO = Conexion::conectar();
		$stmt= $PDO->prepare("INSERT INTO $tabla (idpais, iddepartamento, idprovincia, iddistrito /* idclasificados*/) VALUES (:idpais, :iddepartamento, :idprovincia, :iddistrito /*:idclasificados*/)");

		$stmt -> bindParam(":idpais", $datosModel["idpais"], PDO::PARAM_INT);
		$stmt -> bindParam(":iddepartamento", $datosModel["iddepartamento"], PDO::PARAM_INT);
		$stmt -> bindParam(":idprovincia", $datosModel["idprovincia"], PDO::PARAM_INT);
		$stmt -> bindParam(":iddistrito", $datosModel["iddistrito"], PDO::PARAM_INT);

		if($stmt->execute()){

			#return "ok";
			$workorderid = $PDO->lastInsertId();
			return $workorderid;
			#return "success";
		}

		else{

			return "error";
		}

		$stmt->close();

	}

	#GUARDAR GALERIA IMAGENES
	#------------------------------------------------------------
	public function RecuperarIDUbicacionModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT iddetalle_ubicacion_clasificado FROM $tabla");

		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	#GUARDAR GALERIA IMAGENES
	#------------------------------------------------------------
	public function RecuperarIDCaracteristicaModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT iddetalle_caracteristica_clasificado FROM $tabla");

		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	#Recuperar ID CLASIFICADOS PARA LA GUARDAR LA GALERIA DE IMAGENES
	#------------------------------------------------------------
	public function RecuperarIDClasificadosModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT idclasificado FROM $tabla");

		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	#GUARDAR ARTICULO
	#------------------------------------------------------------
	public function guardarClasificadosModel($datosModel, $tabla){

		#$stmt = Conexion::conectar()->prepare("INSERT INTO tclasificados (titulo) VALUES (:titulo)");

		$PDO = Conexion::conectar();
		$stmt= $PDO->prepare("INSERT INTO $tabla (titulo, descripcion, tipo_moneda, precio, celular, descripcion_revista, precio_tipo, cod_revista, estado, /*idgaleria_imagen_clasificado,*/ iddetalle_caracteristica_clasificado, iddetalle_ubicacion_clasificado, idusuario) VALUES (:titulo, :descripcion, :tipo_moneda, :precio, :celular, :descripcion_revista, :precio_tipo, :cod_revista, :estado, /* :idgaleria_imagen_clasificado,*/:iddetalle_caracteristica_clasificado, :iddetalle_ubicacion_clasificado, :idusuario)");

		$stmt -> bindParam(":titulo", $datosModel["titulo"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);
		#$stmt -> bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_STR);
		$stmt -> bindParam(":tipo_moneda", $datosModel["tipo_moneda"], PDO::PARAM_STR);
		$stmt -> bindParam(":precio", $datosModel["precio"], PDO::PARAM_STR);
		$stmt -> bindParam(":celular", $datosModel["celular"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion_revista", $datosModel["descripcion_revista"], PDO::PARAM_STR);
		$stmt -> bindParam(":precio_tipo", $datosModel["precio_tipo"], PDO::PARAM_STR);
		$stmt -> bindParam(":cod_revista", $datosModel["cod_revista"], PDO::PARAM_STR);
		$stmt -> bindParam(":estado", $datosModel["estado"], PDO::PARAM_STR);
		#$stmt -> bindParam(":idgaleria_imagen_clasificado", $datosModel["idgaleria_imagen_clasificado"], PDO::PARAM_INT);
		$stmt -> bindParam(":iddetalle_caracteristica_clasificado", $datosModel["iddetalle_caracteristica_clasificado"], PDO::PARAM_INT);
		$stmt -> bindParam(":iddetalle_ubicacion_clasificado", $datosModel["iddetalle_ubicacion_clasificado"], PDO::PARAM_INT);
		#$stmt -> bindParam(":idpais", $datosModel["idpais"], PDO::PARAM_STR);
		$stmt -> bindParam(":idusuario", $datosModel["idusuario"], PDO::PARAM_INT);

		if($stmt->execute()){
			$workorderid = $PDO->lastInsertId();
			return $workorderid;
			#return "success";
		}		
		else{

			return "error";
		}

		$stmt->close();

	}

	#GUARDAR GALERIA IMAGENES CLASIFICADOS
	#------------------------------------------------------------
	public function guardarGaleriaImagenClasificadosModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombreimagen, idclasificado) VALUES (:nombreimagen, :idclasificado)");

		$stmt -> bindParam(":nombreimagen", $datosModel["nombreimagen"], PDO::PARAM_STR);
		$stmt -> bindParam(":idclasificado", $datosModel["idclasificado"], PDO::PARAM_INT);
		#$stmt -> bindParam(":idcategoria", $datosModel["idcategoria"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";
		}

		else{

			return "error";
		}

		$stmt->close();

	}


	#Recuperar ID CLASIFICADOS PARA LA GUARDAR LA GALERIA DE IMAGENES
	#------------------------------------------------------------
	public function RecuperarIDGaleriaImagenClasificadosModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT idgaleria_imagen_clasificado, nombreimagen FROM $tabla");

		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	#MOSTAR GALERIA IMAGENES CLASIFICADOS
	#------------------------------------------------------------
	public function MostarGaleriaImagenClasificadosModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT TClas. idclasificado, titulo, descripcion, precio, celular, nombreimagen, TGalClas. idclasificado, idgaleria_imagen_clasificado FROM  $tabla TClas INNER JOIN Tgaleria_imagenes_clasificados TGalClas ON TClas. idclasificado = TGalClas. idclasificado WHERE TClas. idclasificado = :id");
		
		//$stmt->setFetchMode(PDO::FETCH_ASSOC);

		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
		
		$stmt->execute();
		
		return $stmt->fetchAll();

		#return $stmt->fetch();
		
		$stmt->close();

	}

	#MOSTRAR UN SOLO CLASIFICADO 
	#------------------------------------------------------
	public function mostrarClasificadosModel($datosModel,$tabla){

		#$stmt = Conexion::conectar()->prepare("SELECT idclasificado, titulo, descripcion, tipo_moneda, precio, celular FROM $tabla WHERE idclasificado = :id");

		#$stmt = Conexion::conectar()->prepare("SELECT TClas. idclasificado, titulo, descripcion, precio, celular, nombreimagen, TGalClas. idclasificado FROM  Tclasificados TClas INNER JOIN Tgaleria_imagenes_clasificados TGalClas ON TClas. idclasificado = TGalClas. idclasificado WHERE TClas. idclasificado = :id");
		 
		#$stmt = Conexion::conectar()->prepare("	SELECT TGalClas. idclasificado, titulo, descripcion, precio, celular, nombreimagen, TClas. idclasificado FROM Tgaleria_imagenes_clasificados TGalClas INNER JOIN Tclasificados TClas	ON TGalClas. idclasificado = TClas. idclasificado WHERE TClas. idclasificado = :id");

		$stmt = Conexion::conectar()->prepare("SELECT */*TGalClas. idclasificado, titulo, descripcion, precio, celular, nombreimagen, TClas. idclasificado */FROM Tgaleria_imagenes_clasificados TGalClas INNER JOIN Tclasificados TClas ON TGalClas. idclasificado = TClas. idclasificado INNER JOIN Tdetalles_caracteristicas_clasificados TDetCarClas ON TDetCarClas. iddetalle_caracteristica_clasificado = TClas. iddetalle_caracteristica_clasificado INNER JOIN Tdetalles_ubicaciones_clasificados TDetUbiClas ON TClas. iddetalle_ubicacion_clasificado = TDetUbiClas. iddetalle_ubicacion_clasificado INNER JOIN Tpaises TPais ON TDetUbiClas. idpais = TPais. idpais INNER JOIN Tdepartamentos TDep ON TDetUbiClas. iddepartamento = TDep. iddepartamento INNER JOIN Tprovincias TPro ON TDetUbiClas. idprovincia = TPro. idprovincia INNER JOIN Tdistritos TDis ON TDetUbiClas. iddistrito = TDis. iddistrito WHERE TClas. idclasificado = :id");

		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}

	#BORRAR ARTICULOS
	#-----------------------------------------------------
	public function borrarArticuloModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}

		else{

			return "error";

		}

		$stmt->close();

	}

	#ACTUALIZAR ARTICULOS
	#---------------------------------------------------
	public function editarArticuloModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET titulo = :titulo, introduccion = :introduccion, ruta = :ruta, contenido = :contenido WHERE id = :id");	

		$stmt -> bindParam(":titulo", $datosModel["titulo"], PDO::PARAM_STR);
		$stmt -> bindParam(":introduccion", $datosModel["introduccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":ruta", $datosModel["ruta"], PDO::PARAM_STR);
		$stmt -> bindParam(":contenido", $datosModel["contenido"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";
		}

		else{

			return "error";
		}

		$stmt->close();

	}

	#ACTUALIZAR ORDEN 
	#---------------------------------------------------
	public function actualizarOrdenModel($datos, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET orden = :orden WHERE id = :id");

		$stmt -> bindParam(":orden", $datos["ordenItem"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["ordenArticulos"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		}

		else{
			return "error";
		}

		$stmt -> close();

	}

	#SELECCIONAR ORDEN 
	#---------------------------------------------------
	public function seleccionarOrdenModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id, titulo, introduccion, ruta, contenido FROM $tabla ORDER BY orden ASC");

		$stmt -> execute();

		return $stmt->fetchAll();

		$stmt->close();

	}

	#MOSTRAR TODOS LOS anuncios por usuario
	#------------------------------------------------------
	public function mostrarListaClasificadosUsuariosModel(/*$datosModel,*/ $tabla){

		#$stmt = Conexion::conectar()->prepare("SELECT idclasificados, titulo, descripcion, imagen, tipo_moneda, precio FROM $tabla");

		$stmt = Conexion::conectar()->prepare("SELECT TClas. idclasificado, titulo, descripcion FROM TClasificados TClas INNER JOIN Tgaleria_imagenes_clasificados TGal ON TClas. idclasificado = TGal. idclasificado");

		#$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

	}

	#BUSCAR CLASIFICADOS 
	#------------------------------------------------------
	public function buscarClasificadosModel($datosModel1, $datosModel2, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT Tclasificados. idclasificado, 
		titulo, descripcion, tipo_moneda, precio, celular, precio_tipo, cod_revista, fechacreacion, 
		Tgaleria_imagenes_clasificados. idclasificado, nombreimagen 
		FROM Tclasificados 
		INNER JOIN Tgaleria_imagenes_clasificados 
		ON Tclasificados. idclasificado = Tgaleria_imagenes_clasificados. idclasificado 
		INNER JOIN Tdetalles_caracteristicas_clasificados 
		ON Tclasificados. iddetalle_caracteristica_clasificado = Tdetalles_caracteristicas_clasificados. iddetalle_caracteristica_clasificado 
		INNER JOIN Tcategorias 
		ON Tdetalles_caracteristicas_clasificados. idcategoria = Tcategorias. idcategoria 
		WHERE Tclasificados. idclasificado = Tgaleria_imagenes_clasificados. idclasificado
		AND Tclasificados. titulo LIKE CONCAT ('%', :palabra, '%')
		AND nombre_categoria = 'Inmuebles'
		AND Tclasificados. estado = '1'
		GROUP BY Tgaleria_imagenes_clasificados. idclasificado DESC ");
		$stmt -> bindParam(":palabra", $datosModel2, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
	}
}
