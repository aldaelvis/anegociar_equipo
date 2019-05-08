<?php

require_once "conexion.php";

class GestorUsuariosModel
{

    #INGRESO USUARIO
    #-------------------------------------
    public function ingresoUsuarioAgenteModel($datosModel, $tabla)
    {

        #$stmt = Conexion::conectar()->prepare("SELECT idusuario, usuario, password, intentos FROM $tabla WHERE usuario = :usuario");
        $stmt = Conexion::conectar()->prepare("SELECT Tusu. idusuario, usuario, password, intentos, nombre_rol FROM $tabla Tusu INNER JOIN Tusuarios_roles ON Tusu. idusuario = Tusuarios_roles. idusuario INNER JOIN Troles ON Tusuarios_roles. idrol = Troles. idrol WHERE nombre_rol = 'agente' AND usuario = :usuario");

        $stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
    }

    #INTENTOS USUARIO
    #-------------------------------------
    public function intentosUsuarioModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET intentos = :intentos WHERE usuario = :usuario");
        $stmt->bindParam(":intentos", $datosModel["actualizarIntentos"], PDO::PARAM_INT);
        $stmt->bindParam(":usuario", $datosModel["usuarioActual"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "success";
        } else {

            return "error";
        }

        $stmt->close();
    }

    #VISTA USUARIOS
    #-------------------------------------

    public function vistaUsuariosModel($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT idusuarios, usuario, password, email FROM $tabla");
        $stmt->execute();

        return $stmt->fetchAll();
        $stmt->close();

    }

    #EDITAR USUARIO
    #-------------------------------------

