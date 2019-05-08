<?php

class GestorAnunciosController
{
    #GUARDAR ARTICULO
    #-----------------------------------------------------------
    public function validarPlanPorCategoriaParaClasificadoController()
    {

        #$captura_Plan = $_POST["titulocrearanuncio"];

        #echo $captura_Plan;


        if (isset($_POST['plan_crear_anuncio'])) {

            if (empty($_POST['plan_crear_anuncio'])) {
                echo "El campo titulo esta vacio";
            } else {
                #echo $_POST['plan_crear_anuncio'];
                $value = filter_input(INPUT_POST, 'plan_crear_anuncio');
                $exploded_value = explode('|', $value);
                $value_one = $exploded_value[0];
                $value_two = $exploded_value[1];
                echo $value_two;
            }
        }
    }

    #SELECTLIST DE CREAR ANUNCIOS LISTAS SUBCATEGORIAS
    #------------------------------------
    public function CrearAnunciosMostrarSubCategoriasController()
    {

        $capturar_cat_plan_post = filter_input(INPUT_POST, 'cat-plan');
        $separar_valor_cat_plan_post = explode('|', $capturar_cat_plan_post);
        $valor_uno_cat = $separar_valor_cat_plan_post[0];
        $valor_dos_plan = $separar_valor_cat_plan_post[1];

        #$captura_Categoria = $_POST["cat"];
        $captura_Categoria = $valor_uno_cat;

        $respuesta = GestorCategoriasModel::CrearAnunciosMostrarSubCategoriasModel($captura_Categoria, "Tcategorias");

        foreach ($respuesta as $row => $item) {
            echo '<option value=' . $item['idsubcategoria'] . '>' . $item['nombre_subcategoria'] . '</option>';

        }
    }

    #CAMBIAR CAMPOSD DE ACUERDO A LA CATEGORIA
    #------------------------------------
    public function camposDinamicosPorCategoriaController()
    {

        $value = filter_input(INPUT_POST, 'categoriacrearanuncio');
        $exploded_value = explode('|', $value);
        $value_one = $exploded_value[0];
        $value_two = $exploded_value[1];

        #echo "funciona pss";

        if ($_POST["categoriacrearanuncio"] == 'vehiculos') {
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
						<input type="radio" name="condicion" value="Disable" id="disable"> 
						<label for="new">Usado</label>
					</div>
					<div class="condicion-nuevo">
						<input type="radio" name="condicion" value="Enable" id="enable" checked> 
					<label for="used">Nuevo</label>
					</div>		
					<div class="condicion-kilometraje">
						<input type="number" name="kilometraje" id="kilometraje" class="kilometraje" placeholder="Kilometraje" autocomplete="off" maxlength="10">
					</div>
				</div>
			';
        } elseif ($_POST["categoriacrearanuncio"] == 'inmuebles') {
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
        } else {
            // echo'default';
        }

    }

    #GUARDAR ARTICULO
    #-----------------------------------------------------------
    public function guardarClasiController()
    {

        if (isset($_POST['plan_crear_anuncio']) && ($_POST['cat_crear_anuncio'])) {
            $capturar_plan_post = filter_input(INPUT_POST, 'plan_crear_anuncio');
            $separar_valor_plan_post = explode('|', $capturar_plan_post);
            $valor_uno = $separar_valor_plan_post[0];
            $valor_dos = $separar_valor_plan_post[1];

            echo 'waaaaa' . $valor_uno;

            $saldo = 0;
            $precio_clasificado_premium = 50;
            $clasificado_activo = 1;
            $clasificaedo_inactivo = 0;

            $plan_Gratis = "GRATIS";

            if ($valor_dos == 'GRATIS') {
                echo "Tu anuncio es gratis";

            } elseif ($valor_dos != 'GRATIS') {

                $idusuario = 1;

                $consulta_Saldo_usuario = GestorUsuariosModel::saldoUsuarioModel($idusuario, "Tusuarios");

                echo $consulta_Saldo_usuario["saldo_usuario"];

                $consulta_Plan_Categoria = GestorPlanesModel::mostrarPrecioPlanModel($valor_dos, $captura_Nombre_Categoria, "Tplanes");

                echo 'saleeee' . $consulta_Plan_Categoria["nombre_plan"] . '</br>';
                echo "Tu anuncio no se vera";

                if ($consulta_Saldo_usuario > 0) {
                    echo "si tienes saldo";
                } elseif ($consulta_Saldo_usuario < $precio_clasificado_premium) {
                    echo "debes recargar saldo";
                } else
                    echo "no teines saldo";

            } else
                echo "No es nada";
        } else

            echo "Esta vacio el post";
        #header("location:anuncios_web");
    }

