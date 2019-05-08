		echo '<div class="campos-categorias-subcategorias">';
		foreach($respuesta as $row => $item){

			if ($verifica_nombre_categoria != $item['nombrecategoria']) {
			        echo '
							<div class="campo-imagen-categoria">
					        	<img src="'.$ruta_imagenes.$item['ruta_imagen_categoria'].'" alt="anwegociarperu-imagen-categorias" class="img-responsive">
					        </div>
					        <div class="campo-nombre-categoria">
					        	<h5>'.$item['nombrecategoria'].'</h5>
					        </div>
						';
			        // asignas la nueva categora unica sin repetir
			        $verifica_nombre_categoria = $item['nombrecategoria'];
		   	}
	   		/*
			if ($idProfesor != $item['idcategoria']) {
	        echo $item['idcategoria'];
	        // asignas el nuevo id
	        $idProfesor = $item['idcategoria']
	   		}
	   		*/
			// Muestra las subcategorias
	    	echo '
	    			<div class="campo-nombre-subcategoria">
		    			<ul>
							<li>
								<a href="#">'.$item['nombresubcategoria'].'</a>
							</li>
					 	</ul>
				  </div>

				';

		}

		echo ' 
    			<div>
    		';


