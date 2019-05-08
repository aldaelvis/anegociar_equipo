<?php

class GestorAnunciosController{

	#MOSTRAR IMAGEN ARTÍCULO
	#------------------------------------------------------------
	// public function mostrarImagenController($datos){

	// 	list($ancho, $alto) = getimagesize($datos);

	// 	if($ancho < 800 || $alto < 400){

	// 		echo 0;

	// 	}

	// 	else{

	// 		$aleatorio = mt_rand(100, 999);
	// 		$ruta = "../../vista/imagenes/anuncios/temp/anuncio".$aleatorio.".jpg";
	// 		$origen = imagecreatefromjpeg($datos);
	// 		$destino = imagecrop($origen, ["x"=>0, "y"=>0, "width"=>800, "height"=>400]);
	// 		imagejpeg($destino, $ruta);

	// 		echo $ruta;
	// 	}

	// }

	/*public function guardarImagenController(){

		/*
		#Manera Basica subir fotos al servidor
		if(isset($_POST['guardaranuncio'])){

			$uploads_dir = 'vista/imagenes/anuncios/';

			foreach ($_FILES["nombreimagen"]["error"] as $key => $error) {
			    if ($error == UPLOAD_ERR_OK) {
			        $tmp_name = $_FILES["nombreimagen"]["tmp_name"][$key];
			        // basename() puede evitar ataques de denegación de sistema de ficheros;
			        // podría ser apropiada más validación/saneamiento del nombre del fichero
			        $name = basename($_FILES["nombreimagen"]["name"][$key]);
			        move_uploaded_file($tmp_name, "$uploads_dir/$name");
			    }
			}
		}
		
		if(isset($_POST['guardaranuncio'])){
			// $countfiles = count($_FILES['nombreimagen']['name']);

			// $ruta = "vista/imagenes/anuncios/";

  	// 		for($i=0;$i<$countfiles;$i++){

			// $aleatorio = mt_rand(100, 999);

			// $imagen=$_FILES['nombreimagen']['name'][$i];

			// #echo $imagen;
			// move_uploaded_file($_FILES['nombreimagen']['tmp_name'][$i],$ruta.$imagen);

			// $datosController = array("nombreimagen"=>$imagen
			// 	                 );

			// $respuesta = GestorAnunciosModel::guardarImagenModel($datosController, "Tgaleria_imagenes_clasificados");
			// }
			// if($respuesta == "ok"){

			// 	echo'Guardado correctamente';
		
			// }

			// else{

			// 	echo $respuesta;

			// }
		}
	}
*/

	#SELECTLIST DE CREAR ANUNCIOS LISTAS CATEGORIAS
	#------------------------------------
	public function vistaAnunciosCategoriaController(){

		$respuesta = GestorCategoriasModel::vistaCrearAnunciosCategoriaModel("Tcategorias");

		foreach($respuesta as $row => $item){
			echo '<option value='.$item['idcategoria'].'>'.$item['nombrecategoria'].'</option>';

		}
	}

	#SELECTLIST DE CREAR ANUNCIOS LISTAS SUBCATEGORIAS
	#------------------------------------
	public function CrearAnunciosMostrarSubCategoriasController(){

		$capturar_cat_plan_post = filter_input(INPUT_POST, 'cat-plan');
		$separar_valor_cat_plan_post = explode('|', $capturar_cat_plan_post);
		$valor_uno_cat = $separar_valor_cat_plan_post[0];
		$valor_dos_plan = $separar_valor_cat_plan_post[1];
		
		#$captura_Categoria = $_POST["cat"];
		$captura_Categoria = $valor_uno_cat;

		$respuesta = GestorCategoriasModel::CrearAnunciosMostrarSubCategoriasModel($captura_Categoria, "Tcategorias");

		foreach($respuesta as $row => $item){
			echo '<option value='.$item['idsubcategoria'].'>'.$item['nombre_subcategoria'].'</option>';

		}
	}

