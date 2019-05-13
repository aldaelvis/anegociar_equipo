
<script src="vista/temas/js/carrusel.min.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8" async defer>
(function () {
    $.fn.infiniteCarousel = function () {
        function repeat(str, n) {
            return new Array( n + 1 ).join(str);
        }
        
        return this.each(function () {
            // magic!
            var $wrapper = $('> div', this).css('overflow', 'hidden'),
                $slider = $wrapper.find('> ul').width(9999),
                $items = $slider.find('> li'),
                $single = $items.filter(':first')
                
                singleWidth = $single.outerWidth(),
                visible = Math.ceil($wrapper.innerWidth() / singleWidth),
                currentPage = 1,
                pages = Math.ceil($items.length / visible);
                
            /* TASKS */
            
            // 1. pad the pages with empty element if required
            if ($items.length % visible != 0) {
                // pad
                $slider.append(repeat('<li class="empty" />', visible - ($items.length % visible)));
                $items = $slider.find('> li');
            }
            
            // 2. create the carousel padding on left and right (cloned)
            $items.filter(':first').before($items.slice(-visible).clone().addClass('cloned'));
            $items.filter(':last').after($items.slice(0, visible).clone().addClass('cloned'));
            $items = $slider.find('> li');
            
            // 3. reset scroll
            $wrapper.scrollLeft(singleWidth * visible);
            
            // 4. paging function
            function gotoPage(page) {
                var dir = page < currentPage ? -1 : 1,
                    n = Math.abs(currentPage - page),
                    left = singleWidth * dir * visible * n;
                
                $wrapper.filter(':not(:animated)').animate({
                    scrollLeft : '+=' + left
                }, 3500, function () {
                    // if page == last page - then reset position
                    if (page > pages) {
                        $wrapper.scrollLeft(singleWidth * visible);
                        page = 1;
                    } else if (page == 0) {
                        page = pages;
                        $wrapper.scrollLeft(singleWidth * visible * pages);
                    }
                    
                    currentPage = page;
                });
            }
            
            // 5. insert the back and forward link
            $wrapper.after('<a href="#" class="arrow back">&lt;</a><a href="#" class="arrow forward">&gt;</a>');
            
            // 6. bind the back and forward links
            $('a.back', this).click(function () {
                gotoPage(currentPage - 1);
                return false;
            });
            
            $('a.forward', this).click(function () {
                gotoPage(currentPage + 1);
                return false;
            });
            
            $(this).bind('goto', function (event, page) {
                gotoPage(page);
            });
            
            // THIS IS NEW CODE FOR THE AUTOMATIC INFINITE CAROUSEL
            $(this).bind('next', function () {
                gotoPage(currentPage + 1);
            });
        });
    };
})(jQuery);

$(document).ready(function () {
    // THIS IS NEW CODE FOR THE AUTOMATIC INFINITE CAROUSEL
    var autoscrolling = true;
    
    $('.infiniteCarousel').infiniteCarousel().mouseover(function () {
        autoscrolling = false;
    }).mouseout(function () {
        autoscrolling = true;
    });
    
    setInterval(function () {
        if (autoscrolling) {
            $('.infiniteCarousel').trigger('next');
        }
    }, 7000);
});
</script>

