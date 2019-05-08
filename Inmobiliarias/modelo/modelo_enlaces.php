<?php 

class EnlacePaginas{
	
	public function enlacesPaginasModel($enlaces){


		if($enlaces == "inicio" || $enlaces == "anuncios_web" || $enlaces == "ingreso" || $enlaces == "usuarios" || $enlaces == "editar" || $enlaces == "salir" || $enlaces == "crear_anuncio" || $enlaces == "elije_tipo_anuncio" || $enlaces == "elije_plan_anuncio" || $enlaces == "ultimas_publicaciones" || $enlaces == "ultimos_movimientos" ||$enlaces == "categorias_clasificados" || $enlaces == "ubicacion_clasificados" || $enlaces == "ver_clasificado" || $enlaces == "saldo_agente" || $enlaces == "principal"){

			$module =  "vista/modulos/".$enlaces.".php";
		
		}

		else if($enlaces == "index"){

			#$module =  "views/modules/registro.php";
			$module =  "vista/modulos/inicio.php";
		
		}

		else if($enlaces == "plan_validado"){

			#$module =  "views/modules/registro.php";
			$module =  "vista/modulos/crear_anuncio.php";
		
		}

		else if($enlaces == "recargar_saldo"){

			#$module =  "views/modules/registro.php";
			$module =  "vista/modulos/saldo_agente.php";
		
		}

		else{

			#$module =  "views/modules/registro.php";
			$module =  "vista/modulos/inicio.php";

		}
		
		return $module;

	}

}

