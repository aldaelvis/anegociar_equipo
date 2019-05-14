<?php

class GestorUsuariosController
{

    #REGISTRO DE USUARIOS
    #------------------------------------
    public function registroUsuarioController()
    {

        if (isset($_POST["usuarioRegistro"])) {

            #preg_match = Realiza una comparación con una expresión regular

            /*			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuarioRegistro"]) &&
                           preg_match('/^[a-zA-Z0-9]+$/', $_POST["passwordRegistro"]) &&
                           preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailRegistro"])){
            */
            #crypt() devolverá el hash de un string utilizando el algoritmo estándar basado en DES de Unix o algoritmos alternativos que puedan estar disponibles en el sistema.

            $encriptar = crypt($_POST["passwordRegistro"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

            #hash('sha3-256' , 'String you want to hash');
            $Codigo_activacion = hash('sha3-256', $_POST["usuarioRegistro"] . $encriptar);

            $datosController = array(
                #"idusuario"=>$idusuario,
                "usuario" => $_POST["usuarioRegistro"],
                "password" => $encriptar,
                "email" => $_POST["emailRegistro"],
                "cod_activacion" => $Codigo_activacion
            );

            $respuesta = GestorUsuariosModel::registroUsuarioModel(/*$idusuario,*/
                $datosController, "Tusuarios");

            echo $respuesta;

            $idrol = 2;

            if (!empty($respuesta)) {


                $respuesta2 = GestorUsuariosModel::asignaRolUsuarioModel(/*$idusuario,*/
                    $respuesta, $idrol, "Tusuarios_roles");

                if ($respuesta2 == "success") {
                    #if (!empty($respuesta)){
                    #header("location:registro_exitoso");

                    //Este bloque es importante

                    // Import PHPMailer classes into the global namespace
                    // These must be at the top of your script, not inside a function
                    #use PHPMailer\PHPMailer\PHPMailer;
                    #use PHPMailer\PHPMailer\Exception;

                    //Load Composer's autoloader
                    #require 'vendor/autoload.php';

                    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                    #try {
                    //Server settings
                    #$mail->SMTPDebug = 2;                                 // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'privafl-400.privatednsorg.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'consultas@anegociar.com.pe';                 // SMTP username
                    $mail->Password = 'd,%9*BHKuJc&';                           // SMTP password
                    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 465;                                    // TCP port to connect to

                    //Recipients
                    $mail->setFrom('consultas@anegociar.com.pe', 'Anegociar');
                    #$mail->addAddress('robervar55@gmail.com', 'Joe User');     // Add a recipient
                    $mail->addAddress($_POST["emailRegistro"], 'Usuario');
                    #$mail->addAddress('ellen@example.com');               // Name is optional
                    #$mail->addReplyTo('info@example.com', 'Information');
                    #$mail->addCC('cc@example.com');
                    #$mail->addBCC('bcc@example.com');

                    //Attachments
                    #$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                    #$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                    #$SITE_URL = 'localhost/anegociar/';
                    $SITE_URL = 'http://anegociar.com.pe/';

                    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Anegociar Peru';
                    #$mail->Body = 'This is the HTML message body <b>in bold!</b>';
                    $mail->Body = ('<html><head>
			                <title>Email Verification</title>
			                </head>
			                <body>
			                <h1>Hola ' . $_POST["usuarioRegistro"] . '!</h1>
							<p><a href="' . $SITE_URL . 'index.php?action=activar&id=' . base64_encode($respuesta) . $Codigo_activacion . '">CLICK AQUI PARA ACTIVAR SU CUENTA</a>
			        		</body></html>;
			                ');
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                    /*
                                            $mail->send();
                                            echo 'Message has been sent';
                                        } catch (Exception $e) {
                                            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                                        }
                    */

                    //Avisar si fue enviado o no y dirigir al index
                    if ($mail->Send()) {
                        header('Location: registro_exitoso');
                    } else {
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    }
                }

// }
            }
        }

    }

    #REGISTRO DE USUARIOS
    #------------------------------------
    public function activarRegistroUsuarioController()
    {

        if (isset($_GET["id"])) {
            $id = intval(base64_decode($_GET["id"]));

            #$id = $_GET["id"];

            #echo $id;

            $respuesta = GestorUsuariosModel::activarRegistroUsuarioModel($id, "Tusuarios");

            if ($respuesta == "success") {

                #echo "<br/>se activo correctamente";
                header('Location: activacion_exitosa');

            } else {

                echo "<br/>no se activo correctamente<br />";
                #cho $respuesta;
            }
        } else {
            echo "<br/>Los datos no coninciden<br />";
        }


    }

    #INGRESO DE USUARIOS
    #------------------------------------
    public static function ingresoConcesionariaController()
    {
        session_start();
        if (isset($_POST["usuarioIngreso"])) {
            $encriptar = crypt($_POST["passwordIngreso"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
            $datosController = array("usuario" => $_POST["usuarioIngreso"],
                #"password"=>$_POST["passwordIngreso"]);
                "password" => $encriptar
            );

            $respuesta = GestorUsuariosModel::ingresoConcesionariaModel($datosController, "Tusuarios");
            if ($respuesta["usuario"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $_POST["passwordIngreso"]) {
                ini_set("session.cookie_domain", "http://anegociar.com.pe/Concesionarias/");
                $some_name = session_name("some_name2");
                $domain = 'http://anegociar.com.pe/Concesionarias/';
                session_set_cookie_params(0, "/", $domain);

                $_SESSION["user_concesionaria"] = true;
                $_SESSION["usuarioConce"] = $respuesta["usuario"];
                $_SESSION["idusuarioConce"] = $respuesta["idusuario"];
                $_SESSION["nombre_rolConce"] = $respuesta["nombre_rol"];
                header("location:principal");
            } else {
                header("location:fallo");
            }
        }
    }

    #VISTA DE USUARIOS
    #------------------------------------
    public function vistaUsuariosController()
    {

        $respuesta = Datos::vistaUsuariosModel("usuarios");
        #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos,
        #y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
        foreach ($respuesta as $row => $item) {
            echo '<tr>
				<td>' . $item["usuario"] . '</td>
				<td>' . $item["password"] . '</td>
				<td>' . $item["email"] . '</td>
				<td><a href="index.php?action=editar&id=' . $item["id"] . '"><button>Editar</button></a></td>
				<td><a href="index.php?action=usuarios&idBorrar=' . $item["id"] . '"><button>Borrar</button></a></td>
			</tr>';

        }

    }

    #EDITAR USUARIO
    #------------------------------------
    public function editarUsuarioController()
    {

        $datosController = $_GET["id"];
        $respuesta = Datos::editarUsuarioModel($datosController, "usuarios");

        echo '<input type="hidden" value="' . $respuesta["id"] . '" name="idEditar">

			 <input type="text" value="' . $respuesta["usuario"] . '" name="usuarioEditar" required>

			 <input type="text" value="' . $respuesta["password"] . '" name="passwordEditar" required>

			 <input type="email" value="' . $respuesta["email"] . '" name="emailEditar" required>

			 <input type="submit" value="Actualizar">';

    }

    #ACTUALIZAR USUARIO
    #------------------------------------
    public function actualizarUsuarioController()
    {

        if (isset($_POST["usuarioEditar"])) {

            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuarioEditar"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["passwordEditar"]) &&
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailEditar"])) {

                $encriptar = crypt($_POST["passwordEditar"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $datosController = array("id" => $_POST["idEditar"],
                    "usuario" => $_POST["usuarioEditar"],
                    "password" => $encriptar,
                    "email" => $_POST["emailEditar"]);

                $respuesta = Datos::actualizarUsuarioModel($datosController, "usuarios");

                if ($respuesta == "success") {

                    header("location:cambio");

                } else {

                    echo "error";

                }

            }

        }

    }

    #BORRAR USUARIO
    #------------------------------------
    public function borrarUsuarioController()
    {

        if (isset($_GET["idBorrar"])) {

            $datosController = $_GET["idBorrar"];

            $respuesta = Datos::borrarUsuarioModel($datosController, "usuarios");

            if ($respuesta == "success") {

                header("location:usuarios");

            }

        }

    }

    #VALIDAR USUARIO EXISTENTE
    #-------------------------------------
    public function validarUsuarioController($validarUsuario)
    {

        $datosController = $validarUsuario;

        $respuesta = GestorUsuariosModel::validarUsuarioModel($datosController, "Tusuarios");

        if (count($respuesta["usuario"]) > 0) {
            #if(!empty($respuesta["usuario"]){

            echo 0;
        } else {

            echo 1;
        }

    }

    #VALIDAR EMAIL EXISTENTE
    #-------------------------------------
    public function validarEmailController($validarEmail)
    {

        $datosController = $validarEmail;

        $respuesta = GestorUsuariosModel::validarEmailModel($datosController, "Tusuarios");

        if (count($respuesta["email"]) > 0) {

            echo 0;

        } else {

            echo 1;
        }

    }

    #VISTA DE empleos
    #------------------------------------
    public function vistaEmpleosController()
    {

        $respuesta = Datos::vistaEmpleosModel("clasificados");

        #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

        foreach ($respuesta as $row => $item) {
            echo '<tr>
				<td>' . $item["departamento"] . '</td>
				<td>' . $item["provincia"] . '</td>
				<td>' . $item["distrito"] . '</td>
			</tr>';

        }

    }

    #VISTA DE vehiculos
    #------------------------------------
    public function vistaVehiculosController()
    {

        $respuesta = Datos::vistaVehiculosModel("clasificados");

        #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

        foreach ($respuesta as $row => $item) {
            echo '<tr>
				<td>' . $item["idclasificados"] . '</td>
				<td>' . $item["titulo"] . '</td>
				<td>' . $item["descripcion"] . '</td>
				<td>' . $item["imagenn"] . '</td>
				<td><a href="index.php?action=editar&id=' . $item["id"] . '"><button>Editar</button></a></td>
				<td><a href="index.php?action=vehiculos&idBorrar=' . $item["id"] . '"><button>Borrar</button></a></td>
			</tr>';

        }
    }

    #VISTA DE CREAR ANUNCIOS lISTAS UBICACION
    #------------------------------------
    public function vistaCrearAnunciosUbicacionController()
    {

        $respuesta = Datos::vistaCrearAnunciosUbicacionModel("paises");

        #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

        foreach ($respuesta as $row => $item) {
            #echo '<option value="'.$item['idpaises'].'">'.$item['nombrepais'].'</option>';
            #echo '<option>"'. $item["idpaises"] . '"</option>';
            echo '<option value=' . $item['idpaises'] . '>' . $item["nombrepais"] . '</option>';
            #echo '<option value=>'. $item["idpaises"] . '</option>';
            //print_r($row);
        }
    }

    #VISTA DE CREAR ANUNCIOS lISTAS UBICACION
    #------------------------------------
    public function vistaCrearAnunciosDepartamentoController()
    {

        $respuesta = Datos::vistaCrearAnunciosDepartamentoModel("departamentos");

        #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

        foreach ($respuesta as $row => $item) {
            #echo '<option value="'.$item['idpaises'].'">'.$item['nombrepais'].'</option>';
            #echo '<option>"'. $item["idpaises"] . '"</option>';
            echo '<option value=' . $item['iddepartamentos'] . '>' . $item["nombredepartamento"] . '</option>';
            #echo '<option value=>'. $item["idpaises"] . '</option>';
            //print_r($row);
        }
    }

    #VISTA DE CREAR ANUNCIOS lISTAS UBICACION
    #------------------------------------
    public function vistaCrearAnunciosProvinciaController()
    {

        $respuesta = Datos::vistaCrearAnunciosProvinciaModel("provincias");

        #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

        foreach ($respuesta as $row => $item) {
            #echo '<option value="'.$item['idpaises'].'">'.$item['nombrepais'].'</option>';
            #echo '<option>"'. $item["idpaises"] . '"</option>';
            echo '<option value=' . $item['idprovincias'] . '>' . $item["nombreprovincia"] . '</option>';
            #echo '<option value=>'. $item["idpaises"] . '</option>';
            //print_r($row);
        }
    }

    #VISTA DE CREAR ANUNCIOS lISTAS UBICACION
    #------------------------------------
    public function vistaCrearAnunciosDistritoController()
    {

        $respuesta = Datos::vistaCrearAnunciosDistritoModel("distritos");

        #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

        foreach ($respuesta as $row => $item) {
            #echo '<option value="'.$item['idpaises'].'">'.$item['nombrepais'].'</option>';
            #echo '<option>"'. $item["idpaises"] . '"</option>';
            echo '<option value=' . $item['iddistritos'] . '>' . $item["nombredistrito"] . '</option>';
            #echo '<option value=>'. $item["idpaises"] . '</option>';
            //print_r($row);
        }
    }

    #SELECTLIST DE CREAR ANUNCIOS LISTAS CATEGORIAS
    #------------------------------------
    public function vistaCrearAnunciosCategoriaController()
    {

        $respuesta = Datos::vistaCrearAnunciosCategoriaModel("categorias");

        #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

        foreach ($respuesta as $row => $item) {
            echo '<option value=' . $item['idcategorias'] . '>' . $item['nombrecategoria'] . '</option>';
            #echo '<option>"'. $item["pais"] . '"</option>';
            //print_r($row);

        }
    }

    #SELECT LIST DE CREAR ANUNCIOS SUBCATEGORIAS
    #------------------------------------
    public function vistaCrearAnunciosSubcategoriaController()
    {

        $respuesta = Datos::vistaCrearAnunciosSubcategoriaModel("subcategorias");

        #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

        foreach ($respuesta as $row => $item) {
            echo '<option value=' . $item['idsubcategorias'] . '>' . $item['nombresubcategoria'] . '</option>';
            #echo '<option>"'. $item["pais"] . '"</option>';
            //print_r($row);

        }
    }

    #SELECT LIST DE CREAR ANUNCIOS SUBCATEGORIAS
    #------------------------------------
    public function mostrarClasificadosPorUsuarioController()
    {

        //Verificando si los anuncios estan activos o inactivos

        #$captura_Categoria = $_GET["cat"];

        $captura_Usuario = $_SESSION["idusuario"];

        //Mustera la categoria en la pagina categorias_clasificados
        #echo $captura_Categoria;

        $consulta_estado_clasificados = GestorAnunciosModel::verificarEstadoClasificadosModel("Tclasificados");

        $estado_Clasificado = $consulta_estado_clasificados["estado"];

        #echo $estado_Clasificado;

        $clasificado_activo = 1;
        $clasificaedo_inactivo = 0;

        if ($estado_Clasificado = $clasificado_activo) {
            #echo "Tu claificados estan activos";


            $consulta_total_clasificados = GestorUsuariosModel::contarClasificadosporUsuarioModel($captura_Usuario, "Tclasificados");

            foreach ($consulta_total_clasificados as $array) {
                foreach ($array as $t_c) {
                    $total_clasificados = $t_c . " ";
                }
            }

            $cantidad_elementos = 20;
            $pagina = '';

            if (isset($_GET["page"])) {
                $pagina = $_GET["page"];
                #echo '<h1>'.$page.'</h1>';
            } else {
                $pagina = 1;
            }

            #$page=0;
            $mostrar_desde = ($pagina - 1) * $cantidad_elementos;
            #echo '<h1>'.$start_from.'</h1>';

            $respuesta = GestorUsuariosModel::mostrarClasificadosPorUsuarioModel($captura_Usuario, $mostrar_desde, $cantidad_elementos, "Tclasificados");

            #$numberpaginas=10;
            $ruta = "vista/imagenes/anuncios/";

            if (!empty($respuesta)) {

                foreach ($respuesta as $row => $item) {
                    $timestamp = strtotime($item["fechacreacion"]);
                    $new_date = date('d-m-Y', $timestamp);
                    echo '
					<div class="bloque-lista-clasificados">
			 			<div class="lista-clasificados-campos">
							<div class="campo-imagen">
								<div class="imagen">
									<a href="ver_clasificado-' . $item["idclasificado"] . '-' . str_replace(" ", "_", $item["titulo"]) . '.html">
										<img src="' . $ruta . $item["nombreimagen"] . '" class="img-thumbnail">
									</a>
								</div>			
							</div>
							<div class="campo-titulo">
								<a href="index.php?action=ver_clasificado&id=' . $item["idclasificado"] . '">
								<h4>' . $item["titulo"] . '</h4>
								</a>
							</div>
							<div class="campo-codigo-revista">
								<a href="index.php?action=ver_clasificado&id=' . $item["idclasificado"] . '">
									<i class="far fa-newspaper"></i>&nbsp; Cod. Revista: <b>' . $item["cod_revista"] . '</b>
								</a>
							</div>
							<div class="campo-tipo-moneda">
								<a href="index.php?action=ver_clasificado&id=' . $item["idclasificado"] . '">
								<p>' . $item["tipo_moneda"] . '</p>
								</a>
							</div>
							<div class="campo-precio">
								<a href="index.php?action=ver_clasificado&id=' . $item["idclasificado"] . '">
								<p>' . $item["precio"] . '</p>
								</a>
							</div>
							<div class="campo-precio-condicion">
								<a href="index.php?action=ver_clasificado&id=' . $item["idclasificado"] . '">
								<p><span>(Negociable)</span></p>
								</a>
							</div>
							<div class="campo-descripcion">
								<a href="index.php?action=ver_clasificado&id=' . $item["idclasificado"] . '">
								<p>' . substr($item["descripcion"], 0, 200) . '</p>
								</a>
							</div>
							<div class="campo-fecha-creacion">
								<a href="index.php?action=ver_clasificado&id=' . $item["idclasificado"] . '">
								<p>Publicado: ' . $new_date . '</p>
								</a>
							</div>
						</div>
					</div>
				';
                }
                #echo $row;

                $numero_de_paginas = ceil($total_clasificados / $cantidad_elementos);
                #echo '<h1>'.$number_of_pages.'</h1>';

                echo '
		 			<div class="paginador">
		 		';

                for ($i = 1; $i <= $numero_de_paginas; $i++) {
                    echo '
			  			<div class="pagina">
			  				<a href="index.php?action=usuario&cat=' . $captura_Usuario . '&page=' . $i . '">' . $i . '</a>
						</div>
			  			';
                }

                echo '
		 					</div>
		 				';

            } else {
                echo "Aun no has publicado nada";
            }
        }
    }

    #ELVIS------------------------------------------------------

    #MOSTRAR INFORMACION DEL USER
    #-----------------------------------------------------------
    public static function mostrarInformacionUserController()
    {
        session_start();
        $_SESSION["user_concesionaria"] = true;
        $idusuario = $_SESSION["idusuarioConce"];
        date_default_timezone_set("America/Lima");
        $data = GestorUsuariosModel::mostrarInformacionUserModel($idusuario, "Tusuarios");
        echo '
            <fieldset style="border: 1px solid #dddddd">
                <legend style="font-weight: 600">Saldos</legend>
                <p>Saldo actual:  <span style="color: #00a651; font-weight: 600">S/.' . $data["saldo_usuario"] . '</span></p>
                <div class="enlace-recarga-saldo">
            <form action="saldo_agente" method="post">
                <button type="submit" name="cat" value="vehiculos" class="btn-link">Recargar Saldo</button>
            </form>
        </div>
             </fieldset>
             <div class="contenedor-datos">
             <fieldset style="" class="datos-personales">
                <legend style="font-weight: 600">Datos personales</legend>
                <p>Nombre:  <span>' . $data["nombres"] . '</span></p>
                <p>Apellidos:  <span>' . $data["apellidos"] . '</span></p>
                <p>Pais:  <span>' . $data["pais"] . '</span></p>
                <p>Departamento:  <span>' . $data["departamento"] . '</span></p>
                <p>Provincia:  <span>' . $data["provincia"] . '</span></p>
                <p>Distrito:  <span>' . $data["distrito"] . '</span></p>
                <p>Dirección:  <span>' . $data["direccion"] . '</span></p>
                <div class="enlace-recarga-saldo">
                    <form action="#" method="post">
                        <button type="submit" name="cat" value="vehiculos" class="btn-info">Actualizar información</button>
                    </form>
                </div>
             </fieldset>
                <fieldset class="content-cuenta">
                    <legend style="font-weight: 600">Cuenta</legend>
                    <h5>Último ingreso: <strong>2018-07-23</strong> a las <strong>' . date("h") . ':' . date("i") . ':' . date("s") . ' ' . date("a") . '</strong></h5>
                    <div class="enlace-recarga-saldo">
                        <button class="cerrar-sesion">
                            <a href="salir"><i class="fa fa-sign-out" aria-hidden="true"></i> Terminar
                                Sesión</a>
                        </button>
                </fieldset>
            </div>
            </div>
            ';
    }

    #Listar clasificados por usuarios (paginado, búsqueda)
    public static function listarClasificadosPorUsuarioController($page, $buscar)
    {
        session_start();
        $idusuario = $_SESSION["idusuarioConce"];
        $rpta = GestorUsuariosModel::listarClasificadosPorUsuarioModel($idusuario, $page, $buscar, "tclasificados");
        foreach ($rpta["datos"] as $key => $value) {
            $datos[] = array(
                "idclasificado" => $value["idclasificado"],
                "titulo" => $value["titulo"],
                "descripcion" => $value["descripcion"],
                "tipo_moneda" => $value["tipo_moneda"],
                "precio" => $value["precio"],
                "precio_tipo" => $value["precio_tipo"],
                "celular" => $value["celular"],
                "cod_revista" => $value["cod_revista"],
                "idusuario" => $value["idusuario"],
                "idclasificado" => $value["idclasificado"],
                "nombreimagen" => $value["nombreimagen"],
                "fechacreacion" => $value["fechacreacion"],
                "estado" => $value["estado"]
            );
        }
        return $arraytotal = array(
            "datos" => $datos,
            "paginacion" => $rpta["paginacion"]
        );
    }

    #Editar clasificado
    public static function editarClasificadoController()
    {
        $datosControlador = array(
            "idclasificado" => $_POST['idclasificado'],
            "titulo" => $_POST['titulo'],
            "descripcion" => $_POST['descripcion'],
            "tipo_moneda" => $_POST['tipo_moneda'],
            "precio" => $_POST['precio'],
            "celular" => $_POST['celular'],
            "precio_tipo" => $_POST['precio_tipo'],
            "imagen_actual" => $_POST['imagen_actual']
        );
        
        $rpta = GestorUsuariosModel::editarClasificadosUserModel($datosControlador, 'tclasificados');
        return $rpta;
    }

    #(Desactivar y Activar)
    public static function desactivarClasificado()
    {
        $id = $_GET['id'];
        $rpta = GestorUsuariosModel::desactivarClasificado($id);
        return $rpta;
    }

    public static function activarClasificado()
    {
        $id = $_GET['id'];
        $rpta = GestorUsuariosModel::activarClasificado($id);
        return $rpta;
    }

    //LISTAR CLASIFICADOS X USUARIOS
	public function listarClasificadosController($pagina, $buscar)
	{
		session_start();
		$idusuario = $_SESSION["idusuarioConce"];
		$arrayPaginacion = GestorUsuariosModel::listarClasificadosModel($idusuario, $pagina, $buscar);
		return $arrayPaginacion;
	}

	public function movimientosController($pagina, $buscar)
	{
		session_start();
		$idusuario = $_SESSION["idusuarioConce"];
		$arrayTotal = array();

		$rpta = GestorUsuariosModel::movimientosModel($idusuario, $pagina, $buscar);
		foreach ($rpta["datos"] as $key => $value) {
			$total_pagado = $value["precio_plan_revista"] + $value["precio_plan_web"];
			setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
			$fecha_invertida =  strftime("%d de %B de %Y", strtotime($value["fechacreacion"]));
			$data[] = array(
				"cod_revista" => $value["cod_revista"],
				"titulo" => $value["titulo"],
				"fechacreacion" => $fecha_invertida,
				"precio_plan_revista" => $value["precio_plan_revista"],
				"precio_plan_web" => $value["precio_plan_web"],
				"total_pagado" => $total_pagado
			);
		}

		$datosTotal = GestorUsuariosModel::totalMovimientos($idusuario);
		$total_final = 0.0;
		foreach($datosTotal as $key=> $item){
			$total_pagado = $item["precio_plan_revista"] + $item["precio_plan_web"];
			$total_final += $total_pagado;
		}
		return $arrayTotal = array(
			"data" => $data,
			"paginacion" => $rpta["paginacion"],
			"total_final" => $total_final
		);
	}
}