	#CAMBIAR CAMPOSD DE ACUERDO A LA CATEGORIA
	#------------------------------------
	public function camposDinamicosPorCategoriaController(){

		if($_POST["categoriacrearanuncio"]=='1')
		   {
		   		// echo'estos son vehiculos';
				echo '<div class="tipo-detalles">
					<label for="tipo-detalles">Tipo / Detalles<span></span></label>
					<div class="tipo-categoria-detalles">
						<label for="tipomodelo"> <span></span></label>
						<select name="tipomodelo" class="tipomodelo">
							<option value="">Tipo...</option>															
							<option value="1">Sedan</option>
							<option value="2">Camioneta SUV</option>
							<option value="3">Camioneta Pick Up</option>
							<option value="4">Bus, Combis, Minivan</option>
							<option value="5">Hatchback</option>
							<option value="6">Station Wagon</option>
							<option value="7">Deportivos</option>
							<option value="8">Camion, Tracto</option>
						</select>
					</div>
					<div class="tipocombustible">	
						<label for="tipocombustiblecrearanuncio"> <span></span></label>
						<select name="tipocombustiblecrearanuncio" class="tipocombustiblecrearanuncio">
							<option value="">Combustible...</option>
							<option value="Gas">Gas</option>
							<option value="Gasolina">Gasolina</option>
							<option value="Petroleo">Petroleo</option>
							<option value="Dual">Dual</option>
							<option value="Gas GLP">Gas GLP</option>
							<option value="Gas GNV">Gas GNV</option>
							<option value="Hibrido">Hibrido</option>
							<option value="Diesel">Diesel</option>
							<option value="Electrico">Eléctrico</option>
						</select>
					</div>
					<div class="tipotransmision">	
						<label for="tipotransmisioncrearanuncio"> <span></span></label>
						<select name="tipotransmisioncrearanuncio" class="tipotransmisioncrearanuncio">
							<option value="">Transmisión...</option>
							option value="Mecanica">Mecanica</option>
							<option value="Automatica">Automatica</option>
							<option value="Automatica / Secuencial">Automatica / Secuencial</option>
						</select>
					</div>
				</div>
				<div class="condicion-vehiculo">
					<label for="condicion-vehiculo">Condicion <span></span></label>
					<div class="condicion-usado">
						<input type="radio" name="condicion" value="1" id="new" checked="checked" onchange="getval(this);"> 
						<label for="new">Usado</label>
					</div>
					<div class="condicion-nuevo">
						<input type="radio" name="condicion" value="2" id="used" onchange="getval(this);"> 
					<label for="used">Nuevo</label>
					</div>		
					<div class="condicion-kilometraje">
						<input type="text" name="kilometraje" id="kilometraje" class="form-control" placeholder="Kilometraje" autocomplete="off" maxlength="10">
					</div>
				</div>
			';
		}
		elseif($_POST["categoriacrearanuncio"]=='2')
		{
			// echo'estos son inmuebles';
			echo '
					<div class="tipoinmueble">	
						<label for="tipoinmueblecrearanuncio">Tipo / Seccion*<span></span></label>
						<select name="tipoinmueblecrearanuncio">
							<option value="">Tipo...</option>												
							<option value="27">Venta</option>
							<option value="28">Alquiler</option>
							<option value="29">Traspaso</option>
							<option value="30">Anticresis</option>
						</select>
					</div>
					<div class="tiposeccion">	
						<label for="tiposeccioncrearanuncio"> <span></span></label>
						<select name="tiposeccioncrearanuncio">
							<option value="">Sección...</option>												
							<option value="17">Departamentos</option>														
							<option value="18">Habitaciones</option>			
							<option value="19">Casas</option>			
							<option value="20">Casas de Playa</option>			
							<option value="21">Casas de Campo</option>			
							<option value="22">Oficinas</option>			
							<option value="23">Local Comercial</option>			
							<option value="24">Local Industrial</option>			
							<option value="25">Terrenos / Lotes</option>			
							<option value="26">Terreno Agricola</option>
						</select>
					</div>
					<div class="numerohabitaciones">	
						<label for="numerohabitacionescrearanuncio"> <span></span></label>
						<select name="numerohabitacionescrearanuncio">
							<option value="">Seleccione...</option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
						</select>
					</div>
					<div class="numerocuartosbaños">	
						<label for="numerocuartosbañoscrearanuncio"> <span></span></label>
						<select name="numerocuartosbañoscrearanuncio">
							<option value="">Seleccione...</option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
						</select>
					</div>
					<label>Metros Cuadrados</label>
					<input type="text" name="metros" id="metros" class="form-control" placeholder="m2" maxlength="8" autocomplete="off">
			';
		}
		else{
			// echo'default';
   		}

	}
	
