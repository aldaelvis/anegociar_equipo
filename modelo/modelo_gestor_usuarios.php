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
		#$PDO->commit(); 
			 
			#echo $waa->lastInsertId();
            #return $stmt->rowCount() > 0;
			#$latest_id = $stmt->lastInsertId();
		#	$id = $PDO->lastInsertId();
		#	print 'hola'.$id;


			
/*
		else{

			return "error";

		}
*/
		#$stmt->close();

/*
		$connection = Conexion::conectar();

		$connection->prepare("INSERT INTO $tabla (usuario, password, email) VALUES (:usuario,:password,:email)");

		$connection->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$connection->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$connection->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);

		// obtienes el ID
		//echo $connection->lastInsertId();
		#return $connection->lastInsertId();
		#return $id;

		if($connection->execute()){

			#echo $connection->lastInsertId();

			return $connection->rowCount() > 0;
			#return "success";

		}

		else{

			return "error";

		}

		$connection->close();
		*/

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
	public function ingresoUsuarioModel($datosModel, $tabla){

		#$stmt = Conexion::conectar()->prepare("SELECT idusuario, usuario, password, intentos FROM $tabla WHERE usuario = :usuario");
		$stmt = Conexion::conectar()->prepare("SELECT Tusu. idusuario, usuario, password, email, intentos, nombre_rol, estado FROM $tabla Tusu INNER JOIN Tusuarios_roles ON Tusu. idusuario = Tusuarios_roles. idusuario INNER JOIN Troles ON Tusuarios_roles. idrol = Troles. idrol WHERE estado = '1' AND nombre_rol = 'usuario' AND usuario = :usuario OR email = :usuario");


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

	public static function totalClasificadosPorUsuario($datosModel, $tabla)
    {
        $query = "SELECT Tclasificados. idclasificado, titulo, descripcion, tipo_moneda, precio, celular, cod_revista,
			Tclasificados. fechacreacion, Tclasificados. precio_tipo ,Tclasificados. estado,
		Tclasificados. idusuario
		FROM $tabla INNER JOIN Tdetalles_caracteristicas_clasificados
		ON Tclasificados. iddetalle_caracteristica_clasificado = Tdetalles_caracteristicas_clasificados. iddetalle_caracteristica_clasificado
		INNER JOIN Tusuarios ON Tclasificados. idusuario = Tusuarios. idusuario
		WHERE Tclasificados. titulo LIKE '%" . $datosModel['buscar'] . "%'
		AND Tclasificados. idusuario = :usu ";
        $stmt = Conexion::conectar()->prepare($query);
        $stmt->bindParam(":usu", $datosModel["idusuario"], PDO::PARAM_INT);
        $stmt->execute();
        $num_filas = $stmt->rowCount();
        return $num_filas;
    }

    //MOSTRAR CLASIFICADOS POR USUARIO
    public static function mostrarClasificadosModel($datosModel, $tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT Tclasificados. idclasificado, titulo, descripcion,
        tipo_moneda, precio, celular, cod_revista, Tclasificados. fechacreacion,precio_tipo,Tclasificados. estado,
        Tclasificados. idusuario, Tcategorias.nombre_categoria,
        Tgaleria_imagenes_clasificados. idclasificado, nombreimagen
        FROM $tabla
        INNER JOIN Tgaleria_imagenes_clasificados
        ON Tclasificados. idclasificado = Tgaleria_imagenes_clasificados. idclasificado
        INNER JOIN Tdetalles_caracteristicas_clasificados
        ON Tclasificados. iddetalle_caracteristica_clasificado = Tdetalles_caracteristicas_clasificados. iddetalle_caracteristica_clasificado
        INNER JOIN Tcategorias ON Tdetalles_caracteristicas_clasificados. idcategoria = Tcategorias. idcategoria
        INNER JOIN Tusuarios ON Tclasificados. idusuario = Tusuarios. idusuario
        WHERE  Tclasificados. titulo LIKE '%" . $datosModel['buscar'] . "%' AND Tclasificados. idclasificado = Tgaleria_imagenes_clasificados. idclasificado
        AND Tclasificados. idusuario = :id
        GROUP BY Tgaleria_imagenes_clasificados. idclasificado
        DESC LIMIT :id1, :id2");

        $stmt->bindParam(":id", $datosModel["idusuario"], PDO::PARAM_INT);
        $stmt->bindParam(":id1", $datosModel["param1"], PDO::PARAM_INT);
        $stmt->bindParam(":id2", $datosModel["param2"], PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    #Editar clasificado x user
    public static function editarClasificadosUserModel($datoscontrolador, $tabla)
    {
        $PDO = Conexion::conectar();
        try {
            $query = "UPDATE $tabla SET titulo=:titulo, descripcion=:descripcion,
			tipo_moneda=:tipo_moneda, precio=:precio, celular=:celular, precio_tipo=:precio_tipo
			WHERE idclasificado=:idclasificado ";
            $stmt = $PDO->prepare($query);
            $stmt->bindParam(':titulo', $datoscontrolador["titulo"], PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $datoscontrolador["descripcion"], PDO::PARAM_STR);
            $stmt->bindParam(':tipo_moneda', $datoscontrolador["tipo_moneda"], PDO::PARAM_STR);
            $stmt->bindParam(':precio', $datoscontrolador["precio"], PDO::PARAM_STR);
            $stmt->bindParam(':celular', $datoscontrolador["celular"], PDO::PARAM_STR);
            $stmt->bindParam(':precio_tipo', $datoscontrolador["precio_tipo"], PDO::PARAM_STR);
            $stmt->bindParam(':idclasificado', $datoscontrolador["idclasificado"], PDO::PARAM_INT);
            $stmt->execute();
            $stmt->closeCursor();
            return "200";
        } catch (PDOException $e) {
            return print_r($e->getMessage());
        }
    }

    #Desactivar clasificados
    public static function desactivarClasificado($idclasificado)
    {
        $cn = Conexion::conectar();
        $query = "UPDATE tclasificados SET estado = '0' WHERE idclasificado = :idclasificado ";
        $stmt = $cn->prepare($query);
        $stmt->bindParam(':idclasificado', $idclasificado, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        return "OK";
    }

    #Activar clasificados
    public static function activarClasificado($idclasificado)
    {
        $cn = Conexion::conectar();
        $query = "UPDATE tclasificados SET estado = '1' WHERE idclasificado = :idclasificado ";
        $stmt = $cn->prepare($query);
        $stmt->bindParam(':idclasificado', $idclasificado, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        return "OK";
    }

    #Mostramos información del usuario
    public static function mostrarInformacionUserModel($datosModel, $tabla)
    {
        $query = "SELECT Tusu.idusuario, Tusu.usuario, Tusu.saldo_usuario, Tusu.email, Tusu.nombres,Tusu.apellidos,Tusu.foto,
                  Tusu.pais,Tusu.departamento,Tusu.provincia,Tusu.distrito,Tusu.direccion FROM $tabla Tusu
                  INNER JOIN Tusuarios_roles ON Tusu. idusuario = Tusuarios_roles. idusuario
                  INNER JOIN Troles ON Tusuarios_roles. idrol = Troles. idrol
                  WHERE Tusu. idusuario = :usu";
        $stmt = Conexion::conectar()->prepare($query);
        $stmt->bindParam(":usu", $datosModel, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    //OBTENER INFO SALDO USUARIO
    public static function infoSaldoUsuarioModel($datos, $tabla)
    {
        $cursor = Conexion::conectar();
        $stmt = $cursor->prepare("SELECT saldo_usuario FROM $tabla WHERE idusuario = :idusuario");
        $stmt->bindParam('idusuario', $datos, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //ACTUALIZAR SALDO USUARIO UNA VEZ COMPRADO
    public static function actualizarSaldoUsuarioModel($datos, $tabla) {
        $cursor = Conexion::conectar();
        $stmt = $cursor->prepare("UPDATE $tabla SET saldo_usuario = :saldo WHERE idusuario = :id");
        $stmt->bindParam(':saldo', $datos['saldo'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $datos['idusuario'], PDO::PARAM_INT);
        $stmt->execute();
    }
}