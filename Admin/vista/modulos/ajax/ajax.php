<?php
require_once "../../../controlador/controlador_gestor_anuncios.php";
require_once "../../../modelo/modelo_gestor_anuncios.php";

require_once "../../../controlador/controlador_gestor_usuarios.php";
require_once "../../../modelo/modelo_gestor_usuarios.php";

class Ajax{

	public $validarEmail;
	public $pruebaAjax;

	public function validarEmailAjax(){

		$datos = $this->validarEmail;

		$respuesta = MvcController::validarEmailController($datos); 

		echo $respuesta;

	}

	public function pruebaAjax(){

		$data = GestorUsuariosController::pruebaAjaxController(); 

		echo json_encode($data);

	}
}

if(isset( $_POST["validarEmail"])){

	$b = new Ajax();
	$b -> validarEmail = $_POST["validarEmail"];
	$b -> validarEmailAjax();

}



// -----------------------------------Peticiones Ajax
#----------------Listado de departamentos ajax (elvis)

switch ($_GET['op']) {
	case 'listarUsuarios':
		$data = GestorUsuariosController::listarUsuariosControlller();
		echo json_encode($data);
		break;
	case 'guardaryeditar':
		$data = GestorUsuariosController::nuevoUsuarioController();
		echo json_encode($data);
	break;
	case 'desactivar':
		$data = GestorUsuariosController::desactivarUsuarioController();
		echo $data;
	break;
	case 'activar':
		$data = GestorUsuariosController::activarUsuarioController();
		echo $data;
	break;
	case 'mostrar':
		$data = GestorUsuariosController::mostrarUsuarioController();
		echo json_encode($data);
	break;
	case 'recargar':
		$data = GestorUsuariosController::recargarSaldoUsuarioController();
	break;
}
