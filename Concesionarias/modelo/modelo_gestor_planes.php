<?php

require_once "conexion.php";

class GestorPlanesModel
{

    #MOSTRAR TODOS LOS PLANES DE ACUERDO A LA CATEGORIA
    #------------------------------------------------------
    public function mostrarPrecioPlanModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT idplan, nombre_plan, descripcion_plan, categoria_plan, precio_plan FROM $tabla TPlan WHERE categoria_plan = :plan");
        $stmt->bindParam(":plan", $datosModel, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
    }

    #MOSTRAR TODOS LOS PLANES DE ACUERDO A LA CATEGORIA
    #------------------------------------------------------
    public function mostrarClasificadosPlanesCategoriaModel($datosModel, $tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT idplan, nombre_plan, descripcion_plan, categoria_plan, precio_plan 
        FROM $tabla TPlan WHERE categoria_plan = :cat");
        $stmt->bindParam(":cat", $datosModel, PDO::PARAM_INT);
        $stmt->execute();

        #return $stmt->fetch();
        return $stmt->fetchAll();

        $stmt->close();
    }


    #Elvis------------------------------------------------------

    #MOSTRAR PLAN WEB
    public static function mostrarPlanesWebPorCategoriaModel($datosModel, $tabla)
    {
        $PDO = Conexion::conectar();
        $stmt = $PDO->prepare("SELECT idplan_web, nombre_plan_web, descripcion_plan_web, categoria_plan_web, precio_plan_web
        FROM $tabla WHERE categoria_plan_web = :categoria ");
        $stmt->bindParam(":categoria", $datosModel);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
    }

    #MOSTRAR PLAN REVISTA
    public static function mostrarPlanesRevistaPorCategoriaModel($datosModel, $tabla)
    {
        $PDO = Conexion::conectar();
        $stmt = $PDO->prepare("SELECT idplan_revista, nombre_plan_revista, descripcion_plan_revista, 
        categoria_plan_revista, precio_plan_revista
        FROM $tabla WHERE categoria_plan_revista = :categoria ");
        $stmt->bindParam(":categoria", $datosModel);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
    }

    #MOSTRAR TODOS LOS PLANES WEB DE ACUERDO A LA CATEGORIA
    #------------------------------------------------------
    public static function mostrarPlanWebModel($datosModel1, $datosModel2, $tabla){

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
    public static function mostrarPlanRevistaModel($datosModel1, $datosModel2, $tabla){

        $stmt = Conexion::conectar()->prepare("SELECT idplan_revista, nombre_plan_revista, descripcion_plan_revista, categoria_plan_revista, precio_plan_revista 
			FROM $tabla TPlan  WHERE nombre_plan_revista = :n_plan AND categoria_plan_revista = :c_plan");

        $stmt->bindParam(":n_plan", $datosModel1, PDO::PARAM_STR);
        $stmt->bindParam(":c_plan", $datosModel2, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();
    }
}