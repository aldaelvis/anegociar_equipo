<?php

require_once "conexion.php";

class GestorUsuariosModel
{
    #REGISTRO DE USUARIOS
    #-------------------------------------
    public function registroUsuarioModel($datosModel, $tabla)
    {
        $PDO = Conexion::conectar();
        $stmt = $PDO->prepare("INSERT INTO $tabla (usuario, password, email, cod_activacion) VALUES (:usuario,:password,:email, :cod_activacion)");

        #$PDO->beginTransaction();

        #$stmt->bindParam(":idusuario", $id, PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
        $stmt->bindParam(":cod_activacion", $datosModel["cod_activacion"], PDO::PARAM_STR);
        if ($stmt->execute()) {
            $workorderid = $PDO->lastInsertId();
            return $workorderid;
            #return "success";
        } else {
            return "error";
        }
    }

    #ASIGNAR ROL DE USUARIOS
    #-------------------------------------
    public function asignaRolUsuarioModel($datosModel, $datosModel1, $tabla)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (idusuario, idrol) VALUES (:idusuario, :idrol)");
        $stmt->bindParam(":idusuario", $datosModel, PDO::PARAM_INT);
        $stmt->bindParam(":idrol", $datosModel1, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return "success";
        } else {
            return "error";
        }
    }
    #VALIDAR EMAIL EXISTENTE
    #-------------------------------------
    public function activarRegistroUsuarioModel($datosModel, $tabla)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = 1 WHERE idusuario = :id");
        $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->execute()) {
            return "success";
        } else {
            return "error";
        }
        $stmt->close();
    }

    #INGRESO USUARIO
    #-------------------------------------
    public static function ingresoConcesionariaModel($datosModel, $tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT Tusu. idusuario, usuario, password, intentos, nombre_rol FROM 
        $tabla Tusu INNER JOIN Tusuarios_roles ON Tusu. idusuario = Tusuarios_roles. idusuario 
        INNER JOIN Troles ON Tusuarios_roles. idrol = Troles. idrol WHERE nombre_rol = 'concesionaria' AND usuario = :usuario");

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
        $stmt = Conexion::conectar()->prepare("SELECT COUNT(idclasificado) 
        FROM TClasificados 
        INNER JOIN Tusuarios ON TClasificados. idusuario = Tusuarios. idusuario 
        WHERE TClasificados. estado = '1' AND TClasificados. idusuario = :usu ");
        $stmt->bindParam(":usu", $datosModel, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    #MOSTRAR CLASIFICADOS POR EL USUARIO LOGEADO
    #-------------------------------------
    public function mostrarClasificadosPorUsuarioModel($datosModel, $datosModel1, $datosModel2, $tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT Tclasificados. idclasificado, titulo, descripcion, tipo_moneda, 
        precio, celular, cod_revista, Tclasificados. fechacreacion, Tclasificados. idusuario, 
        Tgaleria_imagenes_clasificados. idclasificado, nombreimagen FROM $tabla INNER JOIN Tgaleria_imagenes_clasificados 
        ON Tclasificados. idclasificado = Tgaleria_imagenes_clasificados. idclasificado INNER JOIN Tdetalles_caracteristicas_clasificados 
        ON Tclasificados. iddetalle_caracteristica_clasificado = Tdetalles_caracteristicas_clasificados. iddetalle_caracteristica_clasificado 
        INNER JOIN Tcategorias ON Tdetalles_caracteristicas_clasificados. idcategoria = Tcategorias. idcategoria 
        INNER JOIN Tusuarios ON Tclasificados. idusuario = Tusuarios. idusuario 
        WHERE Tclasificados. idclasificado = Tgaleria_imagenes_clasificados. idclasificado
        AND Tclasificados. idusuario = :usu AND Tclasificados. estado = '1' GROUP BY Tgaleria_imagenes_clasificados. idclasificado DESC LIMIT :id1, :id2");
        $stmt->bindParam(":usu", $datosModel, PDO::PARAM_STR);
        $stmt->bindParam(":id1", $datosModel1, PDO::PARAM_INT);
        $stmt->bindParam(":id2", $datosModel2, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
    }

    #MOSTRAR INFORMACION SOBRE EL USUARIO
    public static function mostrarInformacionUserModel($datosModel, $tabla)
    {
        $query = "SELECT Tusu.idusuario, Tusu.usuario, Tusu.saldo_usuario, Tusu.email, Tusu.nombres,Tusu.apellidos,Tusu.foto, 
                  Tusu.pais,Tusu.departamento,Tusu.provincia,Tusu.distrito,Tusu.direccion FROM $tabla Tusu 
                  INNER JOIN Tusuarios_roles ON Tusu. idusuario = Tusuarios_roles. idusuario 
                  INNER JOIN Troles ON Tusuarios_roles. idrol = Troles. idrol 
                  WHERE nombre_rol = 'concesionaria' AND Tusu. idusuario = :usu";
        $stmt = Conexion::conectar()->prepare($query);
        $stmt->bindParam(":usu", $datosModel, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
    }

    #------------------------------------code elvis
    #new version, list for user last publications ()

    public static function listarClasificadosPorUsuarioModel($idusuario, $pagina, $buscar, $tabla)
    {
        #Inicializamos el tamaño de la pagina
        $tamaño_pagina = 5;
        #Iniciamos en donde iniciara la pagina
        $empezar_desde = ($pagina - 1) * $tamaño_pagina;
        #Inicializamos el array de datos que devolvera la paginación
        $datos = array();
        $cn = Conexion::conectar();
        $query = "SELECT Tclasificados. idclasificado
        FROM $tabla 
        INNER JOIN Tdetalles_caracteristicas_clasificados 
        ON Tclasificados. iddetalle_caracteristica_clasificado = Tdetalles_caracteristicas_clasificados. iddetalle_caracteristica_clasificado 
        INNER JOIN Tusuarios ON Tclasificados. idusuario = Tusuarios. idusuario WHERE
        Tclasificados. titulo LIKE '%$buscar%'
        AND Tclasificados. idusuario = $idusuario ";
        $stmt = $cn->prepare($query);
        $stmt->execute();
        $num_filas = $stmt->rowCount();
        $total_paginas = (int)ceil($num_filas / $tamaño_pagina);
        $from = ($pagina * $tamaño_pagina) - $tamaño_pagina;
        $to = ($pagina * $tamaño_pagina);

        $query = "SELECT Tclasificados. idclasificado, titulo, descripcion, tipo_moneda, precio, 
        celular, cod_revista, Tclasificados. idusuario, 
        Tgaleria_imagenes_clasificados. idclasificado, nombreimagen , tclasificados. fechacreacion, tclasificados.estado,
        tclasificados. precio_tipo
        FROM $tabla INNER JOIN Tgaleria_imagenes_clasificados 
        ON Tclasificados. idclasificado = Tgaleria_imagenes_clasificados. idclasificado 
        INNER JOIN Tdetalles_caracteristicas_clasificados 
        ON Tclasificados. iddetalle_caracteristica_clasificado = Tdetalles_caracteristicas_clasificados. iddetalle_caracteristica_clasificado 
        INNER JOIN Tusuarios ON Tclasificados. idusuario = Tusuarios. idusuario 
        WHERE Tclasificados. idclasificado = Tgaleria_imagenes_clasificados. idclasificado 
        AND Tclasificados. titulo LIKE '%$buscar%' 
        AND Tclasificados. idusuario = $idusuario 
        GROUP BY Tgaleria_imagenes_clasificados. idclasificado 
        ORDER BY tclasificados. idclasificado  DESC LIMIT $empezar_desde, $tamaño_pagina  ";
        $stmt = $cn->prepare($query);
        $stmt->execute();
        $datos = $stmt->fetchAll();
        $stmt->closeCursor();
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

    #Editar clasificado x user
    public static function editarClasificadosUserModel($datoscontrolador, $tabla)
    {
        $PDO = Conexion::conectar();
        try{
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
        }catch (PDOException $e){
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

    //Devolver los ultimos Movimientos de los clasificados x user
    public function movimientosModel($idusuario, $pagina, $buscar)
    {
        $PDO = Conexion::conectar();
        $tamaño_pagina = 10;
        $empezar_desde = ($pagina - 1 ) * $tamaño_pagina;
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
        $total_paginas = (int) ceil($num_filas / $tamaño_pagina);
        $from = ($pagina * $tamaño_pagina) - $tamaño_pagina;
        $to =  ($pagina * $tamaño_pagina);

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
        $stmt->closeCursor();
        return $arrayTotal = array(
            "datos" => $datos,
            "paginacion" => array(
                "total" => $num_filas,
                "current_page" => (int) $pagina,
                "per_page" => $tamaño_pagina,
                "last_page" => $total_paginas,
                "from" => $from,
                "to" => $to,
            )
        );
    }

    #sacar el total de los movimientos
    public function totalMovimientos($idusuario)
    {
        $PDO = Conexion::conectar();
        $query = "SELECT tplan_r.precio_plan_revista,tplan_w.precio_plan_web
		FROM tclasificados tclas INNER JOIN tdetalles_planes_clasificados tdet_plan
		ON tdet_plan.iddetalle_plan_clasificado = tclas.iddetalle_plan_clasificado
		LEFT JOIN tplanes_revista tplan_r ON tdet_plan.idplan_revista = tplan_r.idplan_revista
		LEFT JOIN tplanes_web tplan_w ON tdet_plan.idplan_web = tplan_w.idplan_web
		WHERE tclas.idusuario = $idusuario ";
        $stmt = $PDO->prepare($query);
        $stmt->execute();
        $datos = $stmt->fetchAll();
        $stmt->closeCursor();
        return $datos;
    }


}