    #MOSTRAR SOLO UN ANUNCIO
    public function mostrarClasificadosController()
    {

        $datosController = $_GET["id"];
        $respuesta = GestorAnunciosModel::mostrarClasificadosModel($datosController, "Tclasificados");

        $respuesta2 = GestorAnunciosModel::MostarGaleriaImagenClasificadosModel($datosController, "Tclasificados");

        $ruta = "vista/imagenes/anuncios/";

        echo '<div class="slider">
			<input type="radio" name="slide_switch" id="id1" checked="checked"/>
			<label class="prueba" for="id1">
			</label>
				<img src="' . $ruta . $respuesta["nombreimagen"] . '">
	';

        foreach ($respuesta2 as $row => $item) {
            echo ' 
				<input type="radio" name="slide_switch" id="id' . $item["idgaleria_imagen_clasificado"] . '"/>
				<label for="id' . $item["idgaleria_imagen_clasificado"] . '">
				<img src="' . $ruta . $item["nombreimagen"] . '" class="img-thumbnail" width="100">
				</label>
				<img src="' . $ruta . $item["nombreimagen"] . '" class="img-thumbnail"class="miniatura-imagen"/>
			';
        }
        #var_dump($respuesta);
        echo ' 
		</div>
			<div class="contenido-vehiculos">
	 			<div class="contenido-campos">
	 				<input type="hidden" value="' . $respuesta["idclasificado"] . '" name="idEditar">
					<div class="campo-titulo">
						<h1>' . $respuesta["titulo"] . '</h1>
					</div>
					<div class="campo-tipo-moneda">
						<h2>' . $respuesta["tipo_moneda"] . '</h2>
					</div>
					<div class="campo-precio">
						<h2>' . $respuesta["precio"] . " .00" . '</h2>
					</div>
					<div class="campo-descripcion">
						<p>' . $respuesta["descripcion"] . '</p>
					</div>
					<div class="campo-fecha-creacion">
					<label for="celularcrearanuncio">Numero de contacto</label>
					<p><img src="vista/temas/imagenes/celular.png">
						' . $respuesta["celular"] . '</p>
					</div>

				</div>
			</div>
		';
    }

