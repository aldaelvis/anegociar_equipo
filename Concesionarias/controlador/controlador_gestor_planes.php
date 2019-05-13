<?php

class GestorPlanesController
{
    #ELIJE TU PLAN DE ACUERO ALA CATEGORIA
    #------------------------------------
    public function vistaAnunciosPlanesController()
    {
        $datosController = $_SESSION["val1"];
        $respuesta = GestorPlanesModel::mostrarClasificadosPlanesCategoriaModel($datosController, "tplanes_web");
        foreach ($respuesta as $row => $item) {
            $Nombres_Planes = $item["nombre_plan"];
            $Categorias_Planes = $item["categoria_plan"];

            echo '<div class="planes-anuncio">' .
                '<div class="categoria-plan">' . '<h1>' . $Categorias_Planes . '</h1>' . '</div>' .
                '<div class="nombre-plan">' . '<h2>' . $Nombres_Planes . '</h2>' . '</div>' .
                '<div class="precio-plan">' . '<h3>s/.' . $item["precio_plan"] . '</h3>' . '</div>' .
                '<div class="descripcion-plan"><ul>';
            $descripcion_plan = $item["descripcion_plan"];
            $descripcion_plan = explode(",", $descripcion_plan);

            foreach ($descripcion_plan as $x => $value) {
                echo
                    '<li>' . $value . '</li>';
            }
            echo '</ul></div>' .
                '<div class="enlace-crear-anuncio">';
            if (($Nombres_Planes = $Nombres_Planes) && ($Categorias_Planes = $Categorias_Planes)) {
                echo '
					<form method="post">
                        <button type="submit" name="cat-plan" value="' . $Categorias_Planes . '|' . $Nombres_Planes . '" class="btn-link">Continuar</button>
                    </form>
                	';
            }
            echo '</div>' . '</div>';
        }
    }

    #Elvis---------------------------------------------

    #ELIJE TU PLAN DE ACUERDO ALA CATEGORIA
    #--------------------------------------------------
    public static function mostrarPlanesWebPorCategoriaControlador(){
        session_start();
        $categoria = $_SESSION['cat'];
        $categoria = strtoupper($categoria);
        $rpta = GestorPlanesModel::mostrarPlanesWebPorCategoriaModel($categoria, 'Tplanes_web');
        foreach ($rpta as $key => $value) {
            $data[] = array(
                "idplan_web" => $value["idplan_web"],
                "nombre_plan_web" => $value["nombre_plan_web"],
                "descripcion_plan_web" => $value["descripcion_plan_web"],
                "categoria_plan_web" => $value["categoria_plan_web"],
                "precio_plan_web" => $value["precio_plan_web"]
            );
        }
        return json_encode($data);
    }

    public static function mostrarPlanesRevistaPorCategoriaControlador(){
        session_start();
        $categoria = $_SESSION['cat'];
        $categoria = strtoupper($categoria);
        $rpta = GestorPlanesModel::mostrarPlanesRevistaPorCategoriaModel($categoria, 'Tplanes_revista');
        foreach ($rpta as $key => $value) {
            $data[] = array(
                "idplan_revista" => $value["idplan_revista"],
                "nombre_plan_revista" => $value["nombre_plan_revista"],
                "descripcion_plan_revista" => $value["descripcion_plan_revista"],
                "categoria_plan_revista" => $value["categoria_plan_revista"],
                "precio_plan_revista" => $value["precio_plan_revista"]
            );
        }
        return json_encode($data);
    }
}