	#GUARDAR ARTICULO
	#-----------------------------------------------------------
	public function guardarArticuloController(){

		$captura_Categoria = $_GET["cat"];
		$captura_Plan = $_GET["plan"];
	/*
		echo '<h1>'.$captura_Categoria.'</h1>';
		echo '<h1>'.$captura_Plan.'</h1>';
	*/
		$consulta_Plan = GestorCategoriasModel::mostrarPrecioPlanModel($captura_Categoria, $captura_Plan, "Tplanes");
	/*
		echo '<h1>'.$consulta_Plan["nombre_plan"].'</h1>';
		echo '<h1>'.$consulta_Plan["categoria_plan"].'</h1>';
		echo '<h1>'.$consulta_Plan["precio_plan"].'</h1>';
	*/
		$nombre_Plan= $consulta_Plan["nombre_plan"];
		#$categoria_plan= $consulta_Plan["categoria_plan"].'</h1>';
		#$precio_Plan= $consulta_Plan["precio_plan"].'</h1>';

		echo $nombre_Plan;
		echo $categoria_plan;
		echo $precio_Plan;

		$clasificado_activo= 1;
		$clasificaedo_inactivo= 0;

			if(isset($_POST["guardaranuncio"])){

				$Pais = 1;
				$datosController3 = array("idpais"=>$Pais,
										  "iddepartamento"=>$_POST["ubicacioncrearanunciodep"],
										  "idprovincia"=>$_POST["ubicacioncrearanuncioprov"],
										  "iddistrito"=>$_POST["ubicacioncrearanunciodis"]
						                 );

				$respuestaUbicaciones = GestorAnunciosModel::guardarUbicacionesClasificadosModel($datosController3, "Tdetalles_ubicaciones_clasificados");

				if($respuestaUbicaciones == "ok"){

					echo'<br />ubicacion Guardado correctamente';
				
				}
				else{
					echo'<br />No se Guardado ubicacion';
				}

				$respuestaIDUbicacion = GestorAnunciosModel::RecuperarIDUbicacionModel("Tdetalles_ubicaciones_clasificados");

				foreach($respuestaIDUbicacion as $array) {
					foreach($array as $ubi) {
						$idubicacion = $ubi . " ";
					}
				}
				echo '<br/>'.$idubicacion;

				$datosController2 = array("idcategoria"=>$_POST["categoriacrearanuncio"],
										  "idsubcategoria"=>$_POST["subcategoriacrearanuncio"]
						                 );

				$respuestaCaracteristicas = GestorAnunciosModel::guardarCaracteristicasClasificadosModel($datosController2, "Tdetalles_caracteristicas_clasificados");

				if($respuestaCaracteristicas == "ok"){

					echo'<br/>caracteristica Guardada';
				
				}
				else{
					echo'<br />No se Guardado caracteristica';
				}

				$respuestaIDCaracteristica = GestorAnunciosModel::RecuperarIDCaracteristicaModel("Tdetalles_caracteristicas_clasificados");

				foreach($respuestaIDCaracteristica as $array1) {
					foreach($array1 as $car) {
						$idcaracteristica = $car . " ";
					}
				}
				echo '<br/>'.$idcaracteristica;
				
				$datosController = array("titulo"=>$_POST["titulocrearanuncio"],
					                     "descripcion"=>$_POST["descripcioncrearanuncio"]."...",
				 	                     #"imagen"=>$ruta,
				 	                     "tipo_moneda"=>$_POST["tipomonedacrearanuncio"],
				 	                     "precio"=>$_POST["preciocrearanuncio"],
				 	                     "celular"=>$_POST["celularcrearanuncio"],
				 	                     #"idgaleria_imagen_clasificado"=>$numbers,
				 	                     "estado"=>$clasificado_activo,
				 	                     "iddetalle_caracteristica_clasificado"=>$idcaracteristica,
				 	                     "iddetalle_ubicacion_clasificado"=>$idubicacion
				 	                  	 #"idpais"=>$_POST["ubicacioncrearanunciodce"]
				 	                  	 #"idusuarios"=>$_POST["iducrearanuncio"]
					                 	);
				$respuestaClasificado = GestorAnunciosModel::guardarClasificadosModel($datosController, "Tclasificados");

				if($respuestaClasificado == "ok"){

					echo'<br />Clasificado Guardado correctamente';

					// echo "New record created successfully. Last inserted ID is: " . $last_id;
					#header("location:index.php?action=crear_anuncio");
					#header("location:index.php?action=ok");
				}
				else{

					echo "<br />no se guado clasificado<br />";
				}
				
				$respuestaIDGaleria = GestorAnunciosModel::RecuperarIDClasificadosModel("Tclasificados");

				foreach($respuestaIDGaleria as $array3) {
					foreach($array3 as $clas) {
						$idclasificado = $clas . " ";
					}
				}
				echo '<br/>'.$idclasificado;

				#$respuesta2 = GestorAnunciosModel::mostrarIdModel("Tclasificados");

					#foreach($respuesta2 as $row);
					#echo '<br>'.$row["idclasificados"].'';

				$countfiles = count($_FILES['nombreimagen']['name']);

				$ruta = "vista/imagenes/anuncios/";

					for($i=0;$i<$countfiles;$i++){

				$aleatorio = mt_rand(100, 999);

				$imagen=$_FILES['nombreimagen']['name'][$i];

				#echo $imagen;
				move_uploaded_file($_FILES['nombreimagen']['tmp_name'][$i],$ruta.$imagen);

				$datosController1 = array("nombreimagen"=>$imagen,
										  "idclasificado"=>$idclasificado
					                 	 );

				$respuestaGaleria = GestorAnunciosModel::guardarGaleriaImagenClasificadosModel($datosController1, "Tgaleria_imagenes_clasificados");
				}

				if($respuestaGaleria == "ok"){

					echo "&lt;br&gt;<br />imagen Guardado correctamente";
					#header("location:clasificado_exitoso");
				
				}
				else{

					echo "<br />no se guardo imagenes<br />";
					#cho $respuesta;

				}
			}


		#elseif ($nombre_Plan=="DESTACADO"){ echo "Tu anuncio es destacado";

	/*
		$num1= 3;
		$num2= 7;
		$numero;
		$numero = $num1 + $num2;
		echo "La suma de 3 y 7 es: $numero<br>";
		*/
		/*
		foreach ($consulta_Plan as $row => $item) {

			echo '<h1>'.$item["nombre_plan"].'</h1>';
			$Nombres_Planes=$item["nombre_plan"];
			$Categorias_Planes=$item["categoria_plan"];
	*/
			
		
		/*
		elseif ($categoria_plan=$otroplan){
			echo "tu anuncio no es gratis debe pagar";
		}
		*/
		/*
		else 
			echo "no elegiate ningun plan";
			*/
	/*
		foreach($consulta_Plan as $array) {
			foreach($array as $plan) {
				$precio_plan = $plan . " ";
			}
		}
		echo '<h1>muestrate'.$precio_plan.'</h1>';
	*/
		
	}


