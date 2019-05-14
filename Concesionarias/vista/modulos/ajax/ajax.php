<?php

require_once "../../../controlador/controlador_gestor_anuncios.php";
require_once "../../../modelo/modelo_gestor_anuncios.php";

require_once "../../../controlador/controlador_gestor_usuarios.php";
require_once "../../../modelo/modelo_gestor_usuarios.php";

require_once "../../../controlador/controlador_gestor_planes.php";
require_once "../../../modelo/modelo_gestor_planes.php";

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

    public function validarUsuarioAjax()
    {
        $datos = $this->validarUsuario;
        $respuesta = GestorUsuariosController::validarUsuarioController($datos);
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
if (isset($_POST["validarUsuario"])) {
    $c = new Ajax();
    $c->validarUsuario = $_POST["validarUsuario"];
    $c->validarUsuarioAjax();
}
if (isset($_POST["validarEmail"])) {
    $b = new Ajax();
    $b->validarEmail = $_POST["validarEmail"];
    $b->validarEmailAjax();
}


switch ($_GET["op"]) {
    case 'mostrarPlanesWeb':
        $dataWeb = GestorPlanesController::mostrarPlanesWebController();
        echo json_encode($dataWeb);
        break;
    case 'mostrarPlanesRevista':
        $dataRevista = GestorPlanesController::mostrarPlanesRevistaController();
        echo json_encode($dataRevista);
        break;
    case 'mostrarPreviewClasificado':
        $dataClasificado = GestorPlanesController::mostrarPreviewClasificadoController();
        echo json_encode($dataClasificado);
        break;

    ##------ (para los ultimo clasificado)
    case 'mostrarClasificado':
        $idclasificado = $_GET['idclasificado'];
        $data = GestorUsuariosController::mostrarClasifController($idclasificado);
        echo json_encode($data);
        break;

    case 'mostrarClasificadoUser':
        $data = GestorUsuariosController::clasificadosUserController();
        echo json_encode($data);
        break;

    case 'editarClasificadoUser':
        $id = $_POST['idclasificado'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $tipo_moneda = $_POST['tipo_moneda'];
        $precio = $_POST['precio'];
        $celular = $_POST['celular'];
        $precio_tipo = $_POST['precio_tipo'];
        $imagen_actual = $_POST['imagen_actual'];
        $data = GestorUsuariosController::editarClasificadoUserController($id, $titulo, $descripcion, $tipo_moneda, $precio, $celular, $precio_tipo, $imagen_actual);
        echo json_encode($data);
        break;

    case 'desactivarClasificado':
        $idclasificado = $_GET['idclasificado'];
        $data = GestorUsuariosController::desactivarClasificado($idclasificado);
        echo json_encode($data);
        break;

    case 'activarClasificado':
        $idclasificado = $_GET['idclasificado'];
        $data = GestorUsuariosController::activarClasificado($idclasificado);
        echo json_encode($data);
        break;

    //clasificados
    case 'mostrarImagenesClasificado':
        $id = $_GET['idclasificado'];
        $data = GestorUsuariosController::mostrarImagenesClasificadoController($id);
        echo json_encode($data);
        break;

    case 'listarClasificados':
        $pagina = $_GET['pagina'];
        $buscar = $_GET['buscar'];
        $data = GestorUsuariosController::listarClasificadosController($pagina, $buscar);
        echo json_encode($data);
        break;

    case 'movimientos':
        $pagina = $_GET['pagina'];
        $buscar = $_GET['buscar'];
        $data = GestorUsuariosController::movimientosController($pagina, $buscar);
        echo json_encode($data);
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
    default:
        break;
}

