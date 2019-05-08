<?php

require_once "../../../controlador/controlador_gestor_usuarios.php";
require_once "../../../modelo/modelo_gestor_usuarios.php";

class Ajax{

	public $validarUsuario;
	public $validarEmail;

	public function validarUsuarioAjax(){

		$datos = $this->validarUsuario;

		$respuesta = GestorUsuariosController::validarUsuarioController($datos); 

		echo $respuesta;

	}

	public function validarEmailAjax(){

		$datos = $this->validarEmail;

		$respuesta = GestorUsuariosController::validarEmailController($datos); 

		echo $respuesta;

	}

}

if(isset( $_POST["krauser"])){
	
	$a = new Ajax();
	$a -> validarUsuario = $_POST["krauser"];
	$a -> validarUsuarioAjax();

}

if(isset( $_POST["geese"])){

	$b = new Ajax();
	$b -> validarEmail = $_POST["geese"];
	$b -> validarEmailAjax();

}

