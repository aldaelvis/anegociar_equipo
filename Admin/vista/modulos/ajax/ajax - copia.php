<?php

require_once "../../../controlador/controlador_gestor_anuncios.php";
require_once "../../../modelo/modelo_gestor_anuncios.php";

class Ajax{

	public $validarUsuario;
	public $validarEmail;

	public $actualizarUsuario;
	public function actUsuAjax(){

		$datos = $this->actualizarUsuario;

		$respuesta = GestorUsuariosController::ActualizarListarAgentesController($datos); 

		echo $respuesta;

	}

	#ACTUALIZAR ITEM USUARIO
	#----------------------------------------------------------
	public $userId;
	public $firstName;
	public $email;

	public function actualizarUsuarioAjax(){

		$datos = array("userId" => $this->userId, 
			           "firstName" => $this->firstName,
			           "email" => $this->email);

		$respuesta = GestorUsuariosController::ActualizarListarAgentesController($datos);

		echo $respuesta;

	}

	public function validarEmailAjax(){

		$datos = $this->validarEmail;

		$respuesta = MvcController::validarEmailController($datos); 

		echo $respuesta;

	}

}

if(isset($_POST["userId"])){

	$a = new Ajax();
	$a -> userId = $_POST["userId"];
	$a -> actUsuAjax();	

}

if(isset($_POST["userId"])){

	$c = new Ajax();
	$c -> userId = $_POST["userId"];
	$c -> firstName = $_POST["firstName"];
	$c -> email = $_POST["email"];
	$c -> actualizarUsuarioAjax();	

}

if(isset( $_POST["validarEmail"])){

	$b = new Ajax();
	$b -> validarEmail = $_POST["validarEmail"];
	$b -> validarEmailAjax();

}

