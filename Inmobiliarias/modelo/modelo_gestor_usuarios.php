<?php

require_once "conexion.php";

class GestorUsuariosModel{

	#REGISTRO DE USUARIOS
	#-------------------------------------
	public function registroUsuarioModel(/*$id, */$datosModel, $tabla){


		$PDO = Conexion::conectar();
		$stmt= $PDO->prepare("INSERT INTO $tabla (/*idusuario, */usuario, password, email, cod_activacion) VALUES (/*:idusuario,*/ :usuario,:password,:email, :cod_activacion)");	
		
		#$PDO->beginTransaction();

		#$stmt->bindParam(":idusuario", $id, PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_activacion", $datosModel["cod_activacion"], PDO::PARAM_STR);
		if($stmt->execute()){
			$workorderid = $PDO->lastInsertId();
			return $workorderid;
			#return "success";
		}		
		else{
			return "error";
		}
	}

	#ASIGNAR ROL DE USUARIOS
	#-------------------------------------
	public function asignaRolUsuarioModel($datosModel, $datosModel1, $tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (idusuario, idrol) VALUES (:idusuario, :idrol)");
		$stmt->bindParam(":idusuario", $datosModel, PDO::PARAM_INT);
		$stmt->bindParam(":idrol", $datosModel1, PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}		
		else{
			return "error";

		}
	}

	#VALIDAR EMAIL EXISTENTE
	#-------------------------------------
	public function activarRegistroUsuarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = 1 WHERE idusuario = :id");

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

	#INGRESO USUARIO
	#-------------------------------------
	public function ingresoInmobilariaModel($datosModel, $tabla){

		#$stmt = Conexion::conectar()->prepare("SELECT idusuario, usuario, password, intentos FROM $tabla WHERE usuario = :usuario");
		$stmt = Conexion::conectar()->prepare("SELECT Tusu. idusuario, usuario, password, intentos, nombre_rol FROM $tabla Tusu INNER JOIN Tusuarios_roles ON Tusu. idusuario = Tusuarios_roles. idusuario INNER JOIN Troles ON Tusuarios_roles. idrol = Troles. idrol WHERE nombre_rol = 'inmobiliaria' AND usuario = :usuario");

		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}
	
	#INTENTOS USUARIO
	#-------------------------------------
	public function intentosUsuarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET intentos = :intentos WHERE usuario = :usuario");
		$stmt->bindParam(":intentos", $datosModel["actualizarIntentos"], PDO::PARAM_INT);
		$stmt->bindParam(":usuario", $datosModel["usuarioActual"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();
	}

	#VISTA USUARIOS
	#-------------------------------------

	public function vistaUsuariosModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT idusuarios, usuario, password, email FROM $tabla");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	#EDITAR USUARIO
	#-------------------------------------

	public function editarUsuarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id, usuario, password, email FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}

	#ACTUALIZAR USUARIO
	#-------------------------------------
	public function actualizarUsuarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario = :usuario, password = :password, email = :email WHERE id = :id");

		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}
	
	#BORRAR USUARIO
	#------------------------------------
	public function borrarUsuarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}

	#VALIDAR USUARIO EXISTENTE
	#-------------------------------------
	public function validarUsuarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT usuario FROM $tabla WHERE usuario = :usuario");
		$stmt->bindParam(":usuario", $datosModel, PDO::PARAM_STR);	
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}

	#VALIDAR EMAIL EXISTENTE
	#-------------------------------------
	public function validarEmailModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT email FROM $tabla WHERE email = :email");
		$stmt->bindParam(":email", $datosModel, PDO::PARAM_STR);	
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}

	#------------------------------------------------------
	public function contarClasificadosporUsuarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT COUNT(idclasificado) FROM TClasificados INNER JOIN Tusuarios ON TClasificados. idusuario = Tusuarios. idusuario WHERE TClasificados. estado = '1' AND TClasificados. idusuario = :usu ");

		$stmt->bindParam(":usu", $datosModel, PDO::PARAM_INT);

		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute();
		return $stmt->fetchAll();

	}

	#VALIDAR EMAIL EXISTENTE
	#-------------------------------------
	public function mostrarClasificadosPorUsuarioModel($datosModel, $datosModel1, $datosModel2, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT Tclasificados. idclasificado, titulo, descripcion, tipo_moneda, precio, celular, cod_revista, Tclasificados. fechacreacion, Tclasificados. idusuario, Tgaleria_imagenes_clasificados. idclasificado, nombreimagen FROM $tabla INNER JOIN Tgaleria_imagenes_clasificados ON Tclasificados. idclasificado = Tgaleria_imagenes_clasificados. idclasificado INNER JOIN Tdetalles_caracteristicas_clasificados ON Tclasificados. iddetalle_caracteristica_clasificado = Tdetalles_caracteristicas_clasificados. iddetalle_caracteristica_clasificado INNER JOIN Tcategorias ON Tdetalles_caracteristicas_clasificados. idcategoria = Tcategorias. idcategoria INNER JOIN Tusuarios ON Tclasificados. idusuario = Tusuarios. idusuario WHERE Tclasificados. idclasificado = Tgaleria_imagenes_clasificados. idclasificado /*AND nombre_categoria = 'vehiculos'*/ AND Tclasificados. idusuario = :usu AND Tclasificados. estado = '1' GROUP BY Tgaleria_imagenes_clasificados. idclasificado DESC LIMIT :id1, :id2");

		$stmt->bindParam(":usu", $datosModel, PDO::PARAM_STR);	
		$stmt->bindParam(":id1", $datosModel1, PDO::PARAM_INT);
		$stmt->bindParam(":id2", $datosModel2, PDO::PARAM_INT);

		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();	

	}
}