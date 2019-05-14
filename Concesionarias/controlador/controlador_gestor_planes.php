<?php

class GestorPlanesController
{
    #ELIJE TU PLAN DE ACUERO ALA CATEGORIA
    #------------------------------------
    public function mostrarPlanesController()
    {
        $categoria = $_SESSION["cat"];
        $trevista = GestorPlanesModel::mostrarPlanesRevistaModelo($categoria, 'tplanes_revista');
        $tweb = GestorPlanesModel::mostrarPlanWebModel($categoria, 'tplanes_web');
        foreach ($tweb as $row => $item) {
            $nombre_plan = $item['nombre_plan_web'];
            $categoria_planes = $item['categoria_plan_web'];
            echo '
			<div class="planes-anuncio">' .
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
            $idusuario = $_SESSION["idusuarioConce"];
            //obtener el ID del plan web que se selecciono
            $datos_planes_web =GestorPlanesModel::tablaPlanWebModel($_POST['planSeleccionadoWeb'], $_SESSION["cat"], "tplanes_web");
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
            if($total_compra > $total_saldo_usuario) {
                echo '<div class="alerta error">No tiene saldo suficiente, recargue.</div>';
            } else {
                $nuevo_saldo = $total_saldo_usuario - $total_compra;
                //Fin operaciones
                $idclasificado = $_SESSION['IDCLASIFICADO'];
                $datosController = array(
                    "idplan_web" => $idplan_web,
                    "idplan_revista" => $idplan_revista,
                    "idclasificado" => $idclasificado,
                    "estado" => 1,
                    "descripcion" => isset($_POST['descripcion_revista']) ? $_POST['descripcion_revista'] : null,
                    "mostrar_en_revista" => 'No'
                );
    
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
}