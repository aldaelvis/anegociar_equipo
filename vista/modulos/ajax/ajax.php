<?php

require_once "../../../controlador/controlador_gestor_anuncios.php";
require_once "../../../modelo/modelo_gestor_anuncios.php";

require_once "../../../controlador/controlador_gestor_usuarios.php";
require_once "../../../modelo/modelo_gestor_usuarios.php";

class Ajax{

	public $validarUsuario;
	public $validarEmail;

	public $camposDinamicos;

	public function camposDinamicosAjax(){

		$datos = $this->camposDinamicos;

		$respuesta = GestorAnunciosController::camposDinamicosPorCategoriaController($datos); 

		echo $respuesta;

	}

	public function validarUsuarioAjax(){

		$datos = $this->validarUsuario;

		$respuesta = GestorUsuariosController::validarUsuarioController($datos); 

		echo $respuesta;

	}

	public function validarEmailAjax(){

		$datos = $this->validarEmail;

		$respuesta = MvcController::validarEmailController($datos); 

		echo $respuesta;

	}

}

if(isset( $_POST["categoriacrearanuncio"])){
	
	$a = new Ajax();
	$a -> camposDinamicos = $_POST["categoriacrearanuncio"];
	$a -> camposDinamicosAjax();

}


if(isset( $_POST["validarUsuario"])){
	
	$c = new Ajax();
	$c -> validarUsuario = $_POST["validarUsuario"];
	$c -> validarUsuarioAjax();

}

if(isset( $_POST["validarEmail"])){

	$b = new Ajax();
	$b -> validarEmail = $_POST["validarEmail"];
	$b -> validarEmailAjax();

}

switch ($_GET['op']) {
    case "listarDepartamentos":
        $data = GestorAnunciosController::mostrarDepartamentos();
        echo json_encode($data);
        break;

    case "listarProvincias":
        $id = $_GET["id"];
        $data = GestorAnunciosController::listarProvincias($id);
        echo json_encode($data);
        break;

    case "listarDistritos":
        $id = $_GET["id"];
        $data = GestorAnunciosController::listarDistritos($id);
        echo json_encode($data);
        break;

    #Listar todo los clasificados por usuarios
    case "listarClasificados":
        $data = GestorUsuariosController::mostrarClasificadosPorUsuarioController();
        echo json_encode($data);
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

    #Mostrar Información
    case "mostrarInformacionUsuario":
        $rpta = GestorUsuariosController::mostrarInformacionUsuarioController();
        echo json_encode($rpta);
        break;
}
