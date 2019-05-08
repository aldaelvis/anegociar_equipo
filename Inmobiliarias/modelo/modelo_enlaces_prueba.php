<?php

class Paginas{
	
	/*
	public function enlacesPaginasModel($enlaces){
		
		#Lista blanca o lista negra 
		if($enlaces == "inicio" ||
		   $enlaces == "nosotros" || 
		   $enlaces == "servicios" || 
		   $enlaces == "contactenos" ||
		   $enlaces == "inmuebles" ||
		   $enlaces == "vehiculos" ||
		   $enlaces == "motos" ||
		   $enlaces == "empleos" ||
		   $enlaces == "ingresar" || 
		   $enlaces == "usuario" || 
		   $enlaces == "registro" ||
		   $enlaces == "ubicacion" || 
		   $enlaces == "editar" ||
		   $enlaces == "borrar" ||
		   $enlaces == "elije_tipo_anuncio" ||
		   $enlaces == "elije_plan_anuncio" ||
		   $enlaces == "crear_anuncio" ||
		   $enlaces == "ver_clasificado" ||
		   $enlaces == "ubicacion_clasificados"||
		   $enlaces == "salir")
			
			{

				$module = "vista/modulos/".$enlaces.".php";

			}
			
			#Si la url es index te redirige a inicio
			else if($enlaces == "index"){

				$module =  "vista/modulos/inicio.php";
			
			}
			#Si la url es ok te redirige a registro
			else if($enlaces == "ok"){

				$module =  "vista/modulos/ingresar.php";
			
			}
			
			else if($enlaces == "registro"){

				$module =  "vista/modulos/ingresar.php";
			
			}

			else if($enlaces == "fallo"){

				$module =  "vista/modulos/ingresar.php";
			
			}

			else if($enlaces == "fallo3intentos"){

				$module =  "vista/modulos/ingresar.php";
			
			}
			else if($enlaces == "cambio"){

				$module =  "vista/modulos/usuarios.php";
			
			}

		else{

			$module =  "vista/modulos/inicio.php";

		}
		
		return $module;

	}

}
*/

	public function enlacesPaginasModel($enlaces){


		if($enlaces == "registro" || $enlaces == "ingresar" || $enlaces == "usuarios" || $enlaces == "editar" || $enlaces == "salir"){

			$module =  "vista/modulos/".$enlaces.".php";
		
		}

		else if($enlaces == "index"){

			$module =  "views/modules/registro.php";
		
		}

		else if($enlaces == "ok"){

			$module =  "views/modules/registro.php";
		
		}

		else if($enlaces == "fallo"){

			$module =  "views/modules/ingresar.php";
		
		}

		else if($enlaces == "fallo3intentos"){

			$module =  "views/modules/ingresar.php";
		
		}

		else if($enlaces == "cambio"){

			$module =  "views/modules/usuarios.php";
		
		}

		else{

			$module =  "views/modules/registro.php";

		}
		
		return $module;

	}

}


