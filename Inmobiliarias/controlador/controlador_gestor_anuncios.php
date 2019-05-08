<?php

class GestorAnunciosController{

	#ACTIVAR CLASIFICADO
	#-----------------------------------------------------------
	public function activarClasificadoController(){

		#$captura_Plan = $_POST["titulocrearanuncio"];

		#echo $captura_Plan;
		
/*
		if (isset($_POST['cat-plan'])) 
		{

			if (empty($_POST['cat-plan']))
			{
				echo "El campo titulo esta vacio";
			}
			else {
				#echo $_POST['plan_crear_anuncio'];
				$value = filter_input(INPUT_POST, 'cat-plan');
				$exploded_value = explode('|', $value);
				$value_one = $exploded_value[0];
				$value_two = $exploded_value[1];
				echo $value_two;

				$respuesta = GestorAnunciosModel::activarClasificadoModel($id, "Tclasificados");

				if($respuesta == "success"){

				#echo "<br/>se activo correctamente";
				header("location:activacion_exitosa");
			
				}
				else{

					echo "<br/>no se activo correctamente<br />";
					#cho $respuesta;
				}
			}
		}*/
		
		if (isset($_POST['cat-plan'])) 
        {
            if (empty($_POST['cat-plan']))
            {
                echo "El campo titulo esta vacio";
            }
            else {
                #echo $_POST['plan_crear_anuncio'];
                $value = filter_input(INPUT_POST, 'cat-plan');
                $exploded_value = explode('|', $value);
                $value_one = $exploded_value[0];
                $value_two = $exploded_value[1];
                echo $value_two;

             		$algo=$_SESSION['val1'];
             		$algo2=$_SESSION['val2'];

                if ($value_two=='GRATIS') {
                    echo "Gracias por activar su clasificado";
                    # code...
                    $respuesta = GestorAnunciosModel::activarClasificadoModel($algo2, "Tclasificados");

					if($respuesta == "success"){

					#echo "<br/>se activo correctamente";
					header("location:usuario");
				
					}
					else{

						echo "<br/>no se activo correctamente<br />";
						#cho $respuesta;
					}
                }
                else{
                    echo "Usted no cuwnta con saldo nos podremos en contacto";
                }
            }
        }
	}


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

			$value = filter_input(INPUT_POST, 'categoriacrearanuncio');
            $exploded_value = explode('|', $value);
            $value_one = $exploded_value[0];
            $value_two = $exploded_value[1];

