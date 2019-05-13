<?php

class GestorUbicacionesController{

	#SELECTLIST DE CREAR ANUNCIOS LISTAS CATEGORIAS
	#------------------------------------
	public function vistaAnunciosUbicacionController(){

		$respuesta = GestorUbicacionesModel::vistaCrearAnunciosUbicacionModel("Tdepartamentos");

		$categoria = $_GET["cat"];
		#echo $categoria;
		echo "
		<h4 id='click' style='margin:0;'>Filtrar por Ubicacion:</h4>";
		foreach($respuesta as $row => $item){
			#echo '<a href="index.php?action=lima&id=vehiculos&ubi='.$item["nombredepartamento"].'">'.$item["nombredepartamento"].'</a>';

			#echo $item["nombredepartamento"];
			echo '<br/><a href="index.php?action=ubicacion_clasificados&cat='.$categoria.'&dep='.$item["nombredepartamento"].'">'.$item["nombredepartamento"].'</a>';
			#echo '<br/>'.$item["nombredepartamento"];

		}
	}

	#SELECTLIST DE CREAR ANUNCIOS LISTAS CATEGORIAS
	#------------------------------------
	public function mostrarUbicacionesPorCategoriasYSubcategoriasController(){

		$respuesta = GestorUbicacionesModel::vistaCrearAnunciosUbicacionModel("Tdepartamentos");

		$categoria = $_GET["cat"];
		$subcategoria = $_GET["subcat"];
		#echo $categoria;
		echo "<h4 style='margin:0;'>Filtrar por Ubicacion:</h4>";
		foreach($respuesta as $row => $item){
			#echo '<a href="index.php?action=lima&id=vehiculos&ubi='.$item["nombredepartamento"].'">'.$item["nombredepartamento"].'</a>';

			#echo $item["nombredepartamento"];
			echo '<br/><a href="index.php?action=ubicacion_clasificados&cat='.$categoria.'&subcat='.$subcategoria.'&dep='.$item["nombredepartamento"].'">'.$item["nombredepartamento"].'</a>';
			#echo '<br/>'.$item["nombredepartamento"];

		}
	}

	public function mostrarClasificadosCategoriasPorUbicacionController(){

		$datosController = $_GET["cat"];
		$datosController2 = $_GET["dep"];
		// $prueba = $datosController.$datosController2;
			#echo $datosController2;
			#echo "Filtrar por ubicacion";
		//echo $datosController2;
		// echo $prueba;

		$respuesta = GestorUbicacionesModel::mostrarClasificadosCategoriasPorUbicacionModel($datosController, $datosController2, "Tclasificados");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		#$numberpaginas=10;
		$ruta = "vista/imagenes/anuncios/";

		if (!empty($respuesta)){

			foreach($respuesta as $row => $item){

				echo'
					<div class="bloque-lista-clasificados">
			 			<div class="lista-clasificados-campos">
							<div class="campo-imagen">
								<div class="imagen">
									<a href="ver_clasificado-'.$item["idclasificado"].'-'.str_replace( " ", "_", $item["titulo"]).'.html">
										<img src="'.$ruta.$item["nombreimagen"].'" class="img-thumbnail">
									</a>
								</div>			
							</div>
							<div class="campo-titulo">
								<a href="index.php?action=ver_clasificado&id='.$item["idclasificado"].'">
								<h4>'.$item["titulo"].'</h4>
								</a>
							</div>
							<div class="campo-codigo-revista">
								<a href="index.php?action=ver_clasificado&id='.$item["idclasificado"].'">
									<i class="far fa-newspaper"></i>&nbsp; Cod. Revista: <b>'.$item["cod_revista"].'</b>
								</a>
							</div>
							<div class="campo-tipo-moneda">
								<a href="index.php?action=ver_clasificado&id='.$item["idclasificado"].'">
								<p>'.$item["tipo_moneda"].'</p>
								</a>
							</div>
							<div class="campo-precio">
								<a href="index.php?action=ver_clasificado&id='.$item["idclasificado"].'">
								<p>'.$item["precio"].'</p>
								</a>
							</div>
							<div class="campo-precio-condicion">
								<a href="index.php?action=ver_clasificado&id='.$item["idclasificado"].'">
								<p><span>('.$item["precio_tipo"].')</span></p>
								</a>
							</div>
							<div class="campo-descripcion">
								<a href="index.php?action=ver_clasificado&id='.$item["idclasificado"].'">
								<p>'.substr($item["descripcion"],0,200).'</p>
								</a>
							</div>
							<div class="campo-fecha-creacion">
								<a href="index.php?action=ver_clasificado&id='.$item["idclasificado"].'">
								<p>Publicado: '.$item["fechacreacion"].'</p>
								</a>
							</div>
						</div>
					</div>
				';
			}

	}
		else

			echo "No existe nungun anucio por categoria";
	}

	public function mostrarClasificadosCategoriasYSubcategoriasPorUbicacionController(){

		$datosController = $_GET["cat"];
		$datosController1 = $_GET["subcat"];
		$datosController2 = $_GET["dep"];
		// $prueba = $datosController.$datosController2;
		echo $datosController2;
		echo "Filtrar por ubicacion";
		//echo $datosController2;
		// echo $prueba;

		$respuesta = GestorUbicacionesModel::mostrarClasificadosCategoriasYSubcategoriasPorUbicacionPorUbicacionModel($datosController, $datosController1, $datosController2, "Tclasificados");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		if (!empty($respuesta)) {

		foreach($respuesta as $row => $item){

		echo'
				<div class="vista-vehiculos">
		 			<div class="vista-campos">
						<div class="vista-campo-imagen">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificado"].'">
							<img src="'.$item["imagen"].'" class="img-thumbnail">
							</a>							
						</div>
						<div class="vista-campo-titulo">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificado"].'">
							<h1>'.$item["titulo"].'</h1>
							</a>
						</div>
						<div class="vista-campo-tipo-moneda">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificado"].'">
							<p>'.$item["tipo_moneda"].'</p>
							</a>
						</div>
						<div class="vista-campo-precio">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificado"].'">
							<p>'.$item["precio"].'</p>
							</a>
						</div>
						<div class="vista-campo-descripcion">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificado"].'">
							<p>'.$item["descripcion"].'</p>
							</a>
						</div>
						<div class="vista-campo-fecha-creacion">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificado"].'">
							<p>'.$item["fechacreacion"].'</p>
							</a>
						</div>
					</div>
				</div>
			';
		}

	}
		else

			echo "No existe nungun anucio por categoria";
	}
}