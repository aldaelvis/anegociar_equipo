<?php

require_once "conexion.php";

class GestorPlanesModel
{

    public function __construct()
    {

    }

    #MOSTRAR TODOS LOS PLANES DE ACUERDO A LA CATEGORIA
    #------------------------------------------------------
    public function consultarPrecioPlanPorCategoriaModel($datosModel1, $datosModel2, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT precio_plan_web FROM $tabla TPlan  WHERE nombre_plan_web = :n_plan AND categoria_plan_web = :c_plan");

        $stmt->bindParam(":n_plan", $datosModel1, PDO::PARAM_INT);
        $stmt->bindParam(":c_plan", $datosModel2, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();
    }

    #MOSTRAR TODOS LOS PLANES WEB DE ACUERDO A LA CATEGORIA
    #------------------------------------------------------
    public function mostrarPlanWebModel($datosModel1, $datosModel2, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT idplan_web, nombre_plan_web, descripcion_plan_web, categoria_plan_web, precio_plan_web 
			FROM $tabla TPlan  WHERE nombre_plan_web = :n_plan AND categoria_plan_web = :c_plan");

        $stmt->bindParam(":n_plan", $datosModel1, PDO::PARAM_STR);
        $stmt->bindParam(":c_plan", $datosModel2, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();
    }

    #MOSTRAR TODOS LOS PLANES REVISTA DE ACUERDO A LA CATEGORIA
    #------------------------------------------------------
    public function mostrarPlanRevistaModel($datosModel1, $datosModel2, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT idplan_revista, nombre_plan_revista, descripcion_plan_revista, categoria_plan_revista, precio_plan_revista 
			FROM $tabla TPlan  WHERE nombre_plan_revista = :n_plan AND categoria_plan_revista = :c_plan");

        $stmt->bindParam(":n_plan", $datosModel1, PDO::PARAM_STR);
        $stmt->bindParam(":c_plan", $datosModel2, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();
    }

    #MOSTRAR TODOS LOS PLANES DE ACUERDO A LA CATEGORIA
    #------------------------------------------------------
    public function mostrarPrecioPlanRevista($datosModel1, $datosModel2, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT idplan_revista, nombre_plan_revista, descripcion_plan_revista, categoria_plan_revista, precio_plan_revista 
			FROM $tabla TPlan  WHERE nombre_plan_revista = :n_plan AND categoria_plan_revista = :c_plan");

        $stmt->bindParam(":n_plan", $datosModel1, PDO::PARAM_STR);
        $stmt->bindParam(":c_plan", $datosModel2, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();
    }

    #MOSTRAR TODOS LOS PLANES DE ACUERDO A LA CATEGORIA
    #------------------------------------------------------
    public function mostrarPlanesporCategoriaModel($datosModel, $tabla)
    {

        #$stmt = Conexion::conectar()->prepare("SELECT idclasificado, titulo, descripcion, nombrepais,nombredepartamento ,nombreprovincia,nombredistrito FROM $tabla TClas INNER JOIN Tdetalles_ubicaciones_clasificados TDetU ON TClas. iddetalle_ubicacion_clasificado = TDetU. iddetalle_ubicacion_clasificado INNER JOIN Tpaises TPais ON TDetU. idpais = TPais. idpais INNER JOIN Tdepartamentos TDep ON TDetU. iddepartamento = TDep. iddepartamento INNER JOIN Tprovincias TPro ON TDetU. idprovincia = TPro. idprovincia INNER JOIN Tdistritos TDis ON TDetU. iddistrito = TDis. iddistrito WHERE nombredepartamento = :id ORDER BY TClas. idclasificado DESC");

        $stmt = Conexion::conectar()->prepare("SELECT idplan_web, nombre_plan_web, descripcion_plan_web, categoria_plan_web, precio_plan_web FROM $tabla TPlan WHERE categoria_plan_web = :cat");

        $stmt->bindParam(":cat", $datosModel, PDO::PARAM_STR);

        $stmt->execute();

        #return $stmt->fetch();
        return $stmt->fetchAll();

        $stmt->close();
    }

    #MOSTRAR TODOS LOS PLANES DE ACUERDO A LA CATEGORIA
    #------------------------------------------------------
    public function mostrarClasificadosPlanesCategoriaModel($datosModel, $tabla)
    {

        #$stmt = Conexion::conectar()->prepare("SELECT idclasificado, titulo, descripcion, nombrepais,nombredepartamento ,nombreprovincia,nombredistrito FROM $tabla TClas INNER JOIN Tdetalles_ubicaciones_clasificados TDetU ON TClas. iddetalle_ubicacion_clasificado = TDetU. iddetalle_ubicacion_clasificado INNER JOIN Tpaises TPais ON TDetU. idpais = TPais. idpais INNER JOIN Tdepartamentos TDep ON TDetU. iddepartamento = TDep. iddepartamento INNER JOIN Tprovincias TPro ON TDetU. idprovincia = TPro. idprovincia INNER JOIN Tdistritos TDis ON TDetU. iddistrito = TDis. iddistrito WHERE nombredepartamento = :id ORDER BY TClas. idclasificado DESC");

        $stmt = Conexion::conectar()->prepare("SELECT idplan_web, nombre_plan_web, descripcion_plan_web, categoria_plan_web, precio_plan_web 
			FROM $tabla TPlan WHERE categoria_plan_web = :cat");
        $stmt->bindParam(":cat", $datosModel, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //Mostrar datos planes revista segun la categoria
    public function mostrarPlanesRevistaModelo($categoria, $tabla)
    {
        $cursor = Conexion::conectar();
        $query = "SELECT idplan_revista, nombre_plan_revista, descripcion_plan_revista, categoria_plan_revista, precio_plan_revista 
        FROM $tabla WHERE categoria_plan_revista = :cat ";

        $stmt = $cursor->prepare($query);
        $stmt->bindParam(':cat', $categoria, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //Mostrar preview clasificado
    public static function mostrarPreviewClasificadoModel($idclasificado)
    {
        $query = "SELECT tclas.*, tdist.nombredistrito, tgal.nombreimagen FROM tclasificados tclas
		INNER JOIN tdetalles_caracteristicas_clasificados tdet_cl 
		ON tclas.iddetalle_caracteristica_clasificado = tdet_cl.iddetalle_caracteristica_clasificado
		INNER JOIN tdetalles_ubicaciones_clasificados tdet_ubi 
		ON tclas.iddetalle_ubicacion_clasificado = tdet_ubi.iddetalle_ubicacion_clasificado
		INNER JOIN tdistritos tdist ON tdist.iddistrito = tdet_ubi.iddistrito
		INNER JOIN Tgaleria_imagenes_clasificados tgal
		ON tclas.idclasificado = tgal.idclasificado
		WHERE tclas.idclasificado = :idclasificado
		GROUP BY tgal.idclasificado ";

        $stmt = Conexion::conectar()->prepare($query);
        $stmt->bindParam(':idclasificado', $idclasificado, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function activarClasificadoModelo($datosModel)
    {
        $PDO = Conexion::conectar();
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $PDO->beginTransaction();
        try {
            $query = "INSERT INTO tdetalles_planes_clasificados(idplan_web, idplan_revista) VALUES(:idplan_web, :idplan_revista)";
            $stmt = $PDO->prepare($query);
            $stmt->bindParam(':idplan_web', $datosModel['idplan_web'], PDO::PARAM_INT);
            $stmt->bindParam(':idplan_revista', $datosModel['idplan_revista'], PDO::PARAM_INT);
            $stmt->execute();
            $iddet = $PDO->lastInsertId();

            $query2 = "UPDATE tclasificados SET  descripcion_revista = :descripcion, mostrar_en_revista = :revista, estado = :estado, 
			iddetalle_plan_clasificado = :iddetalle_plan_clasificado 
			WHERE idclasificado = :idclasificado";
            $stmt = $PDO->prepare($query2);
            $stmt->bindParam(':descripcion', $datosModel['descripcion'], PDO::PARAM_STR);
            $stmt->bindParam(':revista', $datosModel['mostrar_en_revista'], PDO::PARAM_STR);
            $stmt->bindParam(':estado', $datosModel['estado'], PDO::PARAM_STR);
            $stmt->bindParam(':iddetalle_plan_clasificado', $iddet, PDO::PARAM_INT);
            $stmt->bindParam(':idclasificado', $datosModel['idclasificado'], PDO::PARAM_INT);
            $stmt->execute();
            $stmt->closeCursor();
            $PDO->commit();
        } catch (PDOException $e) {
            $PDO->rollBack();
            print_r($e->getMessage());
        }
        return "OK";
    }

}