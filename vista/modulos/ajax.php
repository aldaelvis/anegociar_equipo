<?php

require_once "../../controlador/controlador_gestor_usuarios.php";
require_once "../../modelo/modelo_gestor_usuarios.php";

class Ajax{

	public $validarUsuario;
	public $validarEmail;

	public function validarUsuarioAjax(){

		$datos = $this->validarUsuario;

		$respuesta = GestorAnunciosController::camposDinamicosPorCategoriaController($datos); 

		echo $respuesta;

	}

	public function validarEmailAjax(){

		$datos = $this->validarEmail;

		$respuesta = MvcController::validarEmailController($datos); 

		echo $respuesta;

	}

}

if(isset( $_POST["validarUsuario"])){
	
	$a = new Ajax();
	$a -> validarUsuario = $_POST["validarUsuario"];
	$a -> validarUsuarioAjax();

}

if(isset( $_POST["validarEmail"])){

	$b = new Ajax();
	$b -> validarEmail = $_POST["validarEmail"];
	$b -> validarEmailAjax();

}