	#MOSTRAR SOLO UN ANUNCIO
	public function PruebaGaleriaController(){
	
	$numero_fotos =2;
	echo '<h1>'.$numero_fotos.'</h1>';
		echo'
		<juiceboxgallery
			galleryTitle="Juicebox Lite Gallery"
		>
		  <image imageURL="vista/modulos/galeria/images/wide.jpeg"
			thumbURL="vista/modulos/galeria/thumbs/wide.jpeg"
			linkURL="vista/modulos/galeria/images/wide.jpeg"
			linkTarget="_blank">
			<title>Welcome to Juicebox!</title>
		  </image>
		</juiceboxgallery>
		';
							
	
	}

	#MOSTRAR SOLO UN ANUNCIO
	public function mostrarClasificadosController(){

	$datosController = $_GET["id"];
	$respuesta = GestorAnunciosModel::mostrarClasificadosModel($datosController, "Tclasificados");
	
	$respuesta2 = GestorAnunciosModel::MostarGaleriaImagenClasificadosModel($datosController, "Tclasificados");	
	
	$ruta = "vista/imagenes/anuncios/";

	echo '
	<div id="bloque-contenido-galeria">
		<div id="slides">
			<ul class="pgwSlideshow">
	';
	foreach($respuesta2 as $row => $item) {	
		/*
		echo' 
			<input type="radio" name="slide_switch" id="id'.$item["idgaleria_imagen_clasificado"].'"/>
			<label for="id'.$item["idgaleria_imagen_clasificado"].'">
			<img src="'.$ruta.$item["nombreimagen"].'" class="img-thumbnail" width="100">
			</label>
			<img src="'.$ruta.$item["nombreimagen"].'" class="img-thumbnail"class="miniatura-imagen"/>
		';
		*/
		echo' 

	        <li><img src="'.$ruta.$item["nombreimagen"].'" alt="San Francisco, USA" data-description="Golden Gate Bridge"></li>
		';
		
	}
	echo '
				</ul>
			</div>
		</div>
	';
	#var_dump($respuesta);
	echo' 
			<div id="bloque-contenido-detalles-clasificado">
	 			<div class="contenido-campos">
	 				<input type="hidden" value="'.$respuesta["idclasificado"].'" name="idEditar">
					<div class="campo-titulo">
						<h1>'.$respuesta["titulo"].'</h1>
					</div>
					<div class="campo-tipo-moneda">
						<h2>'.$respuesta["tipo_moneda"].'</h2>
					</div>
					<div class="campo-precio">
						<h2>'.$respuesta["precio"]." .00".'</h2>
					</div>
					<div class="campo-fecha-creacion">
					<label for="celularcrearanuncio">Numero de contacto</label>
					<p><img src="vista/temas/imagenes/celular.png">
						'.$respuesta["celular"].'</p>
					</div>
										<div class="campo-descripcion">
						<p>'.$respuesta["descripcion"].'</p>
					</div>
				</div>
			</div>
		';
	}

