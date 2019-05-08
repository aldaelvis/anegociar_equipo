<?php

class GestorPlanesController
{

    #ELIJE TU PLAN DE ACUERO ALA CATEGORIA
    #------------------------------------
    public function mostarPlanesPorCategoriaController()
    {

        $datosController = $_POST["cat"] OR $datosController = $_GET["cat"];
        $datosController2 = $_GET["dep"];
        // $prueba = $datosController.$datosController2;
        echo 'holaaa' . $datosController;
        #echo $datosController2;
        // echo $prueba;

        $respuesta = GestorPlanesModel::mostrarPlanesporCategoriaModel($datosController, "Tplanes_web");

        foreach ($respuesta as $row => $item) {

            echo '<option value=' . $item['idplan_web'] . '|' . $item['nombre_plan_web'] . '>' . $item["nombre_plan_web"] . '</option>';
            #echo '<br/><a href="index.php?action=ubicacion_clasificados&cat='.$categoria.'&dep='.$item["nombredepartamento"].'">'.$item["nombredepartamento"].'</a>';
        }
    }

    #ELIJE TU PLAN DE ACUERO ALA CATEGORIA
    #------------------------------------
    public function vistaAnunciosPlanesController()
    {
        $datosController = $_POST["cat"];
        $datosController2 = $_SESSION["cat"];
        $respuesta = GestorPlanesModel::mostrarClasificadosPlanesCategoriaModel($datosController2, "Tplanes_web");
        foreach ($respuesta as $row => $item) {
            $Nombres_Planes = $item["nombre_plan_web"];
            $Categorias_Planes = $item["categoria_plan_web"];

            echo '<div class="planes-anuncio">' .
                '<div class="categoria-plan">' . '<h1>' . $Categorias_Planes . '</h1>' . '</div>' .
                '<div class="nombre-plan">' . '<h2>' . $Nombres_Planes . '</h2>' . '</div>' .
                '<div class="precio-plan">' . '<h3>s/.' . $item["precio_plan_web"] . '</h3>' . '</div>' .
                '<div class="descripcion-plan"><ul>';
            $descripcion_plan = $item["descripcion_plan_web"];
            $descripcion_plan = explode(",", $descripcion_plan);

            foreach ($descripcion_plan as $x => $value) {
                echo
                    '<li>' . $value . '</li>';
            }
            echo '</ul></div>' .
                '<div class="enlace-crear-anuncio">';
            if (($Nombres_Planes = $Nombres_Planes) && ($Categorias_Planes = $Categorias_Planes)) {
                echo '
					<form method="post" action="crear_anuncio">
                        <button type="submit" name="cat-plan" value="' . $Categorias_Planes . '|' . $Nombres_Planes . '" class="btn-link">Continuar</button>
                    </form>
                	';
            }
            echo '</div>' . '</div>';
        }
    }

