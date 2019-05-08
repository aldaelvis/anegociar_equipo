<?php

require_once "../../../controlador/controlador_gestor_anuncios.php";
require_once "../../../modelo/modelo_gestor_anuncios.php";

require_once "../../../controlador/controlador_gestor_planes.php";
require_once "../../../modelo/modelo_gestor_planes.php";

require_once "../../../controlador/controlador_gestor_usuarios.php";
require_once "../../../modelo/modelo_gestor_usuarios.php";

class Ajax
{
    public $validarUsuario;
    public $validarEmail;
    public $camposDinamicos;

    public function camposDinamicosAjax()
    {
        $datos = $this->camposDinamicos;
        $respuesta = GestorAnunciosController::camposDinamicosPorCategoriaController($datos);
        echo $respuesta;
    }

    public function validarEmailAjax()
    {

        $datos = $this->validarEmail;

        $respuesta = MvcController::validarEmailController($datos);

        echo $respuesta;
    }
}

if (isset($_POST["categoriacrearanuncio"])) {

    $a = new Ajax();
    $a->camposDinamicos = $_POST["categoriacrearanuncio"];
    $a->camposDinamicosAjax();
}
if (isset($_POST["validarEmail"])) {

    $b = new Ajax();
    $b->validarEmail = $_POST["validarEmail"];
    $b->validarEmailAjax();

}

#Operacion con ajax(axios) vuejs
switch ($_GET['op']) {
    case 'planesWeb':
        $rpta = GestorPlanesController::mostrarPlanesWebPorCategoriaControlador();
        echo $rpta;
        break;
    case 'planesRevista':
        $rpta = GestorPlanesController::mostrarPlanesRevistaPorCategoriaControlador();
        echo $rpta;
        break;

    #Crear Anuncio Ajax -- metodos de listados
    case "listarDepartamentos":
        $data = GestorAnunciosController::mostrarDepartamentos();
        echo json_encode($data);
        break;

    case "listarProvincias":
        $id = $_POST["id"];
        $data = GestorAnunciosController::listarProvincias($id);
        echo json_encode($data);
        break;

    case "listarDistritos":
        $id = $_POST["id"];
        $data = GestorAnunciosController::listarDistritos($id);
        echo json_encode($data);
        break;

    case "mostrarSubCategoria":
        $nombre_categoria = $_POST["nombre_categoria"];
        $data = GestorAnunciosController::mostrarSubCategoria($nombre_categoria);
        echo json_encode($data);
        break;

    case "mostrarMarcas":
        $idsubcategoria = $_POST["id"];
        $data = GestorAnunciosController::mostrarMarcas($idsubcategoria);
        echo json_encode($data);
        break;

    case "mostrarModelos":
        $idmarca = $_POST["id"];
        $data = GestorAnunciosController::mostrarModelos($idmarca);
        echo json_encode($data);
        break;

    #Listar ultimas publicaciones del usuario
    case "listarPublicaciones":
        $buscar = $_GET["buscar"];
        $page = $_GET["page"];
        $rpta = GestorUsuariosController::listarClasificadosPorUsuarioController($page, $buscar);
        echo json_encode($rpta);
        break;

    #Editar clasificado x user
    case 'editarClasificado':
        $data = GestorUsuariosController::editarClasificadoController();
        echo json_encode($data);
        break;
    #(Desactivar o activar)
    case "activarClasificado":
        $rpta = GestorUsuariosController::activarClasificado();
        echo $rpta;
        break;
    case "desactivarClasificado":
        $rpta = GestorUsuariosController::desactivarClasificado();
        echo $rpta;
        break;

    #Ultimos movimientos
    case 'movimientos':
        $pagina = $_GET['pagina'];
        $buscar = $_GET['buscar'];
        $data = GestorUsuariosController::movimientosController($pagina, $buscar);
        echo json_encode($data);
        break;
}