	#BORRAR ARTICULO
	#------------------------------------
	public function borrarArticuloController(){

		if(isset($_GET["idBorrar"])){

			unlink($_GET["rutaImagen"]);

			$datosController = $_GET["idBorrar"];

			$respuesta = GestorArticulosModel::borrarArticuloModel($datosController, "articulos");

			if($respuesta == "ok"){

					echo'<script>

					swal({
						  title: "¡OK!",
						  text: "¡El artículo se ha borrado correctamente!",
						  type: "success",
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
					},

					function(isConfirm){
							 if (isConfirm) {	   
							    window.location = "articulos";
							  } 
					});


				</script>';

			}

		}

	}

	#ACTUALIZAR ARTICULO
	#-----------------------------------------------------------

	public function editarArticuloController(){

		$ruta = "";

		if(isset($_POST["editarTitulo"])){

			if(isset($_FILES["editarImagen"]["tmp_name"])){	

				$imagen = $_FILES["editarImagen"]["tmp_name"];

				$aleatorio = mt_rand(100, 999);

				$ruta = "vista/imagenes/articulos/articulo".$aleatorio.".jpg";

				$origen = imagecreatefromjpeg($imagen);

				$destino = imagecrop($origen, ["x"=>0, "y"=>0, "width"=>800, "height"=>400]);

				imagejpeg($destino, $ruta);

				$borrar = glob("vista/imagenes/articulos/temp/*");

				foreach($borrar as $file){
				
					unlink($file);
				
				}

			}

			if($ruta == ""){

				$ruta = $_POST["fotoAntigua"];

			}

			else{

				unlink($_POST["fotoAntigua"]);

			}

			$datosController = array("id"=>$_POST["id"],
			                         "titulo"=>$_POST["editarTitulo"],
								     "introduccion"=>$_POST["editarIntroduccion"],
								     "ruta"=>$ruta,
								     "contenido"=>$_POST["editarContenido"]);

			$respuesta = GestorArticulosModel::editarArticuloModel($datosController, "articulos");

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  title: "¡OK!",
						  text: "¡El artículo ha sido actualizado correctamente!",
						  type: "success",
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
					},

					function(isConfirm){
							 if (isConfirm) {	   
							    window.location = "articulos";
							  } 
					});


