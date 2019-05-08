<div id="bloque-contenido-clasificados-categorias">
<?php  
    $captura_Categoria = $_GET["cat"];
    #echo $captura_Categoria;
    if ($captura_Categoria=="inmuebles") {
        echo '
    <div class="bloque-contenido-operacion-tipo-inmuebles">
        <div class="bloque-contenido-operacion-inmuebles">
            <div class="tipo-operacion-inmueble">
                <h4>Tipo de Operación</h4>
                <div class="operacion-inmueble">
                    <a href="#">
                        <img src="vista/temas/img/pagina/inmuebles/tipos/venta.png">
                        <h5><b>Venta</b></h5>
                    </a>
                    <a href=""></a>
                </div>
                <div class="operacion-inmueble">
                    <a href="#">
                        <img src="vista/temas/img/pagina/inmuebles/tipos/alquiler.png">
                        <h5><b>Alquiler</b></h5>
                    </a>
                    <a href=""></a>
                </div>
                <div class="operacion-inmueble">
                    <a href="#">
                        <img src="vista/temas/img/pagina/inmuebles/tipos/traspaso.png">
                        <h5><b>Traspaso</b></h5>
                    </a>
                    <a href=""></a>
                </div>
                <div class="operacion-inmueble">
                    <a href="#">
                        <img src="vista/temas/img/pagina/inmuebles/tipos/anticresis.png">
                        <h5><b>Anticresis</b></h5>
                    </a>
                    <a href=""></a>
                </div>
            </div>
        </div>
        <div class="bloque-contenido-tipo-inmuebles">
            <div class="section-title">
                <h4>Búsqueda por tipo de Inmueble</h4>
            </div>
            <div class="bloque-tipo-inmuebles">
                <div class="tipo-inmueble">
                <a href="http://anegociar.com.pe/inmuebles/inmuebles-tipo/departamentos_17.html"> <br>
                    <img src="vista/temas/img/pagina/inmuebles/operacion/departamentos.png" class="">
                    </a><a href="" class="" style="font-weight: bold; font-size: 12px; color: #008FB9;">
                        Departamentos
                    </a><br>
                    <a href="" class="category_link" style="font-weight: normal; font-size: 13px; color: #008FB9;">
                        (26 Anuncios)
                    </a>
                </div>
                <div class="tipo-inmueble">
                    <a href="http://anegociar.com.pe/inmuebles/inmuebles-tipo/habitaciones_18.html"> <br>
                        <img src="vista/temas/img/pagina/inmuebles/operacion/habitaciones.png" class="">
                        </a><a href="" class="" style="font-weight: bold; font-size: 12px; color: #008FB9;">
                            Habitaciones
                        </a><br>
                        <a href="" class="category_link" style="font-weight: normal; font-size: 13px; color: #008FB9;">
                            (7 Anuncios)
                        </a>  
                </div>
                <div class="tipo-inmueble">
                    <a href="http://anegociar.com.pe/inmuebles/inmuebles-tipo/casas_19.html"> <br>
                        <img src="vista/temas/img/pagina/inmuebles/operacion/casas.png" class="">
                        </a><a href="" class="" style="font-weight: bold; font-size: 12px; color: #008FB9;">
                            Casas
                        </a><br>
                        <a href="" class="category_link" style="font-weight: normal; font-size: 13px; color: #008FB9;">
                            (15 Anuncios)
                        </a> 
                </div>                 
                <div class="tipo-inmueble">
                    <a href="http://anegociar.com.pe/inmuebles/inmuebles-tipo/casas-de-playa_20.html"> <br>
                        <img src="vista/temas/img/pagina/inmuebles/operacion/casas-de-playa.png" class="">
                        </a><a href="" class="" style="font-weight: bold; font-size: 12px; color: #008FB9;">
                            Casas de Playa
                        </a><br>
                        <a href="" class="category_link" style="font-weight: normal; font-size: 13px; color: #008FB9;">
                            (0 Anuncios)
                        </a>
                </div>
                <div class="tipo-inmueble">
                    <a href="http://anegociar.com.pe/inmuebles/inmuebles-tipo/casas-de-campo_21.html"> <br>
                        <img src="vista/temas/img/pagina/inmuebles/operacion/casas-de-campo.png" class="">
                        </a><a href="" class="" style="font-weight: bold; font-size: 12px; color: #008FB9;">
                            Casas de Campo
                        </a><br>
                        <a href="" class="category_link" style="font-weight: normal; font-size: 13px; color: #008FB9;">
                            (0 Anuncios)
                        </a>
                </div>
                <div class="tipo-inmueble">
                    <a href="http://anegociar.com.pe/inmuebles/inmuebles-tipo/oficinas_22.html"> <br>
                        <img src="vista/temas/img/pagina/inmuebles/operacion/oficinas.png" class="">
                        </a><a href="" class="" style="font-weight: bold; font-size: 12px; color: #008FB9;">
                            Oficinas
                        </a><br>
                        <a href="" class="category_link" style="font-weight: normal; font-size: 13px; color: #008FB9;">
                            (7 Anuncios)
                        </a>
                </div>
                <div class="tipo-inmueble">
                    <a href="http://anegociar.com.pe/inmuebles/inmuebles-tipo/local-comercial_23.html"> <br>
                        <img src="vista/temas/img/pagina/inmuebles/operacion/local-comercial.png" class="">
                        </a><a href="" class="" style="font-weight: bold; font-size: 12px; color: #008FB9;">
                            Local Comercial
                        </a><br>
                        <a href="" class="category_link" style="font-weight: normal; font-size: 13px; color: #008FB9;">
                            (14 Anuncios)
                        </a>
                </div>
                <div class="tipo-inmueble">
                    <a href="http://anegociar.com.pe/inmuebles/inmuebles-tipo/local-industrial_24.html"> <br>
                        <img src="vista/temas/img/pagina/inmuebles/operacion/local-industrial.png" class="">
                        </a><a href="" class="" style="font-weight: bold; font-size: 12px; color: #008FB9;">
                            Local Industrial
                        </a><br>
                        <a href="" class="category_link" style="font-weight: normal; font-size: 13px; color: #008FB9;">
                            (7 Anuncios)
                        </a>
                </div>
                <div class="tipo-inmueble">
                    <a href="http://anegociar.com.pe/inmuebles/inmuebles-tipo/terrenos-lotes_25.html"> <br>
                        <img src="vista/temas/img/pagina/inmuebles/operacion/terrenos-lotes.png" class="">
                        </a><a href="" class="" style="font-weight: bold; font-size: 12px; color: #008FB9;">
                            Terrenos / Lotes
                        </a><br>
                        <a href="" class="category_link" style="font-weight: normal; font-size: 13px; color: #008FB9;">
                            (19 Anuncios)
                        </a>
                </div>
                <div class="tipo-inmueble">
                    <a href="http://anegociar.com.pe/inmuebles/inmuebles-tipo/terrenos-agricolas_26.html"> <br>
                        <img src="vista/temas/img/pagina/inmuebles/operacion/terrenos-agricolas.png" class="">
                    </a>
                    <a href="" class="" style="font-weight: bold; font-size: 12px; color: #008FB9;">
                        Terreno Agricola
                    </a><br>
                    <a href="" class="category_link" style="font-weight: normal; font-size: 13px; color: #008FB9;">
                        (1 Anuncios)
                    </a>
                </div>
            </div>
        </div>
    </div>

    ';
    }

    if ($captura_Categoria=="vehiculos") {
        echo '
	<div class="bloque-contenido-clasificados-categorias">
		<div class="bloque-marcas-por-categoria">
    		<div class="marcas-por-categoria">
    			<h2>Búsqueda por Marcas</h2>
    		    <div class="infiniteCarousel">
    		      	<div class="wrapper" style="overflow: hidden;">
    			        <ul style="width: 9999px;">
                        '
                        ?>
    						<?php
    								$vistaPromoverMarcas = new GestorCategoriasController();
    								$vistaPromoverMarcas -> MostrarPromoverMarcasController();
    						?>
                        <?php
                            echo ';
    					</ul>
    				</div>
    			</div>
    		</div>
		</div>
    </div>
    ';
    }
    ?>
	<div class="bloque-ubicaciones-categoria">
		<div class="ubicaciones-categoria">
			<div class="ubicaciones-por-anuncio">
				<?php
					
					$vistaUbicacionVehiculos = new GestorUbicacionesController();
					$vistaUbicacionVehiculos -> mostrarUbicacionesPorCategoriasYSubcategoriasController();
				?>
			</div>
			<div class="anuncios-por-categorias">
				<!--<h1>vehiculos</h1>-->

				<?php
					$vistaVehiculos = new GestorCategoriasController();
					$vistaVehiculos -> mostrarClasificadosPorSubCategoriaController();
				?>
			</div>
		</div>
	</div>
</div>

