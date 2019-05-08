<?php

class GestorUsuariosController{
	
	#REGISTRO DE USUARIOS
	#------------------------------------
	public function registroUsuarioController(){

		if(isset($_POST["usuarioRegistro"])){

			#preg_match = Realiza una comparación con una expresión regular

/*			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuarioRegistro"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["passwordRegistro"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailRegistro"])){
*/
				#crypt() devolverá el hash de un string utilizando el algoritmo estándar basado en DES de Unix o algoritmos alternativos que puedan estar disponibles en el sistema.

			   	$encriptar = crypt($_POST["passwordRegistro"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

  				#hash('sha3-256' , 'String you want to hash');
  				$Codigo_activacion = hash('sha3-256' , $_POST["usuarioRegistro"].$encriptar);

				$datosController = array( 
										  #"idusuario"=>$idusuario, 
										  "usuario"=>$_POST["usuarioRegistro"], 
									      "password"=>$encriptar,
									      "email"=>$_POST["emailRegistro"],
									      "cod_activacion"=>$Codigo_activacion
									  );

				$respuesta = GestorUsuariosModel::registroUsuarioModel(/*$idusuario,*/ $datosController, "Tusuarios");

				echo $respuesta;

				$idrol = 2;

				if (!empty($respuesta)){


				$respuesta2 = GestorUsuariosModel::asignaRolUsuarioModel(/*$idusuario,*/ $respuesta, $idrol, "Tusuarios_roles");

				if($respuesta2 == "success"){
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
			                <h1>Hola ' .$_POST["usuarioRegistro"]. '!</h1>
							<p><a href="'.$SITE_URL.'index.php?action=activar&id=' . base64_encode($respuesta) .$Codigo_activacion .'">CLICK AQUI PARA ACTIVAR SU CUENTA</a>
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
					if($mail->Send())
					{
						header('Location: registro_exitoso');
					}
					else{
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
	public function activarRegistroUsuarioController(){

		if (isset($_GET["id"])) {
		  	$id = intval(base64_decode($_GET["id"]));
			
			#$id = $_GET["id"];

		  	#echo $id;

		  	$respuesta = GestorUsuariosModel::activarRegistroUsuarioModel($id, "Tusuarios");

			if($respuesta == "success"){

				#echo "<br/>se activo correctamente";
				header('Location: activacion_exitosa');
			
			}
			else{

				echo "<br/>no se activo correctamente<br />";
				#cho $respuesta;
			}
		}

		else{
			echo "<br/>Los datos no coninciden<br />";
		}
	

	}


	#INGRESO DE USUARIOS
	#------------------------------------
	public function ingresoUsuarioController(){

		if(isset($_POST["usuarioIngreso"])){
			   	$encriptar = crypt($_POST["passwordIngreso"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');	

				$datosController = array( "usuario"=>$_POST["usuarioIngreso"],
										  #"password"=>$_POST["passwordIngreso"]);
									      "password"=>$encriptar
									  	);

			$respuesta = GestorUsuariosModel::ingresoUsuarioModel($datosController, "Tusuarios");

			$rol = 'usuario';
			#if($respuesta["usuario"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $_POST["passwordIngreso"]){
			#if($respuesta["nombre_rol"]== $rol && $respuesta["usuario"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $encriptar){
			if($respuesta["usuario"] == $_POST["usuarioIngreso"] OR $respuesta["email"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $encriptar){

				#session_id("session1");

				#if($respuesta['nombre_rol']=== $rol){

				// $name = $respuesta["usuario"];
				#session_name("user");

				#ini_set("session.cookie_domain", "http://localhost/anegociar");
				ini_set("session.cookie_domain", "http://anegociar.com.pe");
				$some_name = session_name("some_name");
				#$domain = 'http://localhost/anegociar';
				$domain = 'http://anegociar.com.pe';
				session_set_cookie_params(0, "/", $domain);
				session_start();
				#session_id ();
				#session_regenerate_id();

				$_SESSION['user-usuario'] = true;
				#$_SESSION["usuario"] = 'UsuNelo';

				$_SESSION["usuario"] = $respuesta["usuario"];
				$_SESSION["idusuario"] = $respuesta["idusuario"];
				$_SESSION["nombre_rol"] = $respuesta["nombre_rol"];
				
				#session_write_close();

				#header("location:index.php?action=usuarios");

				header("location:usuario");
				/*
				}

				else{
					$_SESSION['user'] = false;
				}
				*/

			}

			else{

				header("location:fallo");

			}

		}	

	}

	#VISTA DE USUARIOS
	#------------------------------------
	public function vistaUsuariosController(){

		$respuesta = Datos::vistaUsuariosModel("usuarios");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["usuario"].'</td>
				<td>'.$item["password"].'</td>
				<td>'.$item["email"].'</td>
				<td><a href="index.php?action=editar&id='.$item["id"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=usuarios&idBorrar='.$item["id"].'"><button>Borrar</button></a></td>
			</tr>';

		}

	}

	#EDITAR USUARIO
	#------------------------------------
	public function editarUsuarioController(){

		$datosController = $_GET["id"];
		$respuesta = Datos::editarUsuarioModel($datosController, "usuarios");

		echo'<input type="hidden" value="'.$respuesta["id"].'" name="idEditar">

			 <input type="text" value="'.$respuesta["usuario"].'" name="usuarioEditar" required>

			 <input type="text" value="'.$respuesta["password"].'" name="passwordEditar" required>

			 <input type="email" value="'.$respuesta["email"].'" name="emailEditar" required>

			 <input type="submit" value="Actualizar">';

	}

	#ACTUALIZAR USUARIO
	#------------------------------------
	public function actualizarUsuarioController(){

		if(isset($_POST["usuarioEditar"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuarioEditar"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["passwordEditar"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailEditar"])){

			   	$encriptar = crypt($_POST["passwordEditar"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');	

				$datosController = array( "id"=>$_POST["idEditar"],
								          "usuario"=>$_POST["usuarioEditar"],
					                      "password"=>$encriptar,
					                      "email"=>$_POST["emailEditar"]);
				
				$respuesta = Datos::actualizarUsuarioModel($datosController, "usuarios");

				if($respuesta == "success"){

					header("location:cambio");

				}

				else{

					echo "error";

				}

			}

		}
	
	}

	#BORRAR USUARIO
	#------------------------------------
	public function borrarUsuarioController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];
			
			$respuesta = Datos::borrarUsuarioModel($datosController, "usuarios");

			if($respuesta == "success"){

				header("location:usuarios");
			
			}

		}

	}

	#VALIDAR USUARIO EXISTENTE
	#-------------------------------------
	public function validarUsuarioController($validarUsuario){

		$datosController = $validarUsuario;

		$respuesta = GestorUsuariosModel::validarUsuarioModel($datosController, "Tusuarios");

		if(count($respuesta["usuario"]) > 0){
		#if(!empty($respuesta["usuario"]){

			echo 0;
		}

		else{

			echo 1;
		}

	}

	#VALIDAR EMAIL EXISTENTE
	#-------------------------------------
	public function validarEmailController($validarEmail){

		$datosController = $validarEmail;

		$respuesta = GestorUsuariosModel::validarEmailModel($datosController, "Tusuarios");

		if(count($respuesta["email"]) > 0){

			echo 0;

		}

		else{

			echo 1;
		}

	}

	#VISTA DE empleos
	#------------------------------------
	public function vistaEmpleosController(){

		$respuesta = Datos::vistaEmpleosModel("clasificados");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["departamento"].'</td>
				<td>'.$item["provincia"].'</td>
				<td>'.$item["distrito"].'</td>
			</tr>';

		}

	}

	#VISTA DE vehiculos
	#------------------------------------
	public function vistaVehiculosController(){

		$respuesta = Datos::vistaVehiculosModel("clasificados");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["idclasificados"].'</td>
				<td>'.$item["titulo"].'</td>
				<td>'.$item["descripcion"].'</td>
				<td>'.$item["imagenn"].'</td>
				<td><a href="index.php?action=editar&id='.$item["id"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=vehiculos&idBorrar='.$item["id"].'"><button>Borrar</button></a></td>
			</tr>';

		}
	}

	#VISTA DE CREAR ANUNCIOS lISTAS UBICACION
	#------------------------------------
	public function vistaCrearAnunciosUbicacionController(){

		$respuesta = Datos::vistaCrearAnunciosUbicacionModel("paises");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){
			#echo '<option value="'.$item['idpaises'].'">'.$item['nombrepais'].'</option>';
			#echo '<option>"'. $item["idpaises"] . '"</option>';
			echo '<option value='.$item['idpaises'].'>'. $item["nombrepais"] . '</option>';
			#echo '<option value=>'. $item["idpaises"] . '</option>';
        //print_r($row); 
		}
	}	
	
	#VISTA DE CREAR ANUNCIOS lISTAS UBICACION
	#------------------------------------
	public function vistaCrearAnunciosDepartamentoController(){

		$respuesta = Datos::vistaCrearAnunciosDepartamentoModel("departamentos");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){
			#echo '<option value="'.$item['idpaises'].'">'.$item['nombrepais'].'</option>';
			#echo '<option>"'. $item["idpaises"] . '"</option>';
			echo '<option value='.$item['iddepartamentos'].'>'. $item["nombredepartamento"] . '</option>';
			#echo '<option value=>'. $item["idpaises"] . '</option>';
        //print_r($row); 
		}
	}

	#VISTA DE CREAR ANUNCIOS lISTAS UBICACION
	#------------------------------------
	public function vistaCrearAnunciosProvinciaController(){

		$respuesta = Datos::vistaCrearAnunciosProvinciaModel("provincias");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){
			#echo '<option value="'.$item['idpaises'].'">'.$item['nombrepais'].'</option>';
			#echo '<option>"'. $item["idpaises"] . '"</option>';
			echo '<option value='.$item['idprovincias'].'>'. $item["nombreprovincia"] . '</option>';
			#echo '<option value=>'. $item["idpaises"] . '</option>';
        //print_r($row); 
		}
	}

	#VISTA DE CREAR ANUNCIOS lISTAS UBICACION
	#------------------------------------
	public function vistaCrearAnunciosDistritoController(){

		$respuesta = Datos::vistaCrearAnunciosDistritoModel("distritos");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){
			#echo '<option value="'.$item['idpaises'].'">'.$item['nombrepais'].'</option>';
			#echo '<option>"'. $item["idpaises"] . '"</option>';
			echo '<option value='.$item['iddistritos'].'>'. $item["nombredistrito"] . '</option>';
			#echo '<option value=>'. $item["idpaises"] . '</option>';
        //print_r($row); 
		}
	}

	#SELECTLIST DE CREAR ANUNCIOS LISTAS CATEGORIAS
	#------------------------------------
	public function vistaCrearAnunciosCategoriaController(){

		$respuesta = Datos::vistaCrearAnunciosCategoriaModel("categorias");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){
			echo '<option value='.$item['idcategorias'].'>'.$item['nombrecategoria'].'</option>';
			#echo '<option>"'. $item["pais"] . '"</option>';
        //print_r($row); 

		}
	}

