<?php

require_once "../../../controlador/controlador_gestor_anuncios.php";
require_once "../../../modelo/modelo_gestor_anuncios.php";

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