				</script>';

			}

			else{

				echo $respuesta;

			}

		}

	}


	#ACTUALIZAR ORDEN 
	#---------------------------------------------------
	public function actualizarOrdenController($datos){

		GestorArticulosModel::actualizarOrdenModel($datos, "articulos");

		$respuesta = GestorArticulosModel::seleccionarOrdenModel("articulos");

		foreach($respuesta as $row => $item){

			echo ' <li id="'.$item["id"].'" class="bloqueArticulo">
					<span class="handleArticle">
					<a href="index.php?action=articulos&idBorrar='.$item["id"].'&rutaImagen='.$item["ruta"].'">
						<i class="fa fa-times btn btn-danger"></i>
					</a>
					<i class="fa fa-pencil btn btn-primary editarArticulo"></i>	
					</span>
					<img src="'.$item["ruta"].'" class="img-thumbnail">
					<h1>'.$item["titulo"].'</h1>
					<p>'.$item["introduccion"].'</p>
					<input type="hidden" value="'.$item["contenido"].'">
					<a href="#articulo'.$item["id"].'" data-toggle="modal">
					<button class="btn btn-default">Leer Más</button>
					</a>

					<hr>

				</li>

				<div id="articulo'.$item["id"].'" class="modal fade">

					<div class="modal-dialog modal-content">

						<div class="modal-header" style="border:1px solid #eee">
				        
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						 <h3 class="modal-title">'.$item["titulo"].'</h3>
			        
						</div>

						<div class="modal-body" style="border:1px solid #eee">
			        
							<img src="'.$item["ruta"].'" width="100%" style="margin-bottom:20px">
							<p class="parrafoContenido">'.$item["contenido"].'</p>
			        
						</div>

						<div class="modal-footer" style="border:1px solid #eee">
			        
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        
						</div>

					</div>

				</div>';

		}


	}



	public function mostrarListaClasificadosUsuariosController(){
		// $datosController = $_GET["id"];
		// $respuesta = GestorAnunciosModel::mostrarClasificadosModel($datosController, "clasificados");
		
		#$datosController = $_GET["id"];
		$respuesta = GestorAnunciosModel::mostrarListaClasificadosUsuariosModel("clasificados");		

		foreach($respuesta as $row => $item) {
		
			echo'
					<div class="vista-vehiculos">
			 			<div class="vista-campos">
							<div class="vista-campo-imagen">
								<a href="index.php?action=verclasificado&id='.$item["idclasificados"].'">
								<img src="'.$item["imagen"].'" class="img-thumbnail">
								</a>
							</div>
							<div class="vista-campo-titulo">
								<a href="index.php?action=verclasificado&id='.$item["idclasificados"].'">
								<h1>'.$item["titulo"].'</h1>
								</a>
							</div>
							<div class="vista-campo-tipo-moneda">
								<a href="index.php?action=verclasificado&id='.$item["idclasificados"].'">
								<p>'.$item["tipo_moneda"].'</p>
								</a>
							</div>
							<div class="vista-campo-precio">
								<a href="index.php?action=verclasificado&id='.$item["idclasificados"].'">
								<p>'.$item["precio"].'</p>
								</a>
							</div>
							<div class="vista-campo-descripcion">
								<a href="index.php?action=verclasificado&id='.$item["idclasificados"].'">
								<p>'.$item["descripcion"].'</p>
								</a>
							</div>
							<div class="vista-campo-fecha-creacion">
								<a href="index.php?action=verclasificado&id='.$item["idclasificados"].'">
								<p>'.$item["fechacreacion"].'</p>
								</a>
							</div>
						</div>
					</div>
				';
			
		}

	}	

}
?>