    public static function mostrarPlanesController()
    {
        $categoria = $_SESSION["cat"];
        $trevista = GestorPlanesModel::mostrarPlanesRevistaModelo($categoria, 'tplanes_revista');
        $tweb = GestorPlanesModel::mostrarClasificadosPlanesCategoriaModel($categoria, 'tplanes_web');
        foreach ($trevista as $row => $item) {
            $nombre_plan = $item['nombre_plan_revista'];
            $categoria_planes = $item['categoria_plan_revista'];
            echo '<div class="planes-anuncio">' .
                '<div class="categoria-plan">' . '<h1>' . $categoria_planes . '</h1>' . '</div>' .
                '<div class="nombre-plan">' . '<h2>' . $nombre_plan . '</h2>' . '</div>' .
                '<div class="precio-plan">' . '<h3>s/.' . $item["precio_plan_revista"] . '</h3>' . '</div>' .
                '<div class="descripcion-plan"><ul>';
            $descripcion = $item['descripcion_plan_revista'];
            $descripcion_plan = explode(',', $descripcion);
            foreach ($descripcion_plan as $key => $value) {
                echo '<li>' . $value . '</li>';
            }
            echo '</ul></div>
				<div class="enlace-crear-anuncio">';
            if (($nombre_plan == $nombre_plan) && ($categoria_planes == $categoria_planes)) {
                echo '
						<input type="radio" name="planSeleccionadoRevista" v-model="plan"
						value="' . $nombre_plan . '">';
            }
            echo '</div>' . '</div>';
        }
        echo '<div class="nodeseo-plan">
				<label class="checkbox-plan">
					<input type="checkbox" v-model="nodeseoweb">
					Deseo el plan web
				</label>
			</div> <br />';
        foreach ($tweb as $row => $item) {
            $nombre_plan = $item['nombre_plan_web'];
            $categoria_planes = $item['categoria_plan_web'];
            echo '
			<div class="planes-anuncio" v-if="nodeseoweb == true">' .
                '<div class="categoria-plan">' . '<h1>' . $categoria_planes . '</h1>' . '</div>' .
                '<div class="nombre-plan">' . '<h2>' . $nombre_plan . '</h2>' . '</div>' .
                '<div class="precio-plan">' . '<h3>s/.' . $item["precio_plan_web"] . '</h3>' . '</div>' .
                '<div class="descripcion-plan"><ul>';
            $descripcion = $item['descripcion_plan_web'];
            $descripcion_plan = explode(',', $descripcion);
            foreach ($descripcion_plan as $key => $value) {
                echo '<li>' . $value . '</li>';
            }
            echo '</ul></div>
				<div class="enlace-crear-anuncio">';
            if (($nombre_plan == $nombre_plan) && ($categoria_planes == $categoria_planes)) {
                echo '<input type="radio" name="planSeleccionadoWeb"
						value="' . $nombre_plan . '">';
            }
            echo '</div>' . '</div>';
        }
        echo '
		';
    }

    public static function mostrarPreviewClasificadoController()
    {
        session_start();
        if (isset($_SESSION['IDCLASIFICADO'])) {
            $idclasificado = $_SESSION['IDCLASIFICADO'];
        }
        $rpta = GestorPlanesModel::mostrarPreviewClasificadoModel($idclasificado);
        return $rpta;
    }

    //Activar el clasificado segun el plan que se hay seleccionado
    public static function activarClasificadoController()
    {
        session_start();
        if (isset($_POST['planSeleccionadoWeb']) || isset($_POST['planSeleccionadoRevista'])) {
            $idusuario = $_SESSION["idusuarioAG"];
            //obtener el ID del plan web que se selecciono
            $datos_planes_web =
                GestorPlanesModel::mostrarPlanWebModel($_POST['planSeleccionadoWeb'], $_SESSION["cat"], "Tplanes_web");
            $idplan_web = $datos_planes_web['idplan_web'];
            $precio_web = $datos_planes_web['precio_plan_web'];

            //obtener el Id del plan revista que se selecciono
            $datos_planes_revista =
                GestorPlanesModel::mostrarPlanRevistaModel($_POST['planSeleccionadoRevista'], $_SESSION["cat"], "Tplanes_revista");
            $idplan_revista = $datos_planes_revista['idplan_revista'];
            $precio_revista = $datos_planes_revista['precio_plan_revista'];

            //Sumar los precio para el descuento
            $datos_usuario = GestorUsuariosModel::saldoUsuarioModel($idusuario, "tusuarios");
            $total_saldo_usuario = $datos_usuario["saldo_usuario"];
            $total_compra = (double)$precio_web + (double)$precio_revista;
            $nuevo_saldo = $total_saldo_usuario - $total_compra;
            //Fin operaciones

            $idclasificado = $_SESSION['IDCLASIFICADO'];
            $datosController = array(
                "idplan_web" => $idplan_web,
                "idplan_revista" => $idplan_revista,
                "idclasificado" => $idclasificado,
                "estado" => 1,
                "descripcion" => $_POST['descripcion_revista'],
                "mostrar_en_revista" => 'Si'
            );

            var_dump($datosController);
            //Actualizar informacion descripcion revista
            $rpta = GestorPlanesModel::activarClasificadoModelo($datosController, 'tdetalles_planes_clasificados');
            if ($rpta == "OK") {
                //Mandamos a llamar la funcion reducir
                GestorUsuariosModel::reducirSaldoUsuario($idusuario, $nuevo_saldo);
                unset($_SESSION['IDCLASIFICADO']);
                header('Location:ultimas_publicaciones');
            }
        }
    }


}
