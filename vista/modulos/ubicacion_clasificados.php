
<!-- <script type="text/javascript" charset="utf-8" async defer>
    $(document).ready(function(){
  var uri = window.location.toString();
  if (uri.indexOf("index.php?") > 0) {
      var clean_uri = uri.substring(0, uri.indexOf("&"));
      window.history.replaceState({}, document.title, clean_uri);
  }
});
</script>
 -->
<div id="bloque-contenido-clasificados-categorias">
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
                if (isset($_GET["cat"])) {

                    echo '
                        <div id="contenido-empleos">
                        ';
                    $vistaVehiculos = new GestorUbicacionesController();
                    $vistaVehiculos -> mostrarClasificadosCategoriasPorUbicacionController();
                    echo '
                        </div>
                    ';
                }

                elseif (isset($_GET["cat"])&&($_GET["subcat"])) {
                    echo '
                        <div id="contenido-empleos">
                        ';
                    $vistaVehiculos = new GestorUbicacionesController();
                    $vistaVehiculos -> mostrarClasificadosCategoriasYSubcategoriasPorUbicacionController();
                    echo '
                        </div>
                    ';
                }
            ?>
            </div>
        </div>
    </div>
</div>