		if($_POST["categoriacrearanuncio"]=='1|Vehiculos')
		   {
		   		// echo'estos son vehiculos';
				echo '<div class="tipo-detalles">
					<label for="tipo-detalles">Tipo / Detalles<span></span></label>
					<div class="tipo-categoria-detalles">
						<label for="tipomodelocrearanuncio"> <span></span></label>
						<select name="tipomodelocrearanuncio" class="tipomodelo">
							<option value="">Tipo...</option>															
							<option value="Sedan">Sedan</option>
							<option value="Camioneta SUV">Camioneta SUV</option>
							<option value="Camioneta Pick Up">Camioneta Pick Up</option>
							<option value="Bus, Combis, Minivan">Bus, Combis, Minivan</option>
							<option value="Hatchback">Hatchback</option>
							<option value="Station Wagon">Station Wagon</option>
							<option value="Deportivos">Deportivos</option>
							<option value="Camion, Tracto">Camion, Tractor</option>
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
							<option value="Mecanica">Mecanica</option>
							<option value="Automatica">Automatica</option>
							<option value="Automatica / Secuencial">Automatica / Secuencial</option>
						</select>
					</div>
				</div>
				<div class="condicion-vehiculo">
					<label for="condicion-vehiculo">Condicion <span></span></label>
					<div class="condicion-usado">
						<input type="radio" name="condicion" value="Enable" id="enable" checked > 
						<label for="new">Usado</label>
					</div>
					<div class="condicion-nuevo">
						<input type="radio" name="condicion" value="Disable" id="disable"> 
					<label for="used">Nuevo</label>
					</div>		
					<div class="condicion-kilometraje">
						<input type="number" name="kilometraje" id="kilometraje" class="kilometraje" placeholder="Kilometraje" autocomplete="off" maxlength="10">
					</div>
				</div>
			';
		}
		elseif($_POST["categoriacrearanuncio"]=='2|Inmuebles')
		{
			// echo'estos son inmuebles';
			echo '
				<div class="tipos-secciones">
				<label for="tipoinmueblecrearanuncio">Tipo / Seccion<span></span></label>
					<div class="tipoinmueble">	
						<label for="tipoinmueblecrearanuncio"> <span></span></label>
						<select name="tipoinmueblecrearanuncio">
							<option disabled value="" selected hidden>Tipo...</option>
							<option value="Venta">Venta</option>
							<option value="Alquiler">Alquiler</option>
							<option value="Traspaso">Traspaso</option>
							<option value="Anticresis">Anticresis</option>
						</select>
					</div>
					<div class="tiposeccion">	
						<label for="tiposeccioncrearanuncio"> <span></span></label>
						<select name="tiposeccioncrearanuncio">
							<option disabled value="" selected hidden>Sección...</option>
							<option value="Departamentos">Departamentos</option>
							<option value="Habitaciones">Habitaciones</option>			
							<option value="Casas">Casas</option>			
							<option value="Casas de Playa">Casas de Playa</option>			
							<option value="Casas de Campo">Casas de Campo</option>			
							<option value="Oficinas">Oficinas</option>			
							<option value="Local Comercial">Local Comercial</option>			
							<option value="Local Industrial">Local Industrial</option>			
							<option value="Terrenos / Lotes">Terrenos / Lotes</option>			
							<option value="Terreno Agricola">Terreno Agricola</option>
						</select>
					</div>
				</div>
			<div class="detalles">	
						<label for="destallescrearanuncio">Detalles <span></span></label>
					<div class="numerohabitaciones">	
						<label for="numerohabitacionescrearanuncio">#Cuartos/Espacios<span></span></label>
						<select name="numerohabitacionescrearanuncio">
							<option disabled value="" selected hidden>Seleccione...</option>
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
						<label for="numerocuartosbañoscrearanuncio">#Cuartos de Baño<span></span></label>
						<select name="numerocuartosbañoscrearanuncio">
							<option disabled value="" selected hidden>Seleccione...</option>
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
				<div class="numerocuadrados">	
						<label>Metros Cuadrados</label>
						<input type="text" name="metros" id="metros" class="form-control" placeholder="m2" maxlength="8" autocomplete="off">
					</div>
				</div>
			';
		}
		else{
			// echo'default';
   		}

	}
	
	#GUARDAR ARTICULO
	#-----------------------------------------------------------
	public function guardarArticuloController(){

		if(isset($_POST["guardaranuncio"])){

			function getRandomCode(){
		    #$an = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ-)(.:,;";
		    $an = "123456789ABCDEFGHIJKLMNPQRSTUVWXYZ";
		    $su = strlen($an) - 1;
		    return substr($an, rand(0, $su), 1) .
		            substr($an, rand(0, $su), 1) .
		            substr($an, rand(0, $su), 1) .
		            substr($an, rand(0, $su), 1) .
		            substr($an, rand(0, $su), 1) .
		            substr($an, rand(0, $su), 1);
			}
				$cod_Revista = getRandomCode();
				#echo "<br />". getRandomCode() . "<br />";

				#for ($i = 0; $i < 100; $i++)
				#    echo getRandomCode() . "<br />";

			$Pais = 1;
			$clasificado_activo= 1;
			$clasificaedo_inactivo= 0;

			$idcaracteristica=5;

			$datosController3 = array("idpais"=>$Pais,
									  "iddepartamento"=>$_POST["ubicacioncrearanunciodep"],
									  "idprovincia"=>$_POST["ubicacioncrearanuncioprov"],
									  "iddistrito"=>$_POST["ubicacioncrearanunciodis"]
					                 );

			$respuestaDetalleUbicaciones = GestorAnunciosModel::guardarUbicacionesClasificadosModel($datosController3, "Tdetalles_ubicaciones_clasificados");

			#echo $respuestaDetalleUbicaciones;

 				$value = filter_input(INPUT_POST, 'categoriacrearanuncio');
                $exploded_value = explode('|', $value);
                $value_one = $exploded_value[0];
                $value_two = $exploded_value[1];

			if (!empty($_POST["modelo"])) {

				$Nombre_Modelo = $_POST["modelo"];
	            #echo $Nombre_Modelo;
				$respuestaIdmodelo = GestorCategoriasModel::verificarIdModeloModel($Nombre_Modelo, "Tmodelos");

				#echo $Idmodelo = $respuestaIdmodelo["idmodelo"];

			}
			else{
				#echo "el modelo es";
			}
          
			//Verificando la condicion 
			if ($_POST["condicion"] == 'Enable'){

				$condicion = 'Nuevo';

			}
			elseif ($_POST["condicion"] == 'Disable') {

				$condicion = 'Usado';
			}
			else{

				#$condicion = 'Ninguno';
			}
/*
		if (!empty($_POST["marcacrearanuncio"]&&$_POST["modelo"])) {

				echo $algo = "trae";


		}
		else {

				echo $naa = "nica";
		}
*/

			$datosController2 = array(#"idcategoria"=>$_POST["categoriacrearanuncio"],
								  "idcategoria"=>$value_one,
								  "idsubcategoria"=>$_POST["subcategoriacrearanuncio"],
								  "idmarca"=>$_POST["marcacrearanuncio"],
								  "idmodelo"=>$Idmodelo,

								  "fabricacion_vehiculo"=>$_POST["fabricacioncrearanuncio"],
								  "tipo_modelo_vehiculo"=>$_POST["tipomodelocrearanuncio"],
								  "tipo_combustible"=>$_POST["tipocombustiblecrearanuncio"],
								  "tipo_transmision"=>$_POST["tipotransmisioncrearanuncio"],
								  "condicion_vehiculo"=>$condicion,
								  "kilometraje_vehiculo"=>$_POST["kilometraje"],

								  "tipo_operacion_inmueble"=>$_POST["tipoinmueblecrearanuncio"],
								  "tipo_categoria_inmueble"=>$_POST["tiposeccioncrearanuncio"],
								  "nro_habitaciones"=>$_POST["numerohabitacionescrearanuncio"],
								  "nro_servicios_higienicos"=>$_POST["numerocuartosbañoscrearanuncio"],
								  "metros_cuandrados_inmuebles"=>$_POST["metros"]

					             );


			$respuestaCaracteristicas = GestorAnunciosModel::guardarCaracteristicasClasificadosModel($datosController2, "Tdetalles_caracteristicas_clasificados");
			
			#echo $respuestaCaracteristicas;

			if (!empty($respuestaDetalleUbicaciones&&$respuestaCaracteristicas)){

				session_start();
				$_SESSION["user-usuario"] = true;
				$_SESSION["usuario"];
				$idUsuario = $_SESSION["idusuario"];

				$datosController = array("titulo"=>$_POST["titulocrearanuncio"],
					                     "descripcion"=>$_POST["descripcioncrearanuncio"]."...",
				 	                     #"imagen"=>$ruta,
				 	                     "tipo_moneda"=>$_POST["tipomonedacrearanuncio"],
				 	                     "precio"=>$_POST["preciocrearanuncio"],
				 	                     "celular"=>$_POST["celularcrearanuncio"],
				 	                     #"idgaleria_imagen_clasificado"=>$numbers,
				 	                     "descripcion_revista"=>$_POST["descripcionrevistacrearanuncio"],
				 	                     "precio_tipo"=>$_POST["preciotipocrearanuncio"],
				 	                     "cod_revista"=>$cod_Revista,
				 	                     "estado"=>$clasificaedo_inactivo,
				 	                     "iddetalle_caracteristica_clasificado"=>$respuestaCaracteristicas,
				 	                     "iddetalle_ubicacion_clasificado"=>$respuestaDetalleUbicaciones,
				 	                  	 #"idpais"=>$_POST["ubicacioncrearanunciodce"]
				 	                  	 "idusuario"=>$idUsuario
					                 	);

				$respuestaClasificado = GestorAnunciosModel::guardarClasificadosModel($datosController, "Tclasificados");

				#echo $respuestaClasificado;
			}

			$countfiles = count($_FILES['nombreimagen']['name']);

			$ruta = "vista/imagenes/anuncios/";

				for($i=0;$i<$countfiles;$i++){

			$imagen = $_FILES['nombreimagen']['name'][$i];

/**/
			$extension  = pathinfo($imagen, PATHINFO_EXTENSION);
			$nuevo_nombre =$respuestaClasificado.' - '.'Anegociar - '.$value_two.' - ';
			#$new = rand(0000,9999);
			$new = mt_rand(100, 999);
    		$newfilename = $nuevo_nombre.$new.'.'.$extension;
/**/

			#echo $imagen;
			move_uploaded_file($_FILES['nombreimagen']['tmp_name'][$i],$ruta.$newfilename);

			$datosController1 = array("nombreimagen"=>$newfilename,
									  "idclasificado"=>$respuestaClasificado
				                 	 );

			$respuestaGaleria = GestorAnunciosModel::guardarGaleriaImagenClasificadosModel($datosController1, "Tgaleria_imagenes_clasificados");

			if($respuestaGaleria == "ok"){
				
				session_start();
           		#$_SESSION["val1"] = 'vehiculos';
           		$_SESSION["val1"] =	$value_two;
           		$_SESSION["val2"] = $respuestaClasificado;
           		
           		#echo "&lt;br&gt;<br />imagen Guardado correctamente";
				#header("location:clasificado_exitoso");
				header("location:elije_plan_anuncio");

				}
			}
		}
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
		<li><img src="'.$ruta.$item["nombreimagen"].'" alt="San Francisco, USA" data-description="Golden Gate Bridge"></li>
		*/
		echo' 
	        <li><img src="'.$ruta.$item["nombreimagen"].'" alt="'.$item["titulo"].'" data-description="'.$item["nombreimagen"].'"></li>
		';

	}
	echo '
				</ul>
			</div>
		</div>
	';
	#var_dump($respuesta);
	$vacio = Null;

	// '.($respuesta["kilometraje_vehiculo"] = $vacio ? $respuesta["kilometraje_vehiculo"] : "not more than").'

	echo' 
			<div id="bloque-contenido-detalles-clasificado">
	 			<div class="detalles-contenido-campos">
	 				<input type="hidden" value="'.$respuesta["idclasificado"].'" name="idEditar">
					<div class="campo-titulo">
						<h1>'.$respuesta["titulo"].'</h1>
					</div>
					<div class="campo-codigo-revista">
							<i></i>&nbsp; Cod. Revista: <b>'.$respuesta["cod_revista"].'</b>
					</div>
					<div class="precio">
						<div class="campo-tipo-moneda">
							<h2>'.$respuesta["tipo_moneda"].'</h2>
						</div>
						<div class="campo-precio">
							<h2>'.$respuesta["precio"].'</h2>
						</div>
					</div>

					<div class="ubicacion">
						<div class="imagen-ubicacion">
							<img src="vista/temas/img/ubicacion.png">
						</div>
						<div class="campo-nombre-departamento">
							<span>'.$respuesta["nombredepartamento"].', </span>
						</div>
						<div class="campo-nombre-provincia">
							<span>'.$respuesta["nombreprovincia"].', </span>
						</div>
						<div class="campo-nombre-distrito">
							<span>'.$respuesta["nombredistrito"].'</span>
						</div>
					</div>
					
					<div class="informacion-extra">
						<h3>Informacion</h3>
			';
			if (!empty($respuesta["kilometraje_vehiculo"])){
				echo '
						<div class="campo-kilometraje">
							<h4>KIlometraje: </h4>
							<span>'.$respuesta["kilometraje_vehiculo"].' Km.</span>
						</div>
				';
			}
			if (!empty($respuesta["tipo_modelo_vehiculo"])){
				echo '
						<div class="campo-tipo-modelo">
							<h4>Tipo: </h4>
							<span>'.$respuesta["tipo_modelo_vehiculo"].'</span>
						</div>
				';
			}
			if (!empty($respuesta["tipo_transmision"])){
				echo '
						<div class="campo-tipo-transmision">
							<h4>Transmision: </h4>
							<span>'.$respuesta["tipo_transmision"].'</span>
						</div>
				';
			}

			if (!empty($respuesta["tipo_operacion_inmueble"])){
				echo '
						<div class="campo-kilometraje">
							<h4>Tipo / Sección: </h4>
							<span>'.$respuesta["tipo_operacion_inmueble"].'</span>
						</div>
				';
			}
			if (!empty($respuesta["metros_cuandrados_inmuebles"])){
				echo '
						<div class="campo-tipo-modelo">
							<h4>Area (metros cuadrados): </h4>
							<span>'.$respuesta["metros_cuandrados_inmuebles"].' m2.</span>
						</div>
				';
			}
			if (!empty($respuesta["nro_habitaciones"])){
				echo '
						<div class="campo-tipo-transmision">
							<h4>Nro de Cuartos: </h4>
							<span>'.$respuesta["nro_habitaciones"].'</span>
						</div>
				';
			}
			if (!empty($respuesta["nro_servicios_higienicos"])){
				echo '
						<div class="campo-tipo-transmision">
							<h4>Nro de Cuartos de Baño: </h4>
							<span>'.$respuesta["nro_servicios_higienicos"].'</span>
						</div>
				';
			}
			
			echo '
					</div>
					<div class="contacto">
						<h3>Numero de contacto</h3>
						<div class="imagen-ubicacion">
							<img src="vista/temas/img/celular.png">
						</div>
						<div class="campo-celular">
							<span>'.$respuesta["celular"].'</span>
						</div>
					</div>
				</div>
			</div>
			<div id="bloque-contenido-descripcion-clasificado">
	 			<div class="descripcion-contenido-campos">
	 				<h3>Descripcion: </h3>
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

	#BUSCAR CLASIFICADOS
	#-----------------------------------------------------------
	public function buscarClasificadoController(){

		if(isset($_POST["buscaranuncio"])){

			if(!empty($_POST["cat"])){

				$captura_Categoria = $_POST["cat"];

				echo $captura_Categoria.'</br>';
			}
			else{

				$captura_Categoria = '';
				echo $captura_Categoria;

			}

			$buscar_Palabra = $_POST["buscarpalabraanuncio"];

			echo $buscar_Palabra.'</br>';

			/*
			$datosController = array("cat"=>$_POST["cat"],
									 "palabra"=>$_POST["buscarpalabraanuncio"]
					                 );
			*/

			$respuestaBuscador = GestorAnunciosModel::buscarClasificadosModel($captura_Categoria, $buscar_Palabra, "Tclasificados");


		#$numberpaginas=10;
		$ruta = "vista/imagenes/anuncios/";

		if (!empty($respuestaBuscador)){

			foreach($respuestaBuscador as $row => $item){

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
			#echo $row;

	 		$numero_de_paginas = ceil($total_clasificados/$cantidad_elementos);
	 		#echo '<h1>'.$number_of_pages.'</h1>';
	 		
	 		echo '
	 			<div class="paginador">
	 		';
	 		
	 		for ($i=1;$i<=$numero_de_paginas;$i++) {
		  		echo '
		  			<div class="pagina">
		  				<a href="index.php?action=categorias_clasificados&cat='.$captura_Categoria.'&page=' . $i . '">' . $i . '</a>
					</div>
		  			';
		  		}
		  	
		  		echo '
	 					</div>
	 				';
 		
			}
			else {
				echo "Lo que buscas no existe prueba usando otras palabras";
			}
		}
		}		

}