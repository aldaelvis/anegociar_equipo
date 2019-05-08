<?php

class GestorCategoriasController{


	#SELECTLIST DE CREAR ANUNCIOS LISTAS CATEGORIAS
	#------------------------------------
	public function MostrarCategoriasYSubcategoriasController(){

		$respuesta = GestorCategoriasModel::MostrarCategoriasYSubcategoriasModel("Tcategorias");

		// foreach($respuesta as $row){
		// 	echo '
		// 		<h5>'.$row['nombrecategoria'].'</h5>
		// 		';
		// }
		$idProfesor = 0;
		$verifica_nombre_categoria = '';
		$ruta_imagenes = 'vista\temas\img\pagina/categorias&#92';
		$categories = array();

		foreach($respuesta as $row) {
		    if(!isset($categories[$row['catid']])) {
		        $categories[$row['catid']] = array(
		            'id' => $row['catid'],
		            'name' => $row['catname'],
		            'img' => $row['catimg'],
		            'products' => array(),
		        );
		    }
		    $categories[$row['catid']]['products'][] = array(
		            'id' => $row['prodId'],
		            'name' => $row['prodName'],
		    );
		}

   		foreach($categories as $cat) {
		    echo '<div class="anegociar-categorias-subcategorias"><div class="suerte">'.'<img src="'.$ruta_imagenes.$cat['img'] .'" alt="anwegociarperu-imagen-categorias" class="img-responsive">'.'<h5>'.$cat['name'].'</h5><ul>';
		    foreach($cat['products'] as $prod) {
		        echo '<li><a href="&id=' . $prod['id'] . '">' . $prod['name'] . '</a></li>';
		    }
		    echo '</ul></li></div></div>';
		}


	}
	
