<?php
ob_end_flush();
?>
<div id="menu">
	<div id="menu-superior">
		<div class="menu-categorias-destacadas">
			<li>
				<a href="index.php?action=categorias_clasificados&cat=vehiculos">
					<i class="fas fa-car"></i> Vehiculos
				</a>
			</li>
			<!-- <li><a href="vehiculos?cat=vehiculos">Vehiculos</a></li> -->
			<li>
				<a href="index.php?action=categorias_clasificados&cat=inmuebles">
					<i class="fas fa-building"></i> Immuebles
				</a>
			</li>
			<!-- <li><a href="motos">Motos</a></li> -->
			<li>
				<a href="index.php?action=categorias_clasificados&cat=empleos">
					<i class="fas fa-briefcase"></i> Empleos
				</a>
			</li>
		</div>
		<div class="menu-usuario">
			<?php  
				session_start();
				if(isset($_SESSION["user-usuario"])){
    			#$role = $_SESSION['nombre_rol'];
    			#if(isset($_SESSION['nombre_rol'])==="usuario"){
				#if(isset($_SESSION["user"], $_SESSION['nombre_rol']) && $_SESSION['nombre_rol'] == 'usuario'){
		  			echo '<div class="nombre-usuario">
							<li>Hola: <a href="usuario">'.$_SESSION["usuario"].'</a></li>
						</div>
						<div class="usuario">
							<i class="fas fa-user"></i>
							<li><a href="usuario">Mi Cuenta</a></li>
							<li><a href="salir">Salir</a></li>
						</div>';
					}
				else {
					echo '
						<div class="nombre-usuario">
							<li>Hola</li>
						</div>
						<div class="cuenta-usuario">
							<i class="fas fa-user"></i>
							<li><a href="registro">Registro</a></li>
							<li><a href="ingreso"> / Ingreso</a></li>
						</div>';
				}
			?>
		</div>
		<div class="menu-vender">
			<li>
				<a href="crear_anuncio">
					<i class="fas fa-mouse-pointer"></i> Vender
				</a>
			</li>
		</div>
	</div>

		<?php

    header("Cache-Control: no cache");
    session_cache_limiter("private_no_expire");

?>
	<div id="nuscador">   
        <form action="buscar" method="post">
            <select name="cat" class="nombrecategoria">
                <!-- <option disabled value="" selected hidden>--Cualquiera--</option> -->
                <option value="">--Cualquiera--</option>
                <option value="Vehiculos">Vehiculos</option>
                <option value="Inmuebles">Inmuebles</option>
                <option value="Empleos">Empleos</option>
                <option value="Hogar - Oficina - Negocio" class="imagebacked" style="background-image: url(vista/temas/img/publicacion-clasificados.png)">Hogar - Oficina - Negocio</option>
                <option value="Servicios">Servicios</option>
                <option value="Hobbies - Tiempo Libre">Hobbies - Tiempo Libre</option>
                <option value="Teléfonos - móviles">Teléfonos - móviles</option>
                <option value="Informática - Sonido - Video">Informática - Sonido - Video</option>
                <option value="Mascotas - Animales">Mascotas - Animales</option>
                <option value="Ropa - Calzado - Accesorios">Ropa - Calzado - Accesorios</option>
                <option value="Esoterismo">Esoterismo</option>
                <option value="Contactos">Contactos</option>
            </select>
            <input type="text" placeholder="¿Que estas Buscando?" name="buscarpalabraanuncio" id="buscarpalabraanuncio" autocomplete="off" required="">
            <button type="submit" id="buscaranuncio" name="buscaranuncio" value="" class="btn-link"> 
            	<i class="fas fa-search"></i> Buscar
            </button>
        </form>
    </div>

	<div id="menu-principal">
		<div class="menu-principal">		
		  	<label for="show-menu" class="show-menu">Mostrar Menu</label>
	    	<input type="checkbox" id="show-menu" role="button">
	        <ul id="menu">
	        	<!-- <li><a href="index.php?action=inicio" title="">Inicio</a></li> -->
		        <li>
		        	<a href="inicio">
		        		<i class="fas fa-home"></i> Inicio
		        	</a>
		        </li>
		        <li>
		            <a href="nosotros">
		            	<i class="fas fa-address-card"></i> Nosotros</a>
		            <!-- <ul class="hidden">
		                <li><a href="#">Who We Are</a></li>
		                <li><a href="#">What We Do</a></li>
		            </ul> -->
		        </li>
		        <li>
		            <a href="servicios">
		            	<i class="fas fa-clipboard-list"></i> Servicios</a>
		            <!-- <ul class="hidden">
		                <li><a href="#">Photography</a></li>
		                <li><a href="#">Web & User Interface Design</a></li>
		                <li><a href="#">Illustration</a></li>
		            </ul> -->
		        </li>
		        <li>
		        	<a href="revista">
		        		<i class="far fa-newspaper"></i> Revista
		        	</a>
		    	</li>
		        <li>
		        	<a href="contactenos">
		        		<i class="fas fa-envelope"></i> Contáctenos</a>
		        </li>
	    	</ul>
	    </div>
	</div>
</div>