    #BORRAR ARTICULO
    #------------------------------------
    public function borrarArticuloController()
    {

        if (isset($_GET["idBorrar"])) {

            unlink($_GET["rutaImagen"]);

            $datosController = $_GET["idBorrar"];

            $respuesta = GestorArticulosModel::borrarArticuloModel($datosController, "articulos");

            if ($respuesta == "ok") {

                echo '<script>

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
    public function editarArticuloController()
    {

        $ruta = "";

        if (isset($_POST["editarTitulo"])) {

            if (isset($_FILES["editarImagen"]["tmp_name"])) {

                $imagen = $_FILES["editarImagen"]["tmp_name"];

                $aleatorio = mt_rand(100, 999);

                $ruta = "vista/imagenes/articulos/articulo" . $aleatorio . ".jpg";

                $origen = imagecreatefromjpeg($imagen);

                $destino = imagecrop($origen, ["x" => 0, "y" => 0, "width" => 800, "height" => 400]);

                imagejpeg($destino, $ruta);

                $borrar = glob("vista/imagenes/articulos/temp/*");

                foreach ($borrar as $file) {

                    unlink($file);

                }

            }

            if ($ruta == "") {

                $ruta = $_POST["fotoAntigua"];

            } else {

                unlink($_POST["fotoAntigua"]);

            }

            $datosController = array("id" => $_POST["id"],
                "titulo" => $_POST["editarTitulo"],
                "introduccion" => $_POST["editarIntroduccion"],
                "ruta" => $ruta,
                "contenido" => $_POST["editarContenido"]);

            $respuesta = GestorArticulosModel::editarArticuloModel($datosController, "articulos");

            if ($respuesta == "ok") {

                echo '<script>

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
            } else {
                echo $respuesta;
            }
        }
    }
    #ACTUALIZAR ORDEN
    #---------------------------------------------------
    public function actualizarOrdenController($datos)
    {

        GestorArticulosModel::actualizarOrdenModel($datos, "articulos");

        $respuesta = GestorArticulosModel::seleccionarOrdenModel("articulos");

        foreach ($respuesta as $row => $item) {

            echo ' <li id="' . $item["id"] . '" class="bloqueArticulo">
					<span class="handleArticle">
					<a href="index.php?action=articulos&idBorrar=' . $item["id"] . '&rutaImagen=' . $item["ruta"] . '">
						<i class="fa fa-times btn btn-danger"></i>
					</a>
					<i class="fa fa-pencil btn btn-primary editarArticulo"></i>	
					</span>
					<img src="' . $item["ruta"] . '" class="img-thumbnail">
					<h1>' . $item["titulo"] . '</h1>
					<p>' . $item["introduccion"] . '</p>
					<input type="hidden" value="' . $item["contenido"] . '">
					<a href="#articulo' . $item["id"] . '" data-toggle="modal">
					<button class="btn btn-default">Leer Más</button>
					</a>

					<hr>

				</li>

				<div id="articulo' . $item["id"] . '" class="modal fade">

					<div class="modal-dialog modal-content">

						<div class="modal-header" style="border:1px solid #eee">
				        
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						 <h3 class="modal-title">' . $item["titulo"] . '</h3>
			        
						</div>

						<div class="modal-body" style="border:1px solid #eee">
			        
							<img src="' . $item["ruta"] . '" width="100%" style="margin-bottom:20px">
							<p class="parrafoContenido">' . $item["contenido"] . '</p>
			        
						</div>

						<div class="modal-footer" style="border:1px solid #eee">
			        
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        
						</div>

					</div>

				</div>';
        }
    }

    public function mostrarListaClasificadosUsuariosController()
    {
        $respuesta = GestorAnunciosModel::mostrarListaClasificadosUsuariosModel("clasificados");

        foreach ($respuesta as $row => $item) {

            echo '
					<div class="vista-vehiculos">
			 			<div class="vista-campos">
							<div class="vista-campo-imagen">
								<a href="index.php?action=verclasificado&id=' . $item["idclasificados"] . '">
								<img src="' . $item["imagen"] . '" class="img-thumbnail">
								</a>
							</div>
							<div class="vista-campo-titulo">
								<a href="index.php?action=verclasificado&id=' . $item["idclasificados"] . '">
								<h1>' . $item["titulo"] . '</h1>
								</a>
							</div>
							<div class="vista-campo-tipo-moneda">
								<a href="index.php?action=verclasificado&id=' . $item["idclasificados"] . '">
								<p>' . $item["tipo_moneda"] . '</p>
								</a>
							</div>
							<div class="vista-campo-precio">
								<a href="index.php?action=verclasificado&id=' . $item["idclasificados"] . '">
								<p>' . $item["precio"] . '</p>
								</a>
							</div>
							<div class="vista-campo-descripcion">
								<a href="index.php?action=verclasificado&id=' . $item["idclasificados"] . '">
								<p>' . $item["descripcion"] . '</p>
								</a>
							</div>
							<div class="vista-campo-fecha-creacion">
								<a href="index.php?action=verclasificado&id=' . $item["idclasificados"] . '">
								<p>' . $item["fechacreacion"] . '</p>
								</a>
							</div>
						</div>
					</div>
				';

        }

    }

    #elvis  -- - - - -
    #Guardar el clasificado
    public function guardarClasificadoController()
    {
        session_start();
        $_SESSION["user_colaborador"] = true;
        $_SESSION["usuariocol"];
        $idusuario = $_SESSION["idusuarioCol"];
        $clasificado_Gratis_Activo = 1;

        function getRandomCode()
        {
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
        $Pais = 1;
        //------------------------
        if (isset($_POST["guardaranuncio"])) {

            if ($this->verificarPlan() == "GRATIS") {
                //obtener el ID del plan web que se selecciono
                $datos_planes_web = GestorPlanesModel::mostrarPlanWebModel($_SESSION['plan-crear-web-anuncio'],
                    $_SESSION['categorias-crear-anuncio'], "Tplanes_web");
                $idplan_web = $datos_planes_web['idplan_web'];

                //obtener el Id del plan revista que se selecciono
                $datos_planes_revista = GestorPlanesModel::mostrarPlanRevistaModel($_SESSION['plan-crear-revista-anuncio'],
                    $_SESSION['categorias-crear-anuncio'], "Tplanes_revista");
                $idplan_revista = $datos_planes_revista['idplan_revista'];

                if (!empty($_POST["categoriacrearanuncio"])) {
                    $Nombre_Categoria = $_POST["categoriacrearanuncio"];
                    #echo $Nombre_Modelo;
                    $respuestaIdcategoria = GestorCategoriasModel::verificarIdCategoriaModel($Nombre_Categoria, "Tcategorias");
                    $Idcategoria = $respuestaIdcategoria["idcategoria"];
                }
                //Verificando la condicion
                if ($_POST["condicion"] == 'Enable') {
                    $condicion = 'Nuevo';
                } elseif ($_POST["condicion"] == 'Disable') {
                    $condicion = 'Usado';
                } else {
                }
                #$condicion = 'Ninguno';
                $det_ubicacion = array(
                    "idpais" => $Pais,
                    "iddepartamento" => $_POST["ubicacioncrearanunciodep"],
                    "idprovincia" => $_POST["ubicacioncrearanuncioprov"],
                    "iddistrito" => $_POST["ubicacioncrearanunciodis"]
                );
                $det_caracteristicas = array(
                    "idcategoria" => $Idcategoria,
                    "idsubcategoria" => $_POST["subcategoriacrearanuncio"],
                    "idmarca" => $_POST["marcacrearanuncio"],
                    "idmodelo" => $_POST["modelocrearanuncio"],

                    "fabricacion_vehiculo" => $_POST["fabricacioncrearanuncio"],
                    "tipo_modelo_vehiculo" => $_POST["tipomodelocrearanuncio"],
                    "tipo_combustible" => $_POST["tipocombustiblecrearanuncio"],
                    "tipo_transmision" => $_POST["tipotransmisioncrearanuncio"],
                    "condicion_vehiculo" => $condicion,
                    "kilometraje_vehiculo" => $_POST["kilometraje"],

                    "tipo_operacion_inmueble" => $_POST["tipoinmueblecrearanuncio"],
                    "tipo_categoria_inmueble" => $_POST["tiposeccioncrearanuncio"],
                    "nro_habitaciones" => $_POST["numerohabitacionescrearanuncio"],
                    "nro_servicios_higienicos" => $_POST["numerocuartosbañoscrearanuncio"],
                    "metros_cuandrados_inmuebles" => $_POST["metros"]
                );

                $clasificado = array(
                    "titulo" => $_POST["titulocrearanuncio"],
                    "descripcion" => $_POST["descripcioncrearanuncio"] . "...",
                    "tipo_moneda" => $_POST["tipomonedacrearanuncio"],
                    "precio" => $_POST["preciocrearanuncio"],
                    "celular" => $_POST["celularcrearanuncio"],
                    "descripcion_revista" => $_POST["descripcionrevistacrearanuncio"],
                    "precio_tipo" => $_POST["preciotipocrearanuncio"],
                    "cod_revista" => $cod_Revista,
                    "mostrar_en_revista" => $_POST["mostrar_revista"],
                    "estado" => $clasificado_Gratis_Activo,
                    "idusuario" => $idusuario
                );
                $det_planes = array(
                    "idplan_web" => $idplan_web,
                    "idplan_revista" => $idplan_revista
                );

                $idclasificado = GestorAnunciosModel::guardarClasificadosModel($det_ubicacion, $det_caracteristicas, $det_planes, $clasificado);
                //imagenes
                $countfiles = count($_FILES['nombreimagen']['name']);
                $ruta = "../vista/imagenes/anuncios/";
                for ($i = 0; $i < $countfiles; $i++) {
                    $imagen = $_FILES['nombreimagen']['name'][$i];
                    $extension = pathinfo($imagen, PATHINFO_EXTENSION);
                    $nuevo_nombre = $idclasificado . ' - ' . 'Anegociar - ' . $_SESSION['cat'] . ' - ';
                    $new = mt_rand(100, 999);
                    $newfilename = $nuevo_nombre . $new . '.' . $extension;
                    move_uploaded_file($_FILES['nombreimagen']['tmp_name'][$i], $ruta . $newfilename);
                    $imagenes = array(
                        "nombreimagen" => $newfilename,
                        "idclasificado" => $idclasificado
                    );

                    $respuesta = GestorAnunciosModel::guardarGaleriaImagenClasificadosModel($imagenes, "Tgaleria_imagenes_clasificados");
                    if ($respuesta == "OK") {
                        header("location:ultimas_publicaciones");
                    } else {
                        echo $respuesta;
                    }
                }
            } elseif ($this->verificarPlan() == "OK") {
                //obtener el ID del plan web que se selecciono
                $datos_planes_web = GestorPlanesModel::mostrarPlanWebModel($_SESSION['plan-crear-web-anuncio'], $_SESSION['categorias-crear-anuncio'], "Tplanes_web");
                $idplan_web = $datos_planes_web['idplan_web'];

                //obtener el Id del plan revista que se selecciono
                $datos_planes_revista = GestorPlanesModel::mostrarPlanRevistaModel($_SESSION['plan-crear-revista-anuncio'], $_SESSION['categorias-crear-anuncio'], "Tplanes_revista");
                $idplan_revista = $datos_planes_revista['idplan_revista'];

                if (!empty($_POST["categoriacrearanuncio"])) {
                    $Nombre_Categoria = $_POST["categoriacrearanuncio"];
                    $respuestaIdcategoria = GestorCategoriasModel::verificarIdCategoriaModel($Nombre_Categoria, "Tcategorias");
                    $Idcategoria = $respuestaIdcategoria["idcategoria"];
                }
                if (!empty($_POST["modelo"])) {
                    $Nombre_Modelo = $_POST["modelo"];
                    $respuestaIdmodelo = GestorCategoriasModel::verificarIdModeloModel($Nombre_Modelo, "Tmodelos");
                    $Idmodelo = $respuestaIdmodelo["idmodelo"];
                } else {
                    #echo "el modelo es";
                }
                //Verificando la condicion
                if ($_POST["condicion"] == 'Enable') {
                    $condicion = 'Nuevo';
                } elseif ($_POST["condicion"] == 'Disable') {
                    $condicion = 'Usado';
                } else {
                }
                //Verificando si el anuncio saldra en la revista
                if ($_POST["yesno"] == 'Si') {
                    $mostrar_en_revista = 'Si';
                } elseif ($_POST["yesno"] == 'No') {
                    $mostrar_en_revista = 'No';
                } else {
                    $mostrar_en_revista = 'No';
                }

                $det_ubicacion = array(
                    "idpais" => $Pais,
                    "iddepartamento" => $_POST["ubicacioncrearanunciodep"],
                    "idprovincia" => $_POST["ubicacioncrearanuncioprov"],
                    "iddistrito" => $_POST["ubicacioncrearanunciodis"]
                );

                $det_caracteristicas = array(
                    "idcategoria" => $Idcategoria,
                    "idsubcategoria" => $_POST["subcategoriacrearanuncio"],
                    "idmarca" => $_POST["marcacrearanuncio"],
                    "idmodelo" => $Idmodelo,

                    "fabricacion_vehiculo" => $_POST["fabricacioncrearanuncio"],
                    "tipo_modelo_vehiculo" => $_POST["tipomodelocrearanuncio"],
                    "tipo_combustible" => $_POST["tipocombustiblecrearanuncio"],
                    "tipo_transmision" => $_POST["tipotransmisioncrearanuncio"],
                    "condicion_vehiculo" => $condicion,
                    "kilometraje_vehiculo" => $_POST["kilometraje"],

                    "tipo_operacion_inmueble" => $_POST["tipoinmueblecrearanuncio"],
                    "tipo_categoria_inmueble" => $_POST["tiposeccioncrearanuncio"],
                    "nro_habitaciones" => $_POST["numerohabitacionescrearanuncio"],
                    "nro_servicios_higienicos" => $_POST["numerocuartosbañoscrearanuncio"],
                    "metros_cuandrados_inmuebles" => $_POST["metros"]
                );

                $clasificado = array(
                    "titulo" => $_POST["titulocrearanuncio"],
                    "descripcion" => $_POST["descripcioncrearanuncio"] . "...",
                    "tipo_moneda" => $_POST["tipomonedacrearanuncio"],
                    "precio" => $_POST["preciocrearanuncio"],
                    "celular" => $_POST["celularcrearanuncio"],
                    "descripcion_revista" => $_POST["descripcionrevistacrearanuncio"],
                    "precio_tipo" => $_POST["preciotipocrearanuncio"],
                    "cod_revista" => $cod_Revista,
                    "mostrar_en_revista" => $mostrar_en_revista,
                    "estado" => $clasificado_Gratis_Activo,
                    "idusuario" => $idusuario
                );


                $det_planes = array(
                    "idplan_web" => $idplan_web,
                    "idplan_revista" => $idplan_revista
                );

                $idclasificado = GestorAnunciosModel::guardarClasificadosModel($det_ubicacion, $det_caracteristicas, $det_planes, $clasificado);
                $countfiles = count($_FILES['nombreimagen']['name']);
                $ruta = "../vista/imagenes/anuncios/";
                for ($i = 0; $i < $countfiles; $i++) {
                    $imagen = $_FILES['nombreimagen']['name'][$i];
                    $extension = pathinfo($imagen, PATHINFO_EXTENSION);
                    $nuevo_nombre = $idclasificado . ' - ' . 'Anegociar - ' . $_SESSION['cat'] . ' - ';
                    $new = mt_rand(100, 999);
                    $newfilename = $nuevo_nombre . $new . '.' . $extension;
                    move_uploaded_file($_FILES['nombreimagen']['tmp_name'][$i], $ruta . $newfilename);
                    $imagenes = array(
                        "nombreimagen" => $newfilename,
                        "idclasificado" => $idclasificado
                    );
                    $respuesta = GestorAnunciosModel::guardarGaleriaImagenClasificadosModel($imagenes, "Tgaleria_imagenes_clasificados");
                    if ($respuesta == "OK") {
                       header("location:ultimas_publicaciones");
                    } else {
                        echo $respuesta;
                    }
                }
            } elseif ($this->verificarPlan() == "NO") {
                echo 'No tiene saldo';
            }
        }
    }

    #VERIFICAR SI TIENE SALDO
    private function verificarPlan()
    {
        $plan_web = $_SESSION['plan-crear-web-anuncio'];
        $plan_revista = $_SESSION['plan-crear-revista-anuncio'];
        $idusuario = $_SESSION["idusuarioCol"];
        $arrayPlanes = array('GRATIS', 'SIMPLE', 'DESTACADO', 'PREMIUM', '');
        if ((in_array($plan_web, $arrayPlanes)) && (in_array($plan_revista, $arrayPlanes))) {
            //consultamos el saldo del usuario
            $consulta_Saldo_usuario = GestorAnunciosModel::saldoUsuarioModel($idusuario, "Tusuarios");
            $Saldo_Disponible = $consulta_Saldo_usuario["saldo_usuario"];

            if (($plan_web == $arrayPlanes[0]) && ($plan_revista == $arrayPlanes[0])) {
                return "GRATIS";
            } elseif (($plan_web != $arrayPlanes[0]) && ($plan_revista == $arrayPlanes[0])) {
                //consultamos el precio del plan web si es diferente de gratis
                $consulta_Plan_Categoria_web = GestorPlanesModel::mostrarPlanWebModel($_SESSION['plan-crear-web-anuncio'], $_SESSION['categorias-crear-anuncio'], "Tplanes_web");
                $precio_web = $consulta_Plan_Categoria_web["precio_plan_web"];
                if ($Saldo_Disponible < $precio_web) {
                    return "NO";
                } else {
                    return "OK";
                }
            } elseif (($plan_web == $arrayPlanes[0]) && ($plan_revista != $arrayPlanes[0])) {
                //consultamos el precio del plan revista si es diferente de gratis
                $consulta_Plan_Categoria_revista = GestorPlanesModel::mostrarPlanRevistaModel($_SESSION['plan-crear-revista-anuncio'], $_SESSION['categorias-crear-anuncio'], "Tplanes_web");
                $precio_revista = $consulta_Plan_Categoria_revista["precio_plan_revista"];
                if ($Saldo_Disponible < $precio_revista) {
                    return "NO";
                } else {
                    return "OK";
                }
            } elseif (($plan_web != $arrayPlanes[0]) && ($plan_revista != $arrayPlanes[0])) {
                //consultamos el precio del plan revista si es diferente de gratis
                $consulta_Plan_Categoria_web = GestorPlanesModel::mostrarPlanWebModel($_SESSION['plan-crear-web-anuncio'], $_SESSION['categorias-crear-anuncio'], "Tplanes_web");
                $precio_web = $consulta_Plan_Categoria_web["precio_plan_web"];
                //consultamos el precio del plan web si es diferente de gratis
                $consulta_Plan_Categoria_revista = GestorPlanesModel::mostrarPlanRevistaModel($_SESSION['plan-crear-revista-anuncio'], $_SESSION['categorias-crear-anuncio'], "Tplanes_revista");
                $precio_revista = $consulta_Plan_Categoria_revista["precio_plan_revista"];
                $total_plan = $precio_web + $precio_revista;

                if ($total_plan > $Saldo_Disponible) {
                    return "NO";
                } else {
                    return "OK";
                }
            } elseif (($plan_web == $arrayPlanes[4])) {
                //consultamos el precio del plan revista si es diferente de gratis
                $consulta_Plan_Categoria_web = GestorPlanesModel::mostrarPlanWebModel($_SESSION['plan-crear-web-anuncio'],
                    $_SESSION['categorias-crear-anuncio'], "Tplanes_web");
                $precio_web = $consulta_Plan_Categoria_web["precio_plan_web"];
                if ($precio_web > $Saldo_Disponible) {
                    return "NO";
                } else {
                    return "OK";
                }
            } elseif (($plan_revista == $arrayPlanes[4])) {
                //consultamos el precio del plan revista si es diferente de gratis
                $consulta_Plan_Categoria_revista = GestorPlanesModel::mostrarPlanRevistaModel($_SESSION['plan-crear-revista-anuncio'],
                    $_SESSION['categorias-crear-anuncio'], "Tplanes_revista");
                $precio_revista = $consulta_Plan_Categoria_revista["precio_plan_revista"];
                if ($Saldo_Disponible < $precio_revista) {
                    return "NO";
                } else {
                    return "OK";
                }
            }
        }
    }

    //Listar los Departamentos
    public function mostrarDepartamentos()
    {
        $data = array();
        $rpta = GestorAnunciosModel::mostrarDepartamentos('Tdepartamentos');
        foreach ($rpta as $key => $value) {
            $data[] = array(
                "nombredepartamento" => $value["nombredepartamento"],
                "iddepartamento" => $value["iddepartamento"]
            );
        }
        return $data;
    }

    // listar provincias
    public function listarProvincias($iddepartamento)
    {
        $data = array();
        $rpta = GestorAnunciosModel::mostrarProvincias('Tprovincias', $iddepartamento);
        foreach ($rpta as $key => $value) {
            $data[] = array(
                "nombreprovincia" => $value["nombreprovincia"],
                "idprovincia" => $value["idprovincia"]
            );
        }
        return $data;
    }

    // listar distritos
    public function listarDistritos($idprovincia)
    {
        $data = array();
        $rpta = GestorAnunciosModel::mostrarDistritos('Tdistritos', $idprovincia);
        foreach ($rpta as $key => $value) {
            $data[] = array(
                "nombredistrito" => $value["nombredistrito"],
                "iddistrito" => $value["iddistrito"]
            );
        }
        return $data;
    }

    ##mostrar subcategorias
    public function mostrarSubCategoria($nombre_categoria)
    {
        $data = array();
        $rpta = GestorAnunciosModel::mostrarSubCategoria($nombre_categoria);
        foreach ($rpta as $key => $value) {
            $data[] = array(
                "idsubcategoria" => $value["idsubcategoria"],
                "nombre_subcategoria" => $value["nombre_subcategoria"],
                "idcategoria" => $value["idcategoria"],
            );
        }
        return $data;
    }

    ##mostrar marcas segun subcategoria
    public function mostrarMarcas($idsubcategoria)
    {
        $data = array();
        $rpta = GestorAnunciosModel::mostrarMarcas($idsubcategoria);
        foreach ($rpta as $key => $value) {
            $data[] = array(
                "idmarca" => $value["idmarca"],
                "nombre_marca" => $value["nombre_marca"],
                "idsubcategoria" => $value["idsubcategoria"]
            );
        }
        return $data;
    }

    ##mostrar modelos segun subcategoria
    public function mostrarModelos($idmarca)
    {
        $data = array();
        $rpta = GestorAnunciosModel::mostrarModelos($idmarca);
        foreach ($rpta as $key => $value) {
            $data[] = array(
                "idmodelo" => $value["idmodelo"],
                "nombre_modelo" => $value["nombre_modelo"],
                "idmarca" => $value["idmarca"]
            );
        }
        return $data;
    }

}

?>