	#SELECT LIST DE CREAR ANUNCIOS SUBCATEGORIAS
	#------------------------------------
	public function vistaCrearAnunciosSubcategoriaController(){

		$respuesta = Datos::vistaCrearAnunciosSubcategoriaModel("subcategorias");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){
			echo '<option value='.$item['idsubcategorias'].'>'.$item['nombresubcategoria'].'</option>';
			#echo '<option>"'. $item["pais"] . '"</option>';
        //print_r($row); 

		}
	}

	public static function mostrarClasificadosPorUsuarioController()
	{
		session_start();
		#recuperamos datos desde la vista
		$idusuario = $_SESSION["idusuario"];
		$page = $_GET["pagina"];
		$buscar = $_GET["buscar"];

		$datosControlador = array(
			"buscar" => (string)$buscar,
			"idusuario" => $idusuario
		);
		#----Comenzamos con el paginador
		#Modificar para que aparescan mas registros por pagina
		$tamaño_pagina = 5;
		$empezar_desde = ($page - 1) * $tamaño_pagina;
		$num_filas = GestorUsuariosModel::totalClasificadosPorUsuario($datosControlador, "Tclasificados");
		$total_paginas = (int) ceil($num_filas / $tamaño_pagina);
		$from = ($page * $tamaño_pagina) - $tamaño_pagina;
		$to = $page * $tamaño_pagina;

		$datosControlador2 = array(
			"idusuario" => $idusuario,
			"buscar" => (string)$buscar,
			"param1" => $empezar_desde,
			"param2" => $tamaño_pagina
		);

		#recuperamos la respuesta paginado
		$clasificados = GestorUsuariosModel::mostrarClasificadosModel($datosControlador2, "tclasificados");

		#Agrupamos en un array la información
		return $arrayTotal = array(
			"datos" => $clasificados,
			"paginacion" => array(
				"total" => $num_filas,
				"current_page" => (int) $page,
				"per_page" => $tamaño_pagina,
				"last_page" => $total_paginas,
				"from" => $from,
				"to" => $to,
			)
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

	public static function mostrarInformacionUsuarioController(){
		session_start();
		$datosModel = $_SESSION["idusuario"];
		$rpta = GestorUsuariosModel::mostrarInformacionUserModel($datosModel, "tusuarios");
		$datos = array(
			"idusuario"=> $rpta["idusuario"],
			"usuario"=> $rpta["usuario"],
			"saldo_usuario"=> $rpta["saldo_usuario"],
			"email"=> $rpta["email"],
			"nombres"=> $rpta["nombres"],
			"apellidos"=> $rpta["apellidos"],
			"departamento"=> $rpta["departamento"],
			"provincia"=> $rpta["provincia"],
			"pais"=> $rpta["pais"],
			"direccion"=> $rpta["direccion"],
			"distrito"=> $rpta["distrito"],
			"email"=> $rpta["email"],
			"foto"=> $rpta["foto"]
		);
		return $datos;
	}
}

?>