    public function editarUsuarioModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT id, usuario, password, email FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

    }

    #ACTUALIZAR USUARIO
    #-------------------------------------
    public function actualizarUsuarioModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario = :usuario, password = :password, email = :email WHERE id = :id");

        $stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "success";

        } else {

            return "error";

        }

        $stmt->close();

    }

    #BORRAR USUARIO
    #------------------------------------
    public function borrarUsuarioModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "success";

        } else {

            return "error";

        }

        $stmt->close();

    }

    #VALIDAR USUARIO EXISTENTE
    #-------------------------------------
    public function validarUsuarioModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT usuario FROM $tabla WHERE usuario = :usuario");
        $stmt->bindParam(":usuario", $datosModel, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

    }

    #VALIDAR EMAIL EXISTENTE
    #-------------------------------------
    public function validarEmailModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT email FROM $tabla WHERE email = :email");
        $stmt->bindParam(":email", $datosModel, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

    }

    #------------------------------------------------------
    public function contarClasificadosporUsuarioModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT COUNT(idclasificado) FROM TClasificados INNER JOIN Tusuarios ON TClasificados. idusuario = Tusuarios. idusuario WHERE TClasificados. estado = '1' AND TClasificados. idusuario = :usu ");

        $stmt->bindParam(":usu", $datosModel, PDO::PARAM_INT);

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchAll();

    }

    #VALIDAR EMAIL EXISTENTE
    #-------------------------------------

    public function mostrarClasificadosPorUsuarioModel($datosModel, $datosModel1, $datosModel2, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT Tclasificados. idclasificado, titulo, descripcion, tipo_moneda, precio, celular, cod_revista, Tclasificados. idusuario, Tgaleria_imagenes_clasificados. idclasificado, nombreimagen FROM $tabla INNER JOIN Tgaleria_imagenes_clasificados ON Tclasificados. idclasificado = Tgaleria_imagenes_clasificados. idclasificado INNER JOIN Tdetalles_caracteristicas_clasificados ON Tclasificados. iddetalle_caracteristica_clasificado = Tdetalles_caracteristicas_clasificados. iddetalle_caracteristica_clasificado INNER JOIN Tusuarios ON Tclasificados. idusuario = Tusuarios. idusuario WHERE Tclasificados. idclasificado = Tgaleria_imagenes_clasificados. idclasificado /*AND nombre_categoria = 'vehiculos'*/ AND Tclasificados. idusuario = :usu AND Tclasificados. estado = '1' GROUP BY Tgaleria_imagenes_clasificados. idclasificado DESC LIMIT :id1, :id2");

        $stmt->bindParam(":usu", $datosModel, PDO::PARAM_STR);
        $stmt->bindParam(":id1", $datosModel1, PDO::PARAM_INT);
        $stmt->bindParam(":id2", $datosModel2, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll();

        $stmt->close();

    }


    #SALDO USUARIO
    #-------------------------------------
    public function saldoUsuarioModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT Tusu. idusuario, usuario, password, intentos, saldo_usuario FROM $tabla Tusu INNER JOIN Tusuarios_roles ON Tusu. idusuario = Tusuarios_roles. idusuario INNER JOIN Troles ON Tusuarios_roles. idrol = Troles. idrol WHERE nombre_rol = 'agente' AND Tusu. idusuario = :usu");

        $stmt->bindParam(":usu", $datosModel, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();
    }

    #ACTUALIZA SALDO USUARIO
    #-------------------------------------
    public function actsal($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT Tusu. idusuario, usuario, password, intentos, saldo_usuario FROM $tabla Tusu INNER JOIN Tusuarios_roles ON Tusu. idusuario = Tusuarios_roles. idusuario INNER JOIN Troles ON Tusuarios_roles. idrol = Troles. idrol WHERE nombre_rol = 'agente' AND Tusu. idusuario = :usu");

        $stmt->bindParam(":usu", $datosModel, PDO::PARAM_INT);

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario = :usuario, password = :password, email = :email WHERE id = :id");

    }

    #ACTUALIZAR USUARIO
    #-------------------------------------
    public function actualizarSaldoUsuarioModel($datosModel, $datosModel1, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET saldo_usuario = :saldo_usuario WHERE idusuario = :idusuario");

        $stmt->bindParam(":saldo_usuario", $datosModel, PDO::PARAM_INT);
        $stmt->bindParam(":idusuario", $datosModel1, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "success";

        } else {

            return "error";

        }

        $stmt->close();

    }

    # ###########################
    //----------------------------------- elvis (beta)
    public function mostrarClasificadosPorUsuario($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT Tclasificados. idclasificado, titulo, descripcion, tipo_moneda, precio, celular, cod_revista,
			tclasificados.fechacreacion, tclasificados.precio_tipo ,tclasificados.estado,
		Tclasificados. idusuario, Tgaleria_imagenes_clasificados. idclasificado, nombreimagen
		FROM $tabla INNER JOIN Tgaleria_imagenes_clasificados
		ON Tclasificados. idclasificado = Tgaleria_imagenes_clasificados. idclasificado
		INNER JOIN Tdetalles_caracteristicas_clasificados
		ON Tclasificados. iddetalle_caracteristica_clasificado = Tdetalles_caracteristicas_clasificados. iddetalle_caracteristica_clasificado
		INNER JOIN Tusuarios ON Tclasificados. idusuario = Tusuarios. idusuario
		WHERE Tclasificados. idclasificado = Tgaleria_imagenes_clasificados. idclasificado
		AND Tclasificados. idusuario = :usu GROUP BY Tgaleria_imagenes_clasificados. idclasificado ORDER BY Tclasificados. idclasificado DESC
		");

        $stmt->bindParam(":usu", $datosModel, PDO::PARAM_STR);

        $stmt->execute();

        #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement.
        return $stmt->fetchAll();
        $stmt->close();

    }

    ##Paginacion de registros con los ultimos clasificacdos
    public function listarClasificadosModel($idusuario, $pagina, $buscar)
    {
        #Inicializamos el tamaño de la pagina
        $tamaño_pagina = 8;
        #Iniciamos en donde iniciara la pagina
        $empezar_desde = ($pagina - 1) * $tamaño_pagina;
        #Inicializamos el array de datos que devolvera la paginación
        $datos = array();


        $query = "SELECT Tclasificados. idclasificado
		FROM Tclasificados INNER JOIN Tgaleria_imagenes_clasificados
		ON Tclasificados. idclasificado = Tgaleria_imagenes_clasificados. idclasificado
		INNER JOIN Tdetalles_caracteristicas_clasificados
		ON Tclasificados. iddetalle_caracteristica_clasificado = Tdetalles_caracteristicas_clasificados. iddetalle_caracteristica_clasificado
		INNER JOIN Tusuarios ON Tclasificados. idusuario = Tusuarios. idusuario
		WHERE Tclasificados. titulo LIKE '%$buscar%' AND Tclasificados. idclasificado = Tgaleria_imagenes_clasificados. idclasificado
		AND Tclasificados. idusuario = $idusuario GROUP BY Tgaleria_imagenes_clasificados. idclasificado";
        $stmt = Conexion::conectar()->prepare($query);
        $stmt->execute(array());
        $num_filas = $stmt->rowCount();
        $total_paginas = (int)ceil($num_filas / $tamaño_pagina);
        $from = ($pagina * $tamaño_pagina) - $tamaño_pagina;
        $to = ($pagina * $tamaño_pagina);

        $query2 = "SELECT Tclasificados. idclasificado, titulo, descripcion, tipo_moneda, precio, celular, cod_revista,
			Tclasificados. fechacreacion, Tclasificados. precio_tipo ,Tclasificados. estado, tcat.nombre_categoria,
		Tclasificados. idusuario, Tgaleria_imagenes_clasificados. idclasificado, nombreimagen
		FROM Tclasificados INNER JOIN Tgaleria_imagenes_clasificados
		ON Tclasificados. idclasificado = Tgaleria_imagenes_clasificados. idclasificado
		INNER JOIN Tdetalles_caracteristicas_clasificados
		ON Tclasificados. iddetalle_caracteristica_clasificado = Tdetalles_caracteristicas_clasificados. iddetalle_caracteristica_clasificado
		INNER JOIN tcategorias tcat ON tdetalles_caracteristicas_clasificados.idcategoria = tcat. idcategoria
		INNER JOIN Tusuarios ON Tclasificados. idusuario = Tusuarios. idusuario
		WHERE Tclasificados. titulo LIKE '%$buscar%' AND Tclasificados. idclasificado = Tgaleria_imagenes_clasificados. idclasificado
		AND Tclasificados. idusuario = $idusuario GROUP BY Tgaleria_imagenes_clasificados. idclasificado
		ORDER BY Tclasificados. idclasificado DESC LIMIT $empezar_desde, $tamaño_pagina ";
        $stmt = Conexion::conectar()->prepare($query2);
        $stmt->execute();
        $datos = $stmt->fetchAll();

        return $total_array = array(
            "datos" => $datos,
            "paginacion" => array(
                "total" => $num_filas,
                "current_page" => (int)$pagina,
                "per_page" => $tamaño_pagina,
                "last_page" => $total_paginas,
                "from" => $from,
                "to" => $to,
            )
        );
    }

    // ---------------------------mostrar clasificado(editar) -> elvis
    public function mostrarClasifModel($idclasificado)
    {
        $query = "SELECT tclas. idclasificado, titulo, descripcion, tipo_moneda, precio, celular, tipo_moneda,
        precio_tipo, cod_revista, mostrar_en_revista, descripcion_revista, fechacreacion,
        TGalClas. idclasificado, nombreimagen,
        tcat. idcategoria, tsubcat. idsubcategoria, nombre_marca, nombre_modelo, fabricacion_vehiculo, tipo_modelo_vehiculo, tipo_combustible, tipo_transmision,
        condicion_vehiculo,
        kilometraje_vehiculo, tdep. iddepartamento, tpro. idprovincia, tdis. nombredistrito, tdis. iddistrito
        FROM Tgaleria_imagenes_clasificados TGalClas
        INNER JOIN Tclasificados tclas
        ON TGalClas. idclasificado = tclas. idclasificado
        INNER JOIN Tdetalles_caracteristicas_clasificados tdetcar
        on tdetcar. iddetalle_caracteristica_clasificado = tclas. iddetalle_caracteristica_clasificado
        INNER JOIN Tcategorias tcat
        on tcat. idcategoria = tdetcar. idcategoria
        INNER JOIN Tsubcategorias tsubcat
        on tsubcat. idsubcategoria = tdetcar. idsubcategoria
        LEFT JOIN Tmarcas tmar
        on tmar. idmarca = tdetcar. idmarca
        LEFT JOIN Tmodelos tmod
        on tmod. idmodelo = tdetcar. idmodelo
        INNER JOIN Tdetalles_ubicaciones_clasificados tdetubi
        on tdetubi. iddetalle_ubicacion_clasificado = tclas. iddetalle_ubicacion_clasificado
        INNER JOIN Tpaises TPais
        ON tdetubi. idpais = TPais. idpais
        INNER JOIN Tdepartamentos tdep
        on tdep. iddepartamento = tdetubi. iddepartamento
        INNER JOIN Tprovincias tpro
        on tpro. idprovincia = tdetubi. iddepartamento
        INNER JOIN Tdistritos tdis
        on tdis. iddistrito = tdetubi. iddistrito
        WHERE tclas. idclasificado = :idclasificado
        GROUP BY TGalClas. idclasificado";
        $stmt = Conexion::conectar()->prepare($query);
        $stmt->bindParam(":idclasificado", $idclasificado, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

    public function editarClasificadosUserModel($idclasificado, $titulo, $descripcion, $tipo_moneda, $precio, $celular, $precio_tipo)
    {
        $PDO = Conexion::conectar();
        $query = "UPDATE tclasificados SET titulo=:titulo, descripcion=:descripcion, 
			tipo_moneda=:tipo_moneda, precio=:precio, celular=:celular, precio_tipo=:precio_tipo
			WHERE idclasificado=:idclasificado ";
        $stmt = $PDO->prepare($query);
        $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_moneda', $tipo_moneda, PDO::PARAM_STR);
        $stmt->bindParam(':precio', $precio, PDO::PARAM_STR);
        $stmt->bindParam(':celular', $celular, PDO::PARAM_STR);
        $stmt->bindParam(':precio_tipo', $precio_tipo, PDO::PARAM_STR);
        $stmt->bindParam(':idclasificado', $idclasificado, PDO::PARAM_INT);
        $stmt->execute();
        return "200";
    }

    ##Desactivar clasificado
    public function desactivarClasificado($idclasificado)
    {
        try {
            $PDO = Conexion::conectar();
            $query = "UPDATE Tclasificados SET estado = '0' WHERE idclasificado = :idclasificado";
            $stmt = $PDO->prepare($query);
            $stmt->bindParam(':idclasificado', $idclasificado, PDO::PARAM_STR);
            $stmt->execute();
            return "OK";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    ##Activar clasificado
    public function activarClasificado($idclasificado)
    {
        $PDO = Conexion::conectar();
        $query = "UPDATE Tclasificados SET estado = '1' WHERE idclasificado = :idclasificado";
        $stmt = $PDO->prepare($query);
        $stmt->bindParam(':idclasificado', $idclasificado, PDO::PARAM_STR);
        $stmt->execute();
        echo "OK";
    }

    #devolver imagenes clasificados - - (beta)
    public function mostrarImagenesClasificadosModel($idclasificado)
    {
        $PDO = Conexion::conectar();
        $query = "SELECT t.idclasificado, tc.nombreimagen
		FROM tclasificados t INNER JOIN tgaleria_imagenes_clasificados tc
		ON t.idclasificado = tc.idclasificado
		WHERE t.idclasificado = :idclasificado";
        $stmt = $PDO->prepare($query);
        $stmt->bindParam(':idclasificado', $idclasificado, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //devolver Movimientos de los clasificados
    public function movimientosModel($idusuario, $pagina, $buscar)
    {
        $PDO = Conexion::conectar();

        $tamaño_pagina = 10;
        $empezar_desde = ($pagina - 1) * $tamaño_pagina;
        $datos = array();
        $query = "SELECT tclas. cod_revista, tclas. titulo, tclas. fechacreacion, tdet_plan. idplan_revista, tplan_r. precio_plan_revista,
		tdet_plan. idplan_web, tplan_w. precio_plan_web
		FROM Tclasificados tclas INNER JOIN Tdetalles_planes_clasificados tdet_plan
		ON tdet_plan. iddetalle_plan_clasificado = tclas. iddetalle_plan_clasificado
		LEFT JOIN Tplanes_revista tplan_r ON tdet_plan. idplan_revista = tplan_r. idplan_revista
		LEFT JOIN Tplanes_web tplan_w ON tdet_plan. idplan_web = tplan_w. idplan_web
		WHERE tclas. titulo LIKE '%$buscar%' AND tclas. idusuario = $idusuario";
        $stmt = Conexion::conectar()->prepare($query);
        $stmt->execute(array());
        $num_filas = $stmt->rowCount();
        $total_paginas = (int)ceil($num_filas / $tamaño_pagina);
        $from = ($pagina * $tamaño_pagina) - $tamaño_pagina;
        $to = ($pagina * $tamaño_pagina);

        $query2 = "SELECT tclas. cod_revista, tclas. titulo, tclas. fechacreacion, tdet_plan. idplan_revista, tplan_r. precio_plan_revista,
		tdet_plan. idplan_web, tplan_w. precio_plan_web
		FROM Tclasificados tclas INNER JOIN Tdetalles_planes_clasificados tdet_plan
		ON tdet_plan. iddetalle_plan_clasificado = tclas. iddetalle_plan_clasificado
		LEFT JOIN Tplanes_revista tplan_r ON tdet_plan. idplan_revista = tplan_r. idplan_revista
		LEFT JOIN Tplanes_web tplan_w ON tdet_plan. idplan_web = tplan_w. idplan_web
		WHERE tclas. titulo LIKE '%$buscar%' AND tclas. idusuario = $idusuario  
		ORDER BY tclas. idclasificado DESC LIMIT $empezar_desde, $tamaño_pagina";
        $stmt = $PDO->prepare($query2);
        $stmt->execute(array());
        $datos = $stmt->fetchAll();
        return $arrayTotal = array(
            "datos" => $datos,
            "paginacion" => array(
                "total" => $num_filas,
                "current_page" => (int)$pagina,
                "per_page" => $tamaño_pagina,
                "last_page" => $total_paginas,
                "from" => $from,
                "to" => $to,
            )
        );
    }

    #TOTAL DE MOVIMIENTOS
    public function totalMovimientos($idusuario)
    {
        $PDO = Conexion::conectar();
        $query = "SELECT tplan_r.precio_plan_revista,tplan_w.precio_plan_web
		FROM tclasificados tclas INNER JOIN tdetalles_planes_clasificados tdet_plan
		ON tdet_plan.iddetalle_plan_clasificado = tclas.iddetalle_plan_clasificado
		LEFT JOIN tplanes_revista tplan_r ON tdet_plan.idplan_revista = tplan_r.idplan_revista
		LEFT JOIN tplanes_web tplan_w ON tdet_plan.idplan_web = tplan_w.idplan_web
		WHERE tclas.idusuario = $idusuario";
        $stmt = $PDO->prepare($query);
        $stmt->execute();
        $datos = $stmt->fetchAll();
        return $datos;
    }

    //ULTIMOS CAMBIOS
    public static function reducirSaldoUsuario($id, $cantidad)
    {
        $cn = Conexion::conectar();
        $query = "UPDATE tusuarios SET saldo_usuario = :cantidad WHERE idusuario = :idusuario";
        $stmt = $cn->prepare($query);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_STR);
        $stmt->bindParam(':idusuario', $id, PDO::PARAM_INT);
        $stmt->execute();
    }


}
