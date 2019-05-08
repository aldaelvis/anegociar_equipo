<?php

require_once "conexion.php";

class GestorUsuariosModel{
	#mostrar ubicaciones departamentos -> elvis
	public function mostrarusuariosAjaxModel($tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

		#return $stmt->fetch();
		$stmt->execute();
		return $stmt->fetchAll();

		#$stmt->close();	
	}

	public static function mostrarUsuarioModel($datos, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT tusu. idusuario, tusu. usuario, tusu. nombres, tusu. apellidos, 
		tusu. saldo_usuario, tusu. fechacreacion, tusu. email, tusu. password, tusu. estado FROM $tabla tusu 
		INNER JOIN tusuarios_roles tusu_rol ON tusu. idusuario = tusu_rol. idusuario
		INNER JOIN troles trol ON tusu_rol. idrol = trol. idrol
		WHERE trol. nombre_rol = 'agente' AND tusu. idusuario = :idusuario ");
		$stmt->bindParam(":idusuario", $datos, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

	public static function listarUsuariosModel($tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT tusu. idusuario, tusu. usuario, tusu. nombres, tusu. apellidos, tusu. email, tusu. saldo_usuario, tusu .fechacreacion, tusu .estado FROM $tabla tusu 
		INNER JOIN Tusuarios_roles tusu_rol ON tusu. idusuario = tusu_rol. idusuario
		INNER JOIN Troles trol ON tusu_rol. idrol = trol. idrol
		WHERE trol. nombre_rol = 'agente' ORDER BY tusu. idusuario DESC");
		$stmt->execute();
		return $stmt->fetchAll();
	}

	#VERIFICAR IDROL ATRAVES DEL NOMBRE_ROL
	#-------------------------------------
	public static function verificarIdRolModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT idrol, nombre_rol FROM $tabla  WHERE nombre_rol = :rol");
		$stmt->bindParam(":rol", $datosModel, PDO::PARAM_STR);	
		$stmt->execute();
		return $stmt->fetch();
	}

	#REGISTRO DE USUARIOS
	#-------------------------------------
	public static function nuevoUsuarioModel($datosModel, $tabla)
	{
		$cn = Conexion::conectar();
		$cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$cn->beginTransaction();

		$queryusuario = "INSERT INTO $tabla (usuario, password, email, nombres, apellidos, cod_activacion,fechacreacion, saldo_usuario, estado) VALUES (:usuario, :password, :email, :nombres, :apellidos, :cod_activacion, CURDATE(), :saldo_usuario, :estado)";

		$query_rol_usuario = "INSERT INTO tusuarios_roles (idusuario, idrol) VALUES (:idusuario, :idrol)";
		try{
			$stmt= $cn->prepare($queryusuario);	
			$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
			$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
			$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
			$stmt->bindParam(":nombres", $datosModel["nombres"], PDO::PARAM_STR);
			$stmt->bindParam(":apellidos", $datosModel["apellidos"], PDO::PARAM_STR);		
			$stmt->bindParam(":cod_activacion", $datosModel["cod_activacion"], PDO::PARAM_STR);
			$stmt->bindParam(":saldo_usuario", $datosModel["saldo_usuario"], PDO::PARAM_STR);
			$stmt->bindParam(":estado", $datosModel["estado"], PDO::PARAM_STR);
			$stmt->execute();
			$idusuario = $cn->lastInsertId();

			$stmt = $cn->prepare($query_rol_usuario);
			$stmt->bindParam(":idusuario", $idusuario, PDO::PARAM_INT);
			$stmt->bindParam(":idrol", $datosModel["idrol"], PDO::PARAM_INT);
			$stmt->execute();
			$cn->commit();
			$stmt->closeCursor();
			return "OK";
		}catch(PDOException $e){
			return $e;
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

	#INGRESO USUARIO
	#-------------------------------------
	public function ingresoUsuarioAdminModel($datosModel, $tabla){

		#$stmt = Conexion::conectar()->prepare("SELECT idusuario, usuario, password, intentos FROM $tabla WHERE usuario = :usuario");
		$stmt = Conexion::conectar()->prepare("SELECT Tusu. idusuario, usuario, password, intentos, nombre_rol FROM $tabla Tusu INNER JOIN Tusuarios_roles ON Tusu. idusuario = Tusuarios_roles. idusuario INNER JOIN Troles ON Tusuarios_roles. idrol = Troles. idrol WHERE nombre_rol = 'admin' AND usuario = :usuario");

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

	// public static function editarUsuarioModel($datosModel, $tabla){

	// 	$stmt = Conexion::conectar()->prepare("SELECT idusuario, usuario, password, email FROM $tabla WHERE idusuario = :id");
	// 	$stmt->bindParam(":id", $datosModel["idusuario"], PDO::PARAM_INT);	
	// 	$stmt->execute();
	// 	return "OK";
	// }

	#ACTUALIZAR USUARIO
	#-------------------------------------
	public static function editarUsuarioModel($datosModel, $tabla){
		try{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario = :usuario, password = :password, email = :email WHERE idusuario = :id");
			$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
			$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
			$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
			$stmt->bindParam(":id", $datosModel["idusuario"], PDO::PARAM_INT);
			if($stmt->execute()){
				return "OK";	
			}
		}catch(PDOException $e){
			return $e;
		}
	}

	#RECARGAR SALDO USUARIO
	public static function recargarSaldoUsuarioModel($datos, $tabla){
		try{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET saldo_usuario = :saldo_usuario WHERE idusuario = :id");
			$stmt->bindParam(":saldo_usuario", $datos["saldo_usuario"], PDO::PARAM_STR);
			$stmt->bindParam(":id", $datos["idusuario"], PDO::PARAM_INT);
			if($stmt->execute()){
				return "OK";	
			}
		}catch(PDOException $e){
			return $e;
		}
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

	#ACTIVAR Y DESACTIVAR USUAURIOS
	public static function activarUsuarioModel($datosModel, $tabla){
		try{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = 1 WHERE idusuario = :id");
			$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
			if($stmt->execute()){
				return "OK";	
			}
		}catch(PDOException $e){
			return $e;
		}
	}

	public static function desactivarUsuarioModel($datosModel, $tabla){
		try{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = 0 WHERE idusuario = :id");
			$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
			if($stmt->execute()){
				return "OK";	
			}
		}catch(PDOException $e){
			return $e;
		}
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

		$stmt = Conexion::conectar()->prepare("SELECT TClasificados. idclasificado, titulo, descripcion, tipo_moneda, precio, celular, cod_revista, TClasificados. idusuario, Tgaleria_imagenes_clasificados. idclasificado, nombreimagen FROM $tabla INNER JOIN Tgaleria_imagenes_clasificados ON TClasificados. idclasificado = Tgaleria_imagenes_clasificados. idclasificado INNER JOIN Tdetalles_caracteristicas_clasificados ON TClasificados. iddetalle_caracteristica_clasificado = Tdetalles_caracteristicas_clasificados. iddetalle_caracteristica_clasificado INNER JOIN Tusuarios ON TClasificados. idusuario = Tusuarios. idusuario WHERE TClasificados. idclasificado = Tgaleria_imagenes_clasificados. idclasificado /*AND nombre_categoria = 'vehiculos'*/ AND TClasificados. idusuario = :usu AND TClasificados. estado = '1' GROUP BY Tgaleria_imagenes_clasificados. idclasificado DESC LIMIT :id1, :id2");

		$stmt->bindParam(":usu", $datosModel, PDO::PARAM_STR);	
		$stmt->bindParam(":id1", $datosModel1, PDO::PARAM_INT);
		$stmt->bindParam(":id2", $datosModel2, PDO::PARAM_INT);

		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();	

	}

	#SALDO USUARIO
	#-------------------------------------
	public function saldoUsuarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT Tusu. idusuario, usuario, password, intentos, saldo_usuario FROM $tabla Tusu INNER JOIN Tusuarios_roles ON Tusu. idusuario = Tusuarios_roles. idusuario INNER JOIN Troles ON Tusuarios_roles. idrol = Troles. idrol WHERE nombre_rol = 'admin' AND Tusu. idusuario = :usu");
		
		$stmt->bindParam(":usu", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
	}

	#ACTUALIZA SALDO USUARIO
	#-------------------------------------
	public function actsal($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT Tusu. idusuario, usuario, password, intentos, saldo_usuario FROM $tabla Tusu INNER JOIN Tusuarios_roles ON Tusu. idusuario = Tusuarios_roles. idusuario INNER JOIN Troles ON Tusuarios_roles. idrol = Troles. idrol WHERE nombre_rol = 'agente' AND Tusu. idusuario = :usu");
		
		$stmt->bindParam(":usu", $datosModel, PDO::PARAM_INT);	

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario = :usuario, password = :password, email = :email WHERE id = :id");

	}

	#ACTUALIZA USUARIO POR ROL
	#-------------------------------------
	public function listarUsuariosPorRolModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT Tusu. idusuario, usuario, password, intentos, saldo_usuario, email, nombres, estado FROM $tabla Tusu INNER JOIN Tusuarios_roles ON Tusu. idusuario = Tusuarios_roles. idusuario INNER JOIN Troles ON Tusuarios_roles. idrol = Troles. idrol WHERE nombre_rol = :nombre_rol ORDER BY Tusu. idusuario DESC");
		
		$stmt->bindParam(":nombre_rol", $datosModel, PDO::PARAM_INT);	

		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();	

	}

	#EDITAR USUARIO POR ROL
	#-------------------------------------

	public function editarUsuarioPorRolModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT idusuario, usuario, password, email FROM $tabla WHERE idusuario = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}

	#ACTUALIZAR USUARIO POR ROL
	#-------------------------------------
	public function actualizarUsuarioPorRolModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario = :usuario/*, password = :password*/, email = :email WHERE idusuario = :id");

		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		#$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);

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
	public function actualizarUsuarioPorRolAjaxModel($datosModel, $tabla){
/*
		$stmt = Conexion::conectar()->prepare("SELECT usuario FROM $tabla WHERE usuario = :usuario");
		$stmt->bindParam(":usuario", $datosModel, PDO::PARAM_STR);	
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
*/

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario = :usuario/*, password = :password*/, email = :email WHERE idusuario = :id");

		$stmt->bindParam(":id", $datosModel["userId"], PDO::PARAM_INT);
		$stmt->bindParam(":usuario", $datosModel["firstName"], PDO::PARAM_STR);
		#$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}

	#ACTUALIZAR USUARIO
	#-------------------------------------
	public function actualizarSaldoUsuarioModel($datosModel, $datosModel1, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET saldo_usuario = :saldo_usuario WHERE idusuario = :idusuario");

		$stmt->bindParam(":saldo_usuario", $datosModel, PDO::PARAM_INT);
		$stmt->bindParam(":idusuario", $datosModel1, PDO::PARAM_INT);

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}
}