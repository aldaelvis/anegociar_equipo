<?php

require_once "conexion.php";

class GestorAnunciosModel
{

    public function verificarEstadoClasificadosModel($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT idclasificado, estado FROM $tabla");

        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
    }

    #ACTIVAR CLASIFICADO
    #-------------------------------------
    public function activarClasificadoModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = 1 WHERE idclasificado = :id");

        $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->execute()) {

            return "success";

        } else {

            return "error";

        }

        $stmt->close();

    }


    #GUARDAR CARACTERÍSTICAS CLASIFICADOS
    #------------------------------------------------------------
    public function guardarCaracteristicasClasificadosModel($datosModel, $tabla)
    {

        $PDO = Conexion::conectar();
        $stmt = $PDO->prepare("INSERT INTO $tabla (idcategoria, idsubcategoria, idmarca, idmodelo, fabricacion_vehiculo, 
        tipo_modelo_vehiculo, tipo_combustible, tipo_transmision, condicion_vehiculo, kilometraje_vehiculo, tipo_operacion_inmueble, 
        tipo_categoria_inmueble, nro_habitaciones, nro_servicios_higienicos, metros_cuandrados_inmuebles) 
        VALUES (:idcategoria, :idsubcategoria, :idmarca, :idmodelo, :fabricacion_vehiculo, :tipo_modelo_vehiculo, :tipo_combustible, 
        :tipo_transmision, :condicion_vehiculo, :kilometraje_vehiculo, :tipo_operacion_inmueble, 
        :tipo_categoria_inmueble, :nro_habitaciones, :nro_servicios_higienicos, :metros_cuandrados_inmuebles) ");

        $stmt->bindParam(":idcategoria", $datosModel["idcategoria"], PDO::PARAM_INT);
        $stmt->bindParam(":idsubcategoria", $datosModel["idsubcategoria"], PDO::PARAM_INT);

        $stmt->bindParam(":idmarca", $datosModel["idmarca"], PDO::PARAM_INT);
        $stmt->bindParam(":idmodelo", $datosModel["idmodelo"], PDO::PARAM_INT);

        $stmt->bindParam(":fabricacion_vehiculo", $datosModel["fabricacion_vehiculo"], PDO::PARAM_INT);
        $stmt->bindParam(":tipo_modelo_vehiculo", $datosModel["tipo_modelo_vehiculo"], PDO::PARAM_INT);
        $stmt->bindParam(":tipo_combustible", $datosModel["tipo_combustible"], PDO::PARAM_INT);
        $stmt->bindParam(":tipo_transmision", $datosModel["tipo_transmision"], PDO::PARAM_INT);
        $stmt->bindParam(":condicion_vehiculo", $datosModel["condicion_vehiculo"], PDO::PARAM_INT);
        $stmt->bindParam(":kilometraje_vehiculo", $datosModel["kilometraje_vehiculo"], PDO::PARAM_INT);

        $stmt->bindParam(":tipo_operacion_inmueble", $datosModel["tipo_operacion_inmueble"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_categoria_inmueble", $datosModel["tipo_categoria_inmueble"], PDO::PARAM_STR);
        $stmt->bindParam(":nro_habitaciones", $datosModel["nro_habitaciones"], PDO::PARAM_INT);
        $stmt->bindParam(":nro_servicios_higienicos", $datosModel["nro_servicios_higienicos"], PDO::PARAM_INT);
        $stmt->bindParam(":metros_cuandrados_inmuebles", $datosModel["metros_cuandrados_inmuebles"], PDO::PARAM_INT);
        if ($stmt->execute()) {
            #return "ok";
            $workorderid = $PDO->lastInsertId();
            return $workorderid;
            #return "success";
        } else {

            return "error";
        }

        $stmt->close();

    }

    #GUARDAR GALERIA IMAGENES
    #------------------------------------------------------------
    public function guardarUbicacionesClasificadosModel($datosModel, $tabla)
    {

        $PDO = Conexion::conectar();
        $stmt = $PDO->prepare("INSERT INTO $tabla (idpais, iddepartamento, idprovincia, iddistrito /* idclasificados*/) VALUES (:idpais, :iddepartamento, :idprovincia, :iddistrito /*:idclasificados*/)");

        $stmt->bindParam(":idpais", $datosModel["idpais"], PDO::PARAM_INT);
        $stmt->bindParam(":iddepartamento", $datosModel["iddepartamento"], PDO::PARAM_INT);
        $stmt->bindParam(":idprovincia", $datosModel["idprovincia"], PDO::PARAM_INT);
        $stmt->bindParam(":iddistrito", $datosModel["iddistrito"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            #return "ok";
            $workorderid = $PDO->lastInsertId();
            return $workorderid;
            #return "success";
        } else {

            return "error";
        }

        $stmt->close();

    }

    #GUARDAR GALERIA IMAGENES
    #------------------------------------------------------------
    public function RecuperarIDUbicacionModel($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT iddetalle_ubicacion_clasificado FROM $tabla");

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    #GUARDAR GALERIA IMAGENES
    #------------------------------------------------------------
    public function RecuperarIDCaracteristicaModel($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT iddetalle_caracteristica_clasificado FROM $tabla");

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    #Recuperar ID CLASIFICADOS PARA LA GUARDAR LA GALERIA DE IMAGENES
    #------------------------------------------------------------
    public function RecuperarIDClasificadosModel($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT idclasificado FROM $tabla");

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    #GUARDAR ARTICULO
    #------------------------------------------------------------
    public function guardarClasificadosModel($datosModel, $tabla)
    {

        $PDO = Conexion::conectar();
        $stmt = $PDO->prepare("INSERT INTO $tabla (titulo, descripcion, tipo_moneda, precio, celular, 
        descripcion_revista, precio_tipo, cod_revista,fechacreacion, estado, iddetalle_caracteristica_clasificado, 
        iddetalle_ubicacion_clasificado, idusuario) 
        VALUES (:titulo, :descripcion, :tipo_moneda, :precio, :celular, :descripcion_revista, :precio_tipo, 
        :cod_revista, curdate(), :estado, :iddetalle_caracteristica_clasificado, :iddetalle_ubicacion_clasificado, :idusuario)");

        $stmt->bindParam(":titulo", $datosModel["titulo"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);
        #$stmt -> bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_moneda", $datosModel["tipo_moneda"], PDO::PARAM_STR);
        $stmt->bindParam(":precio", $datosModel["precio"], PDO::PARAM_STR);
        $stmt->bindParam(":celular", $datosModel["celular"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion_revista", $datosModel["descripcion_revista"], PDO::PARAM_STR);
        $stmt->bindParam(":precio_tipo", $datosModel["precio_tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":cod_revista", $datosModel["cod_revista"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datosModel["estado"], PDO::PARAM_STR);
        #$stmt -> bindParam(":idgaleria_imagen_clasificado", $datosModel["idgaleria_imagen_clasificado"], PDO::PARAM_INT);
        $stmt->bindParam(":iddetalle_caracteristica_clasificado", $datosModel["iddetalle_caracteristica_clasificado"], PDO::PARAM_INT);
        $stmt->bindParam(":iddetalle_ubicacion_clasificado", $datosModel["iddetalle_ubicacion_clasificado"], PDO::PARAM_INT);
        #$stmt -> bindParam(":idpais", $datosModel["idpais"], PDO::PARAM_STR);
        $stmt->bindParam(":idusuario", $datosModel["idusuario"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $workorderid = $PDO->lastInsertId();
            return $workorderid;
            #return "success";
        } else {

            return "error";
        }

        $stmt->close();

    }

    #GUARDAR GALERIA IMAGENES CLASIFICADOS
    #------------------------------------------------------------
    public static function guardarGaleriaImagenClasificadosModel($datosModel, $tabla)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombreimagen, idclasificado) VALUES (:nombreimagen, :idclasificado)");
        $stmt->bindParam(":nombreimagen", $datosModel["nombreimagen"], PDO::PARAM_STR);
        $stmt->bindParam(":idclasificado", $datosModel["idclasificado"], PDO::PARAM_INT);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();

    }


    #Recuperar ID CLASIFICADOS PARA LA GUARDAR LA GALERIA DE IMAGENES
    #------------------------------------------------------------
    public function RecuperarIDGaleriaImagenClasificadosModel($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT idgaleria_imagen_clasificado, nombreimagen FROM $tabla");

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    #MOSTAR GALERIA IMAGENES CLASIFICADOS
    #------------------------------------------------------------
    public function MostarGaleriaImagenClasificadosModel($datosModel, $tabla)
    {

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
    public function mostrarClasificadosModel($datosModel, $tabla)
    {

        #$stmt = Conexion::conectar()->prepare("SELECT idclasificado, titulo, descripcion, tipo_moneda, precio, celular FROM $tabla WHERE idclasificado = :id");

        #$stmt = Conexion::conectar()->prepare("SELECT TClas. idclasificado, titulo, descripcion, precio, celular, nombreimagen, TGalClas. idclasificado FROM  Tclasificados TClas INNER JOIN Tgaleria_imagenes_clasificados TGalClas ON TClas. idclasificado = TGalClas. idclasificado WHERE TClas. idclasificado = :id");

        #$stmt = Conexion::conectar()->prepare("	SELECT TGalClas. idclasificado, titulo, descripcion, precio, celular, nombreimagen, TClas. idclasificado FROM Tgaleria_imagenes_clasificados TGalClas INNER JOIN Tclasificados TClas	ON TGalClas. idclasificado = TClas. idclasificado WHERE TClas. idclasificado = :id");

        $stmt = Conexion::conectar()->prepare("SELECT */*TGalClas. idclasificado, titulo, descripcion, precio, celular, nombreimagen, TClas. idclasificado */FROM Tgaleria_imagenes_clasificados TGalClas INNER JOIN Tclasificados TClas ON TGalClas. idclasificado = TClas. idclasificado INNER JOIN Tdetalles_caracteristicas_clasificados TDetCarClas ON TDetCarClas. iddetalle_caracteristica_clasificado = TClas. iddetalle_caracteristica_clasificado INNER JOIN Tdetalles_ubicaciones_clasificados TDetUbiClas ON TClas. iddetalle_ubicacion_clasificado = TDetUbiClas. iddetalle_ubicacion_clasificado INNER JOIN Tpaises TPais ON TDetUbiClas. idpais = TPais. idpais LEFT JOIN Tdepartamentos TDep ON TDetUbiClas. iddepartamento = TDep. iddepartamento LEFT JOIN Tprovincias TPro ON TDetUbiClas. idprovincia = TPro. idprovincia LEFT JOIN Tdistritos TDis ON TDetUbiClas. iddistrito = TDis. iddistrito  WHERE TClas. idclasificado = :id");

        $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

    }

    #BORRAR ARTICULOS
    #-----------------------------------------------------
    public function borrarArticuloModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();

    }

    #ACTUALIZAR ARTICULOS
    #---------------------------------------------------
    public function editarArticuloModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET titulo = :titulo, introduccion = :introduccion, ruta = :ruta, contenido = :contenido WHERE id = :id");

        $stmt->bindParam(":titulo", $datosModel["titulo"], PDO::PARAM_STR);
        $stmt->bindParam(":introduccion", $datosModel["introduccion"], PDO::PARAM_STR);
        $stmt->bindParam(":ruta", $datosModel["ruta"], PDO::PARAM_STR);
        $stmt->bindParam(":contenido", $datosModel["contenido"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }

        $stmt->close();

    }

    #ACTUALIZAR ORDEN
    #---------------------------------------------------
    public function actualizarOrdenModel($datos, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET orden = :orden WHERE id = :id");

        $stmt->bindParam(":orden", $datos["ordenItem"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["ordenArticulos"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {
            return "error";
        }

        $stmt->close();

    }

    #SELECCIONAR ORDEN
    #---------------------------------------------------
    public function seleccionarOrdenModel($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT id, titulo, introduccion, ruta, contenido FROM $tabla ORDER BY orden ASC");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

    }

    #MOSTRAR TODOS LOS anuncios por usuario
    #------------------------------------------------------
    public function mostrarListaClasificadosUsuariosModel(/*$datosModel,*/
        $tabla)
    {

        #$stmt = Conexion::conectar()->prepare("SELECT idclasificados, titulo, descripcion, imagen, tipo_moneda, precio FROM $tabla");

        $stmt = Conexion::conectar()->prepare("SELECT TClas. idclasificado, titulo, descripcion FROM TClasificados TClas INNER JOIN Tgaleria_imagenes_clasificados TGal ON TClas. idclasificado = TGal. idclasificado");

        #$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

    }

    #BUSCAR CLASIFICADOS
    #------------------------------------------------------
    public function buscarClasificadosModel($datosModel1, $datosModel2, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT Tclasificados. idclasificado, titulo, descripcion, tipo_moneda, precio, celular, precio_tipo, cod_revista, fechacreacion, 
        Tgaleria_imagenes_clasificados. idclasificado, nombreimagen 
        FROM Tclasificados 
        INNER JOIN Tgaleria_imagenes_clasificados 
        ON Tclasificados. idclasificado = Tgaleria_imagenes_clasificados. idclasificado 
        INNER JOIN Tdetalles_caracteristicas_clasificados 
        ON Tclasificados. iddetalle_caracteristica_clasificado = Tdetalles_caracteristicas_clasificados. iddetalle_caracteristica_clasificado 
        INNER JOIN Tcategorias 
        ON Tdetalles_caracteristicas_clasificados. idcategoria = Tcategorias. idcategoria 
        WHERE Tclasificados. idclasificado = Tgaleria_imagenes_clasificados. idclasificado
        AND Tclasificados. titulo LIKE CONCAT ('%',:palabra,'%')
        AND nombre_categoria LIKE CONCAT ('%',:cat,'%') 
        AND Tclasificados. estado = '1'
        GROUP BY Tgaleria_imagenes_clasificados. idclasificado DESC");
        $stmt->bindParam(":cat", $datosModel1, PDO::PARAM_STR);
        $stmt->bindParam(":palabra", $datosModel2, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

    }
    //-----------------------------------------------------------
    #mostrar ubicaciones departamentos -> elvis
    public static function mostrarDepartamentos($tabla)
    {
        $PDO = Conexion::conectar();
        $stmt = $PDO->prepare("SELECT * FROM $tabla");
        $stmt->execute();
        return $stmt->fetchAll();

    }

    #mostrar ubicaciones segun los departamentos -> elvis
    public static function mostrarProvincias($tabla, $iddepartamento)
    {
        $PDO = Conexion::conectar();
        $stmt = $PDO->prepare("SELECT * FROM $tabla WHERE iddepartamento = :iddepartamento");
        $stmt->bindParam(':iddepartamento', $iddepartamento, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    ## mostrar los distritos
    public static function mostrarDistritos($tabla, $idprovincia)
    {
        $PDO = Conexion::conectar();
        $stmt = $PDO->prepare("SELECT * FROM $tabla WHERE idprovincia = :idprovincia");
        $stmt->bindParam(':idprovincia', $idprovincia, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //GUARDAR DETALLES DE PLANES CLASIFICADOS
    public static function guardarDetallesPlanClasificadoModel($datos, $tabla) {
        $PDO = Conexion::conectar();
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $PDO->beginTransaction();
            $stmt = $PDO->prepare("INSERT INTO $tabla(idplan_web, idplan_revista) VALUES(:idplan_web, :idplan_revista)");
            $stmt->bindParam(':idplan_web', $datos['idplan_web'], PDO::PARAM_INT);
            $stmt->bindParam(':idplan_revista', $datos['idplan_revista'], PDO::PARAM_INT);
            $stmt->execute();
            $iddetalle = $PDO->lastInsertId();

            $stmt = $PDO->prepare("UPDATE tclasificados SET iddetalle_plan_clasificado = :iddetalle, fechainicio = :fechainicio, 
            fechafinal = :fechafinal, estado = :estado WHERE idclasificado = :idclasificado");
            $stmt->bindParam(':iddetalle', $iddetalle, PDO::PARAM_INT);
            $stmt->bindParam(':fechainicio', $datos['fechainicio'], PDO::PARAM_STR);
            $stmt->bindParam(':fechafinal', $datos['fechafinal'], PDO::PARAM_STR);
            $stmt->bindParam(':estado', $datos['estado'], PDO::PARAM_STR);
            $stmt->bindParam(':idclasificado', $datos['idclasificado'], PDO::PARAM_INT);
            $stmt->execute();

            $PDO->commit();
        }catch (PDOException $e) {
            $PDO->rollBack();
            print_r( $e->getMessage() );
        }
    }

    //Mostrar publicidad dependiendo al clasificado
    public static function mostrarPublicidadModel($tabla, $data) {
        $cursor = Conexion::conectar();
        $stmt = $cursor->prepare("SELECT  tp.imagen, td.nombredepartamento , tc.nombre_categoria
        FROM $tabla tp
            INNER JOIN tcategorias tc ON tp.idcategoria = tc.idcategoria
            INNER JOIN tdepartamentos td on tp.iddepartamento = td.iddepartamento
            INNER JOIN tdetalles_caracteristicas_clasificados tcc ON tc.idcategoria = tcc.idcategoria
            INNER JOIN tclasificados t ON tcc.iddetalle_caracteristica_clasificado = t.iddetalle_caracteristica_clasificado
            INNER JOIN tdetalles_ubicaciones_clasificados tuc on t.iddetalle_ubicacion_clasificado = tuc.iddetalle_ubicacion_clasificado
        WHERE t.idclasificado = :idclasificado AND td.iddepartamento = tuc.iddepartamento AND tp.orientacion = 'vertical' AND tp.estado = '1'
        ORDER BY tp.idpublicidad DESC");
        $stmt->bindParam(':idclasificado', $data, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //Mostrar publicidad todo el pais
    public static function mostrarPublicidaTododModel($tabla, $data) {
        $cursor = Conexion::conectar();
        $stmt = $cursor->prepare("SELECT distinct tp.imagen, tpa.nombrepais , tc.nombre_categoria
        FROM $tabla tp
            INNER JOIN tcategorias tc ON tp.idcategoria = tc.idcategoria
            INNER JOIN tpaises tpa on tp.idpais = tpa.idpais
            INNER JOIN tdetalles_caracteristicas_clasificados tcc ON tc.idcategoria = tcc.idcategoria
            INNER JOIN tclasificados t ON tcc.iddetalle_caracteristica_clasificado = t.iddetalle_caracteristica_clasificado
            INNER JOIN tdetalles_ubicaciones_clasificados tuc on t.iddetalle_ubicacion_clasificado = tuc.iddetalle_ubicacion_clasificado
        WHERE t.idclasificado = :idclasificado AND  tpa.idpais = tuc.idpais AND tp.todo = 'Si' AND estado = '1'
        ORDER BY tp.idpublicidad DESC");
        $stmt->bindParam(':idclasificado', $data, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