	public function mostrarClasificadosPorCategoriaController(){
	/*
	$item_limit = 10; // 10 Results a Page
	$page_set = isset($_GET{'page_number'});
	$page = $page_set ? $_GET{'page_number'}+1:0;
	echo '<h1>'.$page.'/<h1>';
	$offset = $page_set ? $item_limit * $page_number:0;
	echo '<h1>'.$offset.'/<h1>';

		$pagewa  = 1;
		$limit = 20;
		$start = $page * $limit;*/

		//Verificando si los anuncios estan activos o inactivos

		$captura_Categoria = $_GET["cat"];

		//Mustera la categoria en la pagina categorias_clasificados
		#echo $captura_Categoria;

		$consulta_estado_clasificados = GestorAnunciosModel::verificarEstadoClasificadosModel("Tclasificados");

		$estado_Clasificado = $consulta_estado_clasificados["estado"];

		#echo $estado_Clasificado;

		$clasificado_activo= 1;
		$clasificaedo_inactivo= 0;

		if ($estado_Clasificado=$clasificado_activo)  {
			#echo "Tu claificados estan activos";


		$consulta_total_clasificados = GestorCategoriasModel::contarClasificadosModel("Tclasificados");

		foreach($consulta_total_clasificados as $array) {
			foreach($array as $t_c) {
				$total_clasificados = $t_c . " ";
			}
		}
		
		$cantidad_elementos = 5;  
		$pagina = '';  
		
		if(isset($_GET["page"]))  
		{  
		      $pagina = $_GET["page"];  
		      #echo '<h1>'.$page.'</h1>'; 
		}
		else  
		{  
		     $pagina = 1;  
		}
		
		#$page=0;
		$mostrar_desde = ($pagina - 1)*$cantidad_elementos;
		#echo '<h1>'.$start_from.'</h1>';
		
		$respuesta = GestorCategoriasModel::mostrarClasificadosPorCategoriaModel($captura_Categoria, $mostrar_desde, $cantidad_elementos, "Tclasificados"); 

 		#$numberpaginas=10;
		$ruta = "vista/imagenes/anuncios/";

 		foreach($respuesta as $row => $item){
		
		echo'
				<div class="vista-vehiculos">
		 			<div class="vista-campos">
						<div class="vista-campo-imagen">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificado"].'">
							<img src="'.$ruta.$item["nombreimagen"].'" class="img-thumbnail">
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
							<p>'.substr($item["descripcion"],0,240).'</p>
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
		
		#echo $row;

 		$numero_de_paginas = ceil($total_clasificados/$cantidad_elementos);
 		#echo '<h1>'.$number_of_pages.'</h1>';
 		
 		for ($i=1;$i<=$numero_de_paginas;$i++) {
	  		echo '
	  			<div class="paginador">
	  				<a href="index.php?action=categorias_clasificados&cat='.$captura_Categoria.'&page=' . $i . '">' . $i . '</a>
				</div>
	  			';

		}
	}
		
	}

	#SELECTLIST DE CREAR ANUNCIOS LISTAS CATEGORIAS
	#------------------------------------
	public function MostrarPromoverMarcasController(){

		$captura_Categoria = $_GET["cat"];
		
		$respuesta = GestorCategoriasModel::MostrarPromoverMarcasModel($captura_Categoria, "Tcategorias");
		
		$ruta = "vista/temas/img/pagina/vehiculos/marcas/";
		foreach($respuesta as $row => $item) {

		echo'
				<li class="cloned">
				<a href="#" title="Wonky Buildings">
				<img src="'.$ruta.$item["imagen_marca"].'" height="auto" width="auto" alt="Wonky Buildings">
				</a>
				</li>
			';
		}
	}
	#MOSTRAR EMPLEOS
	#-----------------------------------------------------------
	public function mostrarClasificadosEmpleosController(){

		$respuesta = GestorCategoriasModel::mostrarClasificadosEmpleosModel("Tclasificados");

		foreach($respuesta as $row => $item) {

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
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificados"].'">
							<p>'.$item["precio"].'</p>
							</a>
						</div>
						<div class="vista-campo-descripcion">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificados"].'">
							<p>'.$item["descripcion"].'</p>
							</a>
						</div>
						<div class="vista-campo-fecha-creacion">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificados"].'">
							<p>'.$item["fechacreacion"].'</p>
							</a>
						</div>
					</div>
				</div>
			';
		
		}

	}

	#MOSTRAR INMUEBLES
	#-----------------------------------------------------------
	public function mostrarClasificadosInmueblesController(){

		$respuesta = GestorCategoriasModel::mostrarClasificadosInmueblesModel("clasificados");		

		foreach($respuesta as $row => $item) {
			
		echo'
				<div class="vista-vehiculos">
		 			<div class="vista-campos">
						<div class="vista-campo-imagen">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificados"].'">
							<img src="'.$item["imagen"].'" class="img-thumbnail">
							</a>
						</div>
						<div class="vista-campo-titulo">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificados"].'">
							<h1>'.$item["titulo"].'</h1>
							</a>
						</div>
						<div class="vista-campo-tipo-moneda">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificados"].'">
							<p>'.$item["tipo_moneda"].'</p>
							</a>
						</div>
						<div class="vista-campo-precio">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificados"].'">
							<p>'.$item["precio"].'</p>
							</a>
						</div>
						<div class="vista-campo-descripcion">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificados"].'">
							<p>'.$item["descripcion"].'</p>
							</a>
						</div>
						<div class="vista-campo-fecha-creacion">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificados"].'">
							<p>'.$item["fechacreacion"].'</p>
							</a>
						</div>
					</div>
				</div>
			';
		}

	}
	#
	public function mostrarClasificadosVehiculosController(){
/*
	$item_limit = 10; // 10 Results a Page
	$page_set = isset($_GET{'page_number'});
	$page = $page_set ? $_GET{'page_number'}+1:0;
	echo '<h1>'.$page.'/<h1>';
	$offset = $page_set ? $item_limit * $page_number:0;
	echo '<h1>'.$offset.'/<h1>';

		$pagewa  = 1;
		$limit = 20;
		$start = $page * $limit;*/

		//Verificando si los anuncios estan activos o inactivos
		$consulta_estado_clasificados = GestorAnunciosModel::verificarEstadoClasificadosModel("Tclasificados");

		$estado_Clasificado = $consulta_estado_clasificados["estado"];

		echo $estado_Clasificado;

		$clasificado_activo= 1;
		$clasificaedo_inactivo= 0;

		if ($estado_Clasificado=$clasificado_activo)  {
			echo "Tu claificados estan activos";


		$consulta_total_clasificados = GestorCategoriasModel::contarClasificadosModel("Tclasificados");

		foreach($consulta_total_clasificados as $array) {
			foreach($array as $t_c) {
				$total_clasificados = $t_c . " ";
			}
		}

		$cantidad_elementos = 5;  
		$pagina = '';  
		
		if(isset($_GET["page"]))  
		{  
		      $pagina = $_GET["page"];  
		      #echo '<h1>'.$page.'</h1>'; 
		}
		else  
		{  
		     $pagina = 1;  
		}
		
		#$page=0;
		$mostrar_desde = ($pagina - 1)*$cantidad_elementos;
		#echo '<h1>'.$start_from.'</h1>';
		
		$respuesta = GestorCategoriasModel::mostrarClasificadosVehiculosModel($mostrar_desde, $cantidad_elementos, "Tclasificados"); 

 		#$numberpaginas=10;
		$ruta = "vista/imagenes/anuncios/";

 		foreach($respuesta as $row => $item){
		
		echo'
				<div class="vista-vehiculos">
		 			<div class="vista-campos">
						<div class="vista-campo-imagen">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificado"].'">
							<img src="'.$ruta.$item["nombreimagen"].'" class="img-thumbnail">
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
		
		#echo $row;

 		$numero_de_paginas = ceil($total_clasificados/$cantidad_elementos);
 		#echo '<h1>'.$number_of_pages.'</h1>';
 		
 		for ($i=1;$i<=$numero_de_paginas;$i++) {
	  			echo '<a href="index.php?action=vehiculos&page=' . $i . '">' . $i . '</a> ';
		}
	}
		
	}

/*
		$respuesta = GestorCategoriasModel::mostrarClasificadosVehiculosModel($pagewa ,"Tclasificados");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
		$ruta = "vista/imagenes/anuncios/";

		foreach($respuesta as $row => $item){
		
		echo'
				<div class="vista-vehiculos">
		 			<div class="vista-campos">
						<div class="vista-campo-imagen">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificado"].'">
							<img src="'.$ruta.$item["nombreimagen"].'" class="img-thumbnail">
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

		// $respuesta = Datos::mostrarClasificadosVehiculosModel("clasificados");		

		// foreach($respuesta as $row => $item) {

		// 	echo ' 	<div class="vista-vehiculos">
		// 				<div class="vista-campos"
		// 					<li id="'.$item["idclasificados"].'" class="bloqueArticulo">
		// 					<a href="index.php?action=verclasificado&idBorrar='.$item["idclasificados"].'&rutaImagen='.$item["imagen"].'">
		// 					</a>
		// 					<i class="fa fa-pencil btn btn-primary editarArticulo"></i>	
		// 					</span>
		// 					<div class="campo-imagen">
		// 					<a href="index.php?action=verclasificado&idclasificado='.$item['idclasificados'].'">
		// 					<img src="'.$item["imagen"].'" class="img-thumbnail">
		// 					</a>
		// 					</div>
		// 					<div class="campo-titulo">
		// 					<a href="index.php?action=verclasificado&id='.$item['idclasificados'].'">
		// 					<h1>'.$item["titulo"].'</h1>
		// 					</a>
		// 					</div>
		// 					<div class="campo-descripcion">
		// 					<p>'.$item["descripcion"].'</p>
		// 					</div>
		// 					<div class="campo-precio">
		// 					<p>'.$item["precio"].'</p>
		// 					</div>
		// 					<td><a href="index.php?action=verclasificado&id='.$item["id"].'"><button>Editar</button></a></td>
		// 					</li>
		// 				</div> 
		// 			</div>';
			
		}
	}
*/
	#
	public function mostrarClasificadosMotosController(){

		$respuesta = GestorCategoriasModel::mostrarClasificadosMotosModel("clasificados");		

		foreach($respuesta as $row => $item) {
		
		echo'
				<div class="vista-vehiculos">
		 			<div class="vista-campos">
						<div class="vista-campo-imagen">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificados"].'">
							<img src="'.$item["imagen"].'" class="img-thumbnail">
							</a>
						</div>
						<div class="vista-campo-titulo">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificados"].'">
							<h1>'.$item["titulo"].'</h1>
							</a>
						</div>
						<div class="vista-campo-tipo-moneda">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificados"].'">
							<p>'.$item["tipo_moneda"].'</p>
							</a>
						</div>
						<div class="vista-campo-precio">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificados"].'">
							<p>'.$item["precio"].'</p>
							</a>
						</div>
						<div class="vista-campo-descripcion">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificados"].'">
							<p>'.$item["descripcion"].'</p>
							</a>
						</div>
						<div class="vista-campo-fecha-creacion">
							<a href="index.php?action=ver_clasificado&id='.$item["idclasificados"].'">
							<p>'.$item["fechacreacion"].'</p>
							</a>
						</div>
					</div>
				</div>
			';
		}

	}
}