<div id="bloque-contenido-clasificados-categorias">
<?php  
    $captura_Categoria = $_GET["cat"];
    #echo $captura_Categoria;
    if ($captura_Categoria=="Inmuebles") {
        echo '
    <div class="bloque-contenido-operacion-tipo-inmuebles">
        <div class="bloque-contenido-operacion-inmuebles">
            <div class="tipo-operacion-inmueble">
                <h4>Tipo de Operación</h4>
                <div class="operacion-inmueble">
                    <a href="#">
                        <img src="vista/temas/img/pagina/inmuebles/tipos/venta.jpg">
                        <h5><b>Venta</b></h5>
                    </a>
                    <a href=""></a>
                </div>
                <div class="operacion-inmueble">
                    <a href="#">
                        <img src="vista/temas/img/pagina/inmuebles/tipos/alquiler.jpg">
                        <h5><b>Alquiler</b></h5>
                    </a>
                    <a href=""></a>
                </div>
                <div class="operacion-inmueble">
                    <a href="#">
                        <img src="vista/temas/img/pagina/inmuebles/tipos/traspaso.jpg">
                        <h5><b>Traspaso</b></h5>
                    </a>
                    <a href=""></a>
                </div>
                <div class="operacion-inmueble">
                    <a href="#">
                        <img src="vista/temas/img/pagina/inmuebles/tipos/anticresis.jpg">
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
                    <a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=departamentos">
                <br>
                    <img src="vista/temas/img/pagina/inmuebles/operacion/departamentos.jpg" class="">
                    </a><a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=departamentos" class="" style="font-weight: bold; font-size: 12px; color: #008FB9;">
                        Departamentos
                    </a><br>
                    <a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=departamentos" class="category_link" style="font-weight: normal; font-size: 13px; color: #008FB9;">
                        (Anuncios)
                    </a>
                </div>
                <div class="tipo-inmueble">
                    <a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=habitaciones"> <br>
                        <img src="vista/temas/img/pagina/inmuebles/operacion/habitaciones.jpg" class="">
                        </a><a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=habitaciones" class="" style="font-weight: bold; font-size: 12px; color: #008FB9;">
                            Habitaciones
                        </a><br>
                        <a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=habitaciones" class="category_link" style="font-weight: normal; font-size: 13px; color: #008FB9;">
                            (Anuncios)
                        </a>  
                </div>
                <div class="tipo-inmueble">
                    <a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=casas"> <br>
                        <img src="vista/temas/img/pagina/inmuebles/operacion/casas.jpg" class="">
                        </a><a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=casas" class="" style="font-weight: bold; font-size: 12px; color: #008FB9;">
                            Casas
                        </a><br>
                        <a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=casas" class="category_link" style="font-weight: normal; font-size: 13px; color: #008FB9;">
                            (Anuncios)
                        </a> 
                </div>                 
                <div class="tipo-inmueble">
                    <a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=casa-de-playa"> <br>
                        <img src="vista/temas/img/pagina/inmuebles/operacion/casas-de-playa.jpg" class="">
                        </a><a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=casa-de-playa" class="" style="font-weight: bold; font-size: 12px; color: #008FB9;">
                            Casas de Playa
                        </a><br>
                        <a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=casa-de-playa" class="category_link" style="font-weight: normal; font-size: 13px; color: #008FB9;">
                            (Anuncios)
                        </a>
                </div>
                <div class="tipo-inmueble">
                    <a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=casas-de-campo"> <br>
                        <img src="vista/temas/img/pagina/inmuebles/operacion/casas-de-campo.jpg" class="">
                        </a><a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=casas-de-campo" class="" style="font-weight: bold; font-size: 12px; color: #008FB9;">
                            Casas de Campo
                        </a><br>
                        <a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=casas-de-campo" class="category_link" style="font-weight: normal; font-size: 13px; color: #008FB9;">
                            (Anuncios)
                        </a>
                </div>
                <div class="tipo-inmueble">
                    <a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=oficinas"> <br>
                        <img src="vista/temas/img/pagina/inmuebles/operacion/oficinas.jpg" class="">
                        </a><a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=oficinas" class="" style="font-weight: bold; font-size: 12px; color: #008FB9;">
                            Oficinas
                        </a><br>
                        <a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=oficinas" class="category_link" style="font-weight: normal; font-size: 13px; color: #008FB9;">
                            (Anuncios)
                        </a>
                </div>
                <div class="tipo-inmueble">
                    <a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=local-comercial"> <br>
                        <img src="vista/temas/img/pagina/inmuebles/operacion/local-comercial.jpg" class="">
                        </a><a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=local-comercial" class="" style="font-weight: bold; font-size: 12px; color: #008FB9;">
                            Local Comercial
                        </a><br>
                        <a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=local-comercial" class="category_link" style="font-weight: normal; font-size: 13px; color: #008FB9;">
                            (Anuncios)
                        </a>
                </div>
                <div class="tipo-inmueble">
                    <a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=local-industrial"> <br>
                        <img src="vista/temas/img/pagina/inmuebles/operacion/local-industrial.jpg" class="">
                        </a><a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=local-industrial" class="" style="font-weight: bold; font-size: 12px; color: #008FB9;">
                            Local Industrial
                        </a><br>
                        <a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=local-industrial" class="category_link" style="font-weight: normal; font-size: 13px; color: #008FB9;">
                            (Anuncios)
                        </a>
                </div>
                <div class="tipo-inmueble">
                    <a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=terrenos-lotes"> <br>
                        <img src="vista/temas/img/pagina/inmuebles/operacion/terrenos-lotes.jpg" class="">
                        </a><a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=terrenos-lotes" class="" style="font-weight: bold; font-size: 12px; color: #008FB9;">
                            Terrenos / Lotes
                        </a><br>
                        <a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=terrenos-lotes" class="category_link" style="font-weight: normal; font-size: 13px; color: #008FB9;">
                            (Anuncios)
                        </a>
                </div>
                <div class="tipo-inmueble">
                    <a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=terrenos-agricolas"> <br>
                        <img src="vista/temas/img/pagina/inmuebles/operacion/terrenos-agricolas.jpg" class="">
                    </a>
                    <a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=terrenos-agricolas" class="" style="font-weight: bold; font-size: 12px; color: #008FB9;">
                        Terreno Agricola
                    </a><br>
                    <a href="index.php?action=subcategorias_clasificados&cat=inmuebles&subcat=terrenos-agricolas" class="category_link" style="font-weight: normal; font-size: 13px; color: #008FB9;">
                        (Anuncios)
                    </a>
                </div>
            </div>
        </div>
    </div>

    ';
    }

    if ($captura_Categoria=="Vehiculos") {
        echo '
	<div class="bloque-contenido-clasificados-categorias">
		<div class="bloque-marcas-por-categoria">
    		<div class="marcas-por-categoria">
    			<h2>Búsqueda por Marcas</h2>
    		    <div class="infiniteCarousel">
    		      	<div class="wrapper" style="overflow: hidden;">
    			        <ul style="width: 9999px;">
                        ';
                        ?>
    						<?php
    								$vistaPromoverMarcas = new GestorCategoriasController();
    								$vistaPromoverMarcas -> MostrarPromoverMarcasController();
    						?>
                        <?php
                            echo '
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
					$vistaUbicacionVehiculos -> vistaAnunciosUbicacionController();
				?>
			</div>
			<div class="anuncios-por-categorias">
				<!--<h1>vehiculos</h1>-->

				<?php
					$vistaVehiculos = new GestorCategoriasController();
					$vistaVehiculos -> mostrarClasificadosPorCategoriaController();
				?>
			</div>
		</div>
	</div>
</div>

