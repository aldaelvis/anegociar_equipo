<?php

require_once "conexion.php";

class GestorCategoriasModel{

	#VERIFICAR IDMODELO ATRAVES DEL NOMBRE_MODELO
	#-------------------------------------
	public function verificarIdModeloModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT idmodelo, nombre_modelo FROM $tabla Tmod WHERE nombre_modelo = :mod");

		$stmt->bindParam(":mod", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	#VERIFICAR IDMARCAS ATRAVES DEL NOMBRE_MARCA
	#-------------------------------------
	public function verificarIdCategoriaModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT idcategoria, nombre_categoria FROM $tabla Tcat WHERE nombre_categoria = :cat");

		$stmt->bindParam(":cat", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	#CREA LISTA DE CATEGORIAS
	#-------------------------------------
	public function vistaCrearAnunciosCategoriaModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT idcategoria, nombrecategoria FROM $tabla");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	#MUESTRA LISTA DE CATEGORIAS Y SUBCATEGORIAS EN LA PAGINA PRINCIPAL
	#-------------------------------------
	public function MostrarCategoriasYSubcategoriasModel($tabla){

		#$stmt = Conexion::conectar()->prepare("SELECT Tcat. idcategoria, nombrecategoria, ruta_imagen_categoria, idsubcategoria, nombresubcategoria FROM $tabla Tcat LEFT JOIN Tsubcategorias Tsubcat ON Tcat. idcategoria = Tsubcat. idcategoria");	
		#$stmt = Conexion::conectar()->prepare("SELECT nombresubcategoria, nombrecategoria FROM $tabla Tsubcat LEFT JOIN Tcategorias Tcat ON Tcat. idcategoria = Tsubcat. idcategoria");
		$stmt = Conexion::conectar()->prepare("SELECT Tcat. idcategoria as catid, nombre_categoria as catname, imagen_categoria as catimg, idsubcategoria as prodId, nombre_subcategoria as prodName FROM Tcategorias Tcat INNER JOIN Tsubcategorias Tsubcat ON Tcat. idcategoria = Tsubcat. idcategoria ORDER BY Tcat. idcategoria ASC");
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	#CREA LISTA DE SUBCATEGORIAS EN PAGINA CREAR ANUNCIO
	#-------------------------------------
	public function CrearAnunciosMostrarSubCategoriasModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT nombre_categoria, nombre_subcategoria FROM Tcategorias Tcat INNER JOIN Tsubcategorias Tsubcat ON Tcat. idcategoria = Tsubcat. idcategoria WHERE nombre_categoria = :cat");	

		$stmt->bindParam(":cat", $datosModel, PDO::PARAM_INT);

		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	#MOSTRAR TODOS LOS PLANES DE ACUERDO A LA CATEGORIA
	#------------------------------------------------------
	public function mostrarPrecioPlanModel($datosModel1, $datosModel2, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT idplan, nombre_plan, descripcion_plan, categoria_plan, precio_plan FROM $tabla TPlan WHERE categoria_plan = :cat AND nombre_plan = :plan ");
		
		$stmt->bindParam(":cat", $datosModel1, PDO::PARAM_INT);
		$stmt->bindParam(":plan", $datosModel2, PDO::PARAM_INT);

		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();

		/*$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();*/
	}

	#------------------------------------------------------
	public function contarClasificadosModel($tabla){
		/*Cuenta todos los clasificados en general*/
		#$stmt = Conexion::conectar()->prepare("SELECT COUNT(idclasificado) FROM $tabla");

		$stmt = Conexion::conectar()->prepare("SELECT COUNT(idclasificado) FROM $tabla WHERE TClasificados. estado = '1'");
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute();
		return $stmt->fetchAll();

	}

	public function mostrarClasificadosPorCategoriaModel($datosModel, $datosModel1, $datosModel2, $tabla){

		/*Muestra los clasificados en base al paginador y estado*/
		#$stmt = Conexion::conectar()->prepare("SELECT * FROM TClasificados LEFT JOIN Tgaleria_imagenes_clasificados ON TClasificados. idclasificado = Tgaleria_imagenes_clasificados. idclasificado WHERE TClasificados. idclasificado =Tgaleria_imagenes_clasificados. idclasificado AND TClasificados. estado = '1' ORDER BY TClasificados. idclasificado DESC LIMIT :id1, :id2");

		$stmt = Conexion::conectar()->prepare("SELECT * FROM TClasificados INNER JOIN Tgaleria_imagenes_clasificados ON TClasificados. idclasificado = Tgaleria_imagenes_clasificados. idclasificado INNER JOIN Tdetalles_caracteristicas_clasificados ON TClasificados. iddetalle_caracteristica_clasificado = Tdetalles_caracteristicas_clasificados. iddetalle_caracteristica_clasificado INNER JOIN Tcategorias ON Tdetalles_caracteristicas_clasificados. idcategoria = Tcategorias. idcategoria WHERE TClasificados. idclasificado =Tgaleria_imagenes_clasificados. idclasificado AND nombre_categoria = :cat AND TClasificados. estado = '1' ORDER BY TClasificados. idclasificado DESC LIMIT :id1, :id2");

		$stmt->bindParam(":cat", $datosModel, PDO::PARAM_INT);
		$stmt->bindParam(":id1", $datosModel1, PDO::PARAM_INT);
		$stmt->bindParam(":id2", $datosModel2, PDO::PARAM_INT);

		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();	
	}

	#MOSTRAR TODOS LOS PLANES DE ACUERDO A LA CATEGORIA
	#------------------------------------------------------
	public function MostrarPromoverMarcasModel($datosModel1, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT Tcat. idcategoria, nombre_categoria, imagen_categoria, Tsubcat. idsubcategoria, nombre_subcategoria, imagen_subcategoria, nombre_marca, imagen_marca FROM $tabla Tcat INNER JOIN Tsubcategorias Tsubcat ON Tcat. idcategoria = Tsubcat. idcategoria INNER JOIN TMarcas Tmar ON Tsubcat. idsubcategoria = Tmar. idsubcategoria WHERE Tcat. nombre_categoria = :cat AND Tmar. promover_marca = '1'");
		
		$stmt->bindParam(":cat", $datosModel1, PDO::PARAM_INT);

		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();

		/*$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();*/
	}

	#MOSTRAR ARTÍCULOS
	#------------------------------------------------------
	public function mostrarClasificadosEmpleosModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT idclasificados, titulo, descripcion, imagen, tipo_moneda, precio, fechacreacion FROM $tabla 
			INNER JOIN subcategorias S ON clasificados.idsubcategorias = S.idsubcategorias
			INNER JOIN categorias C ON S.idcategorias = C.idcategorias
			WHERE nombrecategoria = 'Trabajo - Empleos'
			ORDER BY idclasificados DESC
			");

		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute();
		return $stmt->fetchAll();


	}

	#MOSTRAR TODOS LOS VEHICULOS
	#------------------------------------------------------
	public function mostrarClasificadosVehiculosModel($datosModel1, $datosModel2, $tabla){

		#$stmt = Conexion::conectar()->prepare("SELECT idclasificados, titulo, descripcion, precio FROM $tabla");

		#$stmt = Conexion::conectar()->prepare("SELECT idclasificado, titulo, descripcion, tipo_moneda, precio FROM $tabla ORDER BY idclasificado DESC");
		/*$stmt = Conexion::conectar()->prepare("SELECT idclasificados, titulo, descripcion, imagen, tipo_moneda, precio FROM $tabla 
			INNER JOIN subcategorias S ON clasificados.idsubcategorias = S.idsubcategorias
			INNER JOIN categorias C ON S.idcategoria = C.idcategorias
			WHERE nombrecategoria = 'vehiculos' ORDER BY idclasificados DESC
			");
		*/
		#$stmt = Conexion::conectar()->prepare("SELECT TClas. idclasificado, titulo, descripcion, precio, celular, nombreimagen, TGalClas. idclasificado, nombreimagen FROM $tabla TClas INNER JOIN Tgaleria_imagenes_clasificados TGalClas ON TClas. idclasificado = TGalClas. idclasificado");

		#$stmt = Conexion::conectar()->prepare("SELECT idclasificado, titulo, descripcion FROM $tabla TClas INNER JOIN Tdetalles_caracteristicas_clasificados TDetC ON TClas. iddetalle_caracteristica_clasificado = TDetC. iddetalle_caracteristica_clasificado INNER JOIN Tcategorias TCat ON TDetC. idcategoria = TCat. idcategoria WHERE nombrecategoria = 'Vehiculos' ORDER BY TClas. idclasificado DESC");

		#$stmt = Conexion::conectar()->prepare("SELECT * FROM tclasificados LIMIT :id, 10");
		#$stmt = Conexion::conectar()->prepare("SELECT * FROM tclasificados ORDER BY idclasificado ASC LIMIT :id1, :id2");

		#$stmt = Conexion::conectar()->prepare("SELECT TClas. idclasificado, titulo, descripcion, nombreimagen FROM TClasificados TClas INNER JOIN Tgaleria_imagenes_clasificados TGal ON TClas. idclasificado = TGal. idclasificado");
		
		/*Muestra los clasificados en base al paginador */
		#$stmt = Conexion::conectar()->prepare("SELECT * FROM TClasificados LEFT JOIN Tgaleria_imagenes_clasificados ON TClasificados. idclasificado = Tgaleria_imagenes_clasificados. idclasificado WHERE TClasificados. idclasificado =Tgaleria_imagenes_clasificados. idclasificado ORDER BY TClasificados. idclasificado DESC LIMIT :id1, :id2");

		$stmt = Conexion::conectar()->prepare("SELECT * FROM TClasificados LEFT JOIN Tgaleria_imagenes_clasificados ON TClasificados. idclasificado = Tgaleria_imagenes_clasificados. idclasificado WHERE TClasificados. idclasificado =Tgaleria_imagenes_clasificados. idclasificado AND TClasificados. estado = '1' ORDER BY TClasificados. idclasificado DESC LIMIT :id1, :id2");

		$stmt->bindParam(":id1", $datosModel1, PDO::PARAM_INT);
		$stmt->bindParam(":id2", $datosModel2, PDO::PARAM_INT);

		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();	
	}

	#MOSTRAR TODOS LOS INMUEBLES
	#------------------------------------------------------
	public function mostrarClasificadosInmueblesModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT idclasificado, titulo, descripcion FROM $tabla TClas INNER JOIN Tdetalles_caracteristicas_clasificados TDetC ON TClas. iddetalle_caracteristica_clasificado = TDetC. iddetalle_caracteristica_clasificado INNER JOIN Tcategorias TCat ON TDetC. idcategoria = TCat. idcategoria WHERE nombrecategoria = 'Inmuebles' ORDER BY TClas. idclasificado DESC");

		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();	

	}


	#MOSTRAR TODAS LAS MAQUINARIAS
	#------------------------------------------------------
	public function mostrarClasificadosMaquinariasModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT idclasificados, titulo, descripcion, imagen, tipo_moneda, precio, fechacreacion FROM $tabla 
			INNER JOIN subcategorias S ON clasificados.idsubcategorias = S.idsubcategorias
			INNER JOIN categorias C ON S.idcategorias = C.idcategorias
			WHERE nombresubcategoria = 'maquinarias' ORDER BY idclasificados DESC
			");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();	

	}

	#MOSTRAR TODAS LAS MAQUINARIAS
	#------------------------------------------------------
	public function mostrarClasificadosMotosModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT idclasificados, titulo, descripcion, imagen, tipo_moneda, precio, fechacreacion FROM $tabla 
			INNER JOIN subcategorias S ON clasificados.idsubcategorias = S.idsubcategorias
			INNER JOIN categorias C ON S.idcategorias = C.idcategorias
			WHERE nombresubcategoria = 'motos' ORDER BY idclasificados DESC
			");

		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute();
		return $stmt->fetchAll();

	}

	#ACTUALIZA SALDO USUARIO
	#-------------------------------------
	public function listarCategoriasModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT idcategoria, nombre_categoria FROM $tabla");
		
		#$stmt->bindParam(":nombre_rol", $datosModel, PDO::PARAM_INT);	

		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();	

	}
}