<?php

class GestorUsuariosController{

	#REGISTRO DE USUARIOS
	#------------------------------------
	public static function nuevoUsuarioController()
	{
		$captura_Rol = 'agente';
		$UsuarioActivo = 1;
		$respuestaIdRol = GestorUsuariosModel::verificarIdRolModel($captura_Rol, "Troles");
		$idrol = $respuestaIdRol["idrol"];
			if (empty($_POST['idusuario'])) {
				$encriptar = crypt($_POST["passwordRegistro"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				#hash('sha3-256' , 'String you want to hash');
				$Codigo_activacion = hash('sha3-256' , $_POST["usuarioRegistro"].$encriptar);
				$datosController = array( 
					"usuario"=> $_POST["usuarioRegistro"], 
					"password"=> $_POST["passwordRegistro"],
					"email"=> $_POST["emailRegistro"],
					"nombres"=>isset($_POST["nombresRegistro"]) ? $_POST["nombresRegistro"] : "", 
					"apellidos"=>isset($_POST["apellidosRegistro"])? $_POST["apellidosRegistro"] : "",
					"cod_activacion"=>$Codigo_activacion,
					"saldo_usuario"=>isset($_POST["saldoRegistro"]) ? $_POST["saldoRegistro"] : 0.0,
					"estado"=>$UsuarioActivo,
					"idrol" => $idrol
				);

				$respuesta = GestorUsuariosModel::nuevoUsuarioModel($datosController, "Tusuarios");

				if ( $respuesta == "OK" ) {
					echo "Registrado correctamente";
				}  else {
					echo $respuesta;
				} 
			} else {
				$encriptar = crypt($_POST["passwordRegistro"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				#hash('sha3-256' , 'String you want to hash');
				$Codigo_activacion = hash('sha3-256' , $_POST["usuarioRegistro"].$encriptar);
				$datosController = array( 
					"idusuario" => $_POST["idusuario"],
					"usuario"=> $_POST["usuarioRegistro"], 
					"password"=> $_POST["passwordRegistro"],
					"email"=> $_POST["emailRegistro"],
					"nombres"=>isset($_POST["nombresRegistro"]) ? $_POST["nombresRegistro"] : "", 
					"apellidos"=>isset($_POST["apellidosRegistro"])? $_POST["apellidosRegistro"] : "",
					"cod_activacion"=>$Codigo_activacion,
					"saldo_usuario"=>isset($_POST["saldoRegistro"]) ? $_POST["saldoRegistro"] : 0.0,
					"estado"=>$UsuarioActivo,
					"idrol" => $idrol
				);
				$respuesta = GestorUsuariosModel::editarUsuarioModel($datosController, "Tusuarios");
				if($respuesta == "OK") {
					echo "Editado correctamente";
				}else {
					echo $respuesta;
				}
			}
	}

	/*MOSTRAR USUARIO PARA EDITAR*/
	public static function mostrarUsuarioController()
	{
		$idusuario = $_POST["id"];
		$respuesta = GestorUsuariosModel::mostrarUsuarioModel($idusuario, "Tusuarios");
		return $respuesta;
	}

	/*ACTIVAR Y DESACTIVAR USUARIOS*/
	public static function desactivarUsuarioController()
	{
		$idusuario = $_POST["id"];
		$respuesta = GestorUsuariosModel::desactivarUsuarioModel($idusuario, "Tusuarios");
		return $respuesta;
	}
	public static function activarUsuarioController()
	{
		$idusuario = $_POST["id"];
		$respuesta = GestorUsuariosModel::activarUsuarioModel($idusuario, "Tusuarios");
		return $respuesta;
	}

	public static function recargarSaldoUsuarioController(){
		$idusuario = $_POST["idusuariorecarga"];
		$saldo_aumentado = $_POST["saldo"];
		$usuario = GestorUsuariosModel::mostrarUsuarioModel($idusuario, "Tusuarios");
		$saldo_usuario = $usuario["saldo_usuario"];
		$saldo_total = $saldo_aumentado + $saldo_usuario;
		$datosController = array(
			"idusuario" => $idusuario,
			"saldo_usuario" => $saldo_total
		);
		$respuesta = GestorUsuariosModel::recargarSaldoUsuarioModel($datosController, "Tusuarios");
		if($respuesta == "OK") {
			echo "Recargado correctamente";
		} else {
			echo $respuesta;
		}
	}

	#INGRESO DE USUARIOS
	#------------------------------------
	public function ingresoUsuarioAdminController(){

		if(isset($_POST["usuarioIngreso"])){

			   	$encriptar = crypt($_POST["passwordIngreso"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');	

				$datosController = array( "usuario"=>$_POST["usuarioIngreso"],
										  #"password"=>$_POST["passwordIngreso"]);
									      "password"=>$encriptar
									  	);

			$respuesta = GestorUsuariosModel::ingresoUsuarioAdminModel($datosController, "Tusuarios");

			$rol = 'admin';
			if($respuesta["usuario"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $_POST["passwordIngreso"]){
			#if($respuesta["nombre_rol"]== $rol && $respuesta["usuario"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $_POST["passwordIngreso"]){
			#if($respuesta["usuario"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $encriptar){

				#session_id("session2");

				#if($respuesta['nombre_rol']=== $rol){
				
				#session_name("agente");

				#ini_set("session.cookie_domain", "http://localhost/anegociar/admin");
				ini_set("session.cookie_domain", "http://anegociar.com.pe/Admin");
				$some_name = session_name("some_name4");
				#$domain = 'http://localhost/anegociar/admin';
				$domain = 'http://anegociar.com.pe/Admin';
				session_set_cookie_params(0, "/", $domain);
				
				session_start();
				#session_id ();

				#session_regenerate_id();
				$_SESSION["user_admin"] = true;

				#$_SESSION["agente"] = 'AGNelo';

				$_SESSION["usuarioAdmin"] = $respuesta["usuario"];
				$_SESSION["idusuarioAdmin"] = $respuesta["idusuario"];

				$_SESSION["nombre_rolAdmin"] = $respuesta["nombre_rol"];
				

				#session_write_close();

				#header("location:index.php?action=usuarios");

				header("location:inicio");

				/*
				}
				else{
					$_SESSION["agente"] = false;
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
		echo $datosController;
		$respuesta = GestorUsuariosModel::editarUsuarioModel($datosController, "Tusuarios");
		if($respuesta == "OK") {
			echo "Editado correctament";
		}else {
			echo "No se pudo editar Intentalo de nuevo";
		}

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

		$respuesta = Datos::validarUsuarioModel($datosController, "usuarios");

		if(count($respuesta["usuario"]) > 0){

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

		$respuesta = Datos::validarEmailModel($datosController, "usuarios");

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


	#GUARDAR ARTICULO
	#-----------------------------------------------------------
	public function SaldoDisponibleClasificadoController(){

		session_start();
		$_SESSION["user_admin"] = true;
		$_SESSION["usuarioAdmin"];
		$idusuario = $_SESSION["idusuarioAdmin"];

		$consulta_Saldo_usuario = GestorUsuariosModel::saldoUsuarioModel($idusuario, "Tusuarios");

		$Saldo_Disponible = $consulta_Saldo_usuario["saldo_usuario"];

		echo '
				<legend>Saldos</legend>
                    Saldo Actual = <span style="color: green; font-weight: bold;">S/. '.$Saldo_Disponible.'</span>
                 <br><br>
            ';

	}

	#LISTAR USUARIOS
	#MOSTRAR DEPARTAMENTOS
	public function pruebaAjaxController1()
	{
		$rpta = GestorAnunciosModel::mostrarusuarios();
		$data = Array();
		foreach ($rpta as $key => $item) {
		 	$data[] = array(
				"idusuario" => $item['idusuario'],
				"usuario" => $item['usuario'],
				"email" => $item['email']
 			);
		 } 
		return $data;
	}

	#MOSTRAR DEPARTAMENTOS
	public static function listarUsuariosControlller()
	{
		$rpta = GestorUsuariosModel::listarUsuariosModel("Tusuarios");
		$data = Array();
		foreach ($rpta as $key => $item) {
		 	$data[] = array(
				"0" => ($item['estado']) ?
                    '<a href="#pop2" class="modal">
                    <button class="btn btn-warning btn-xs" onclick="mostrar('.$item['idusuario'].')">
                            E</button></a> ' .
                    '<button class="btn btn-danger btn-xs" onclick="desactivar('.$item['idusuario'].')">
                            D</button>' :
                    '<a href="#pop2" class="modal"> 
                    <button class="btn btn-warning btn-xs" onclick="mostrar('.$item['idusuario'].')">
                            E</button></a>' .
                    ' <button class="btn btn-primary btn-xs" onclick="activar('.$item['idusuario'].')">
                            A</button>',
				"1" => $item['usuario'],
				"2" => $item['nombres'],
				"3" => $item['apellidos'],
				"4" => $item['email'],
				"5" => $item['saldo_usuario'] . '<a href="#recargar" class="modal"><span style="float: right; cursor:pointer;" class="badge bg-purple" onclick="recargar('.$item['idusuario'].')">Recargar</span></a>',
				"6" => $item['fechacreacion'],
				"7" => $item['estado'] ? '<span class="badge bg-green">Activado</span>'
				:'<span class="badge bg-red">Desactivado</span>',
 			);
		 } 
		 $result = array(
            'sEcho' => 1,
            'iTotalRecords' => count($data),
            'iTotalDisplayRecords' => count($data),
            'aaData' => $data
        );
		return $result;
	}
	#VALIDAR USUARIO EXISTENTE
	#-------------------------------------
	public function pruebaAjaxController(/*$pruebaAjax*/){

		#$datosController = $pruebaAjax;

		$respuesta = GestorUsuariosModel::mostrarusuariosAjaxModel(/*$datosController,*/"Tusuarios");

		$data = Array();
		foreach ($respuesta as $row => $item) {
		 	$data[] = array(
				"idusuario" => $item['idusuario'],
				"usuario" => $item['usuario'],
				"email" => $item['email']
 			);
		 } 
		return $data;
	}
/*
	$data = array();
	while($r = $query->fetch_assoc()){
		$data[] = $r;
	}
	echo json_encode(array("contactos"=>$data));
	*/

	#-----------------------------------------------------------
	#public function ListarAgentesController($obtenerListaUsuarios){
	public function listarUsuariosPorRol(){

#		$nombre_rol = $_GET["rol"];

#		$consulta_lista_agentes = GestorUsuariosModel::listarUsuariosPorRolModel($nombre_rol, "Tusuarios");

 		#$numberpaginas=10;
		$ruta = "vista/imagenes/anuncios/";

		if (!empty($consulta_lista_agentes)){

			#krsort($consulta_lista_agentes);

			foreach ($consulta_lista_agentes as $row => $item){
				#echo '<td><a href="#" data-role="update" data-id="'.$item["idusuario"].'"><button>Editar</button></a></td>';
				echo '<tr id="'.$item["idusuario"].'">
				        <td>'.$item["nombres"].'</td>
				    ';
				if ($item["estado"]==1) {
					echo '
							<td>Activado</td>
						';
				}
				else{
					echo '
							<td>Desactivado</td>
						';
				}
/*
echo '
    <td data-target="firstName">'.$item["usuario"].'</td>
    <td data-target="email">'.$item["email"].'</td>
    <td>'.$item["saldo_usuario"].'</td>
    <td><a href="#" data-role="update"><button>Editar</button></a>
		<a href="index.php?action=usuarios&idBorrar='.$item["idusuario"].'"><button>Borrar</button></a>
	</td>
  </tr>';
*/
   // <td><a href="index.php?action=editar&rol='.$nombre_rol.'&id='.$item["idusuario"].'" data-role="update"><button>Editar</button></a>

				echo json_encode('
				       '.$item["usuario"].'
				       '.$item["email"].'
				       '.$item["saldo_usuario"].'
				       <a href="#" data-role="update"><button>Editar</button></a>
							<a href="index.php?action=usuarios&idBorrar='.$item["idusuario"].'"><button>Borrar</button>');

				       // <td><a href="index.php?action=editar&rol='.$nombre_rol.'&id='.$item["idusuario"].'" data-role="update"><button>Editar</button></a>

			}
// 			if($con){
// 	$sql = "select * from contact";
// 	$query = $con->query($sql);
// 	$data = array();
// 	while($r = $query->fetch_assoc()){
// 		$data[] = $r;
// 	}
// 	echo json_encode(array("contactos"=>$data));
// }
		}
	}
#MOSTRAR DEPARTAMENTOS -- ELVIS

	public function mostrarDepartamentosController()
	{
		$rpta = GestorUsuariosModel::mostrarDepartamentos();
		// $data = Array();
		// while($reg = $rpta) 
		// {
		// 	$data[] = array(
		// 		"iddepartamento" => $reg->iddepartamento,
		// 		"nombredepartamento" => $reg->nombredepartamento,
		// 		"idpais" => $reg->idpais
 	// 		);
		// }
		// $data = "elvis";
		// echo $respuesta["nombredepartamento"];
		// echo "holaaaaaaaaaaa";
		foreach($rpta as $row => $item){

				$data[] = array(
				"iddepartamento" => $item["iddepartamento"],
				"nombredepartamento" => $item["nombredepartamento"],
				"idpais" => $item["idpais"]
				);
			}
		 return json_encode($data);
	}

		#EDITAR USUARIO
	#------------------------------------
	public function editarUsuarioPorRolController(){

		$datosController = $_GET["id"];
		#echo $datosController;
		$respuesta = GestorUsuariosModel::editarUsuarioPorRolModel($datosController, "Tusuarios");

		echo'<input type="text" value="'.$respuesta["idusuario"].'" name="idEditar">

			 <input type="text" value="'.$respuesta["usuario"].'" name="usuarioEditar" required>

			 <input type="email" value="'.$respuesta["email"].'" name="emailEditar" required>

			 <input type="submit" value="Actualizar">';

	}

	#ACTUALIZAR USUARIO
	#------------------------------------
	public function actualizarUsuarioPorRolController(){

		$captura_Rol = $_GET["rol"];

		if(isset($_POST["usuarioEditar"])){
/*
			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuarioEditar"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["passwordEditar"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailEditar"])){
*/
			   	$encriptar = crypt($_POST["passwordEditar"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');	

				$datosController = array( "id"=>$_POST["idEditar"],
								          "usuario"=>$_POST["usuarioEditar"],
					                      "email"=>$_POST["emailEditar"]
					                  );
				
				$respuesta = GestorUsuariosModel::actualizarUsuarioPorRolModel($datosController, "Tusuarios");

				if($respuesta == "success"){

					#echo "se actualizo corectamente";
					header('location:index.php?action=listar&rol='.$captura_Rol.'');

				}

				else{

					echo "error";

				}

			// }

		}
	
	}

	public function ActualizarListarAgentesAjaxController($datos){

/*
		$datosController = $validarUsuario;
		$respuesta = Datos::validarUsuarioModel($datosController, "usuarios");
*/

		GestorUsuariosModel::actualizarUsuarioPorRolModel($datos, "Tusuarios");

		#$datosController = $datos;

		#$datosController = array("id"=>$respuesta["userId"],
			                 #"usuario"=>$respuesta["firstName"],
			                 #"email"=>$respuesta["email"]
			             	#);
		
		#$respuesta = GestorUsuariosModel::actualizarUsuarioPorRolModel($datosController, "Tusuarios");
		
		#echo json_encode($enviarDatos);

/*
		if($respuesta == "success"){

			#header("location:cambio");
			echo "actualizaste";

		}

		else{

			echo "error";

		}
		*/
	}


	#SELECT LIST DE CREAR ANUNCIOS SUBCATEGORIAS
	#------------------------------------
	public function mostrarClasificadosPorUsuarioController(){

			//Verificando si los anuncios estan activos o inactivos

			#$captura_Categoria = $_GET["cat"];
			
			$captura_Usuario = $_SESSION["idusuarioAG"];

			#echo 'waaaaaa'.$captura_Usuario.'wweeee';

			//Mustera la categoria en la pagina categorias_clasificados
			#echo $captura_Categoria;

			$consulta_estado_clasificados = GestorAnunciosModel::verificarEstadoClasificadosModel("Tclasificados");

			$estado_Clasificado = $consulta_estado_clasificados["estado"];

			#echo $estado_Clasificado;

			$clasificado_activo= 1;
			$clasificaedo_inactivo= 0;

			if ($estado_Clasificado=$clasificado_activo)  {
				#echo "Tu claificados estan activos";


			$consulta_total_clasificados = GestorUsuariosModel::contarClasificadosporUsuarioModel($captura_Usuario, "Tclasificados");

			foreach($consulta_total_clasificados as $array) {
				foreach($array as $t_c) {
					$total_clasificados = $t_c . " ";
				}
			}
			#echo $total_clasificados;
			
			$cantidad_elementos = 5;  
			$pagina = '';  
			
			if(isset($_GET["page"]))  
			{  
			      $pagina = $_GET["page"];  
			      echo '<h1>'.$pagina.'</h1>'; 
			}
			else  
			{  
			     $pagina = 1;  
			}
			
			#$page=0;
			$mostrar_desde = ($pagina - 1)*$cantidad_elementos;
			#echo '<h1>'.$mostrar_desde.'</h1>';
			
			$respuesta = GestorUsuariosModel::mostrarClasificadosPorUsuarioModel($captura_Usuario, $mostrar_desde, $cantidad_elementos, "Tclasificados"); 

	 		#$numberpaginas=10;
			$ruta = "vista/imagenes/anuncios/";

			if (!empty($respuesta)){

				foreach($respuesta as $row => $item){

				echo'
					<div class="bloque-lista-clasificados">
			 			<div class="lista-clasificados-campos">
							<div class="campo-imagen">
								<a href="index.php?action=ver_clasificado&id='.$item["idclasificado"].'">
								<img src="'.$ruta.$item["nombreimagen"].'" class="img-thumbnail">
								</a>							
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
								<p><span>(Negociable)</span></p>
								</a>
							</div>
							<div class="campo-descripcion">
								<a href="index.php?action=ver_clasificado&id='.$item["idclasificado"].'">
								<p>'.substr($item["descripcion"],0,200).'</p>
								</a>
							</div>
							<div class="campo-fecha-creacion">
								<a href="index.php?action=ver_clasificado&id='.$item["idclasificado"].'">
								<p>Publicado: Hace 1 semana'.$item["fechacreacion"].'</p>
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
			  				<a href="index.php?action=ultimas_publicaciones&page=' . $i . '">' . $i . '</a>
						</div>
			  			';
			  		}
			  	
			  		echo '
		 					</div>
		 				';
	 		
				}
				else {
					echo "No hay nadaaaa";
				}
			}			
		}
	}
?>

