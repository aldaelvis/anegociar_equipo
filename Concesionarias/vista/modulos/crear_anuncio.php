<?php
ob_start();
session_start();
header("Cache-Control: no cache");
session_cache_limiter("private_no_expire");
if (!$_SESSION["user_concesionaria"]) {
    header('location:ingreso');
}

if (isset($_POST['cat'])) {
    $_SESSION['cat'] = $_POST['cat'];
} elseif (!empty($_SESSION['cat'])) {
    $capturaCategoria = $_SESSION["cat"];
} 
else {
    header('location:elije_tipo_anuncio');
}
?>
<div id="bloque-contenido-crear-clasificados">
    <h1 class="page-title">Crear <span style="color: #2196F3;">Anuncio</span></h1>
    <div class="bloque-contenido-crear-clasificados">
        <div id="crear-anuncio">
            <form method="post" enctype="multipart/form-data">
                <div class="caracteristicas">
                    <label for="ubicacioncrearanuncio">Categorias<span></span></label>
                    <div class="categoria">
                        <label for="categoriacrearanuncio"> <span></span></label>
                        <input type="text" name="categoriacrearanuncio" class="categoriacrearanuncio"
                            id="categoriacrearanuncio" value="<?php echo $_SESSION["cat"] ?>" required>
                    </div>
                    <div class="sub-categoria">
                        <label for="subcategoriacrearanuncio"> <span></span></label>
                        <select name="subcategoriacrearanuncio" class="subcategoriacrearanuncio" required>
                            <option disabled value="" selected hidden>--Subcategoria--</option>
                        </select>
                    </div>

                    <div class="marca-modelo">
                        <label for="marcacrearanuncio">Marca / Modelo<span></span></label>
                        <div class="marcas">
                            <label for="marcacrearanuncio"> <span></span></label>
                            <select class="marcacrearanuncio" name="marcacrearanuncio">
                                <option disabled value="" selected hidden>Elije una subcategoria antes</option>
                            </select>
                        </div>

                        <div class="modelos">
                            <label for="modelocrearanuncio"> <span></span></label>
                            <input list="modelocrearanuncio" name="modelo" class="modelo"
                                placeholder="Debe elegir una marca" autocomplete="off" style="width:150px;">
                            <datalist id="modelocrearanuncio" name="modelocrearanuncio" class="modelocrearanuncio">
                                <option disabled selected>Debe elegir una marca</option>
                            </datalist>
                        </div>
                        <div class="año">
                            <label for="fabricacioncrearanuncio"> <span></span></label>
                            <input type="number" name="fabricacioncrearanuncio" class="fabricacioncrearanuncio"
                                placeholder="Año" maxlength="4" min="1990" max="2019">
                        </div>
                    </div>
                </div>

                <div class="tipo-detalles">
                    <label for="tipo-detalles">Tipo / Detalles<span></span></label>
                    <div class="tipo-categoria-detalles">
                        <label for="tipomodelocrearanuncio"> <span></span></label>
                        <select name="tipomodelocrearanuncio" class="tipomodelo">
                            <option value="" disabled selected>Tipo...</option>
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
                            <option value="" disabled selected>Combustible...</option>
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
                            <option value="" disabled selected>Transmisión...</option>
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
                        <input type="number" name="kilometraje" id="kilometraje" class="kilometraje"
                            placeholder="Kilometraje" autocomplete="off" maxlength="10">
                    </div>
                </div>

                <div class="ubicacion">
                    <label for="ubicacioncrearanuncio">Ubicacion<span></span></label>
                    <div class="ubicaciondepartamento">
                        <label for="ubicacioncrearanuncio"> <span></span></label>
                        <select name="ubicacioncrearanunciodep" class="ubicacioncrearanunciodep" required>
                            <option disabled value="" selected hidden>--Departamento--</option>
                        </select>
                    </div>
                    <div class="ubicacionprovincia">
                        <label for="ubicacioncrearanuncio"> <span></span></label>
                        <select name="ubicacioncrearanuncioprov" class="ubicacioncrearanuncioprov" required>
                            <option disabled value="" selected hidden>--Provincia--</option>
                        </select>
                        <!-- <img src="vista/modulos/ajax-loader.gif" id="loding1"></img> -->
                    </div>
                    <div class="ubicaciondistrito">
                        <label for="ubicacioncrearanuncio"> <span></span></label>
                        <select name="ubicacioncrearanunciodis" class="ubicacioncrearanunciodis" required>
                            <option disabled value="" selected hidden>--Distrito--</option>
                        </select>
                        <!-- <img src="vista/modulos/ajax-loader.gif" id="loding2"></img> -->
                    </div>
                </div>

                <div class="titulo">
                    <label for="titulocrearanuncio">Titulo<span></span></label>
                    <input type="text" placeholder="Escriba el titulo de su anuncio" name="titulocrearanuncio"
                        id="titulocrearanuncio" required>
                </div>

                <div class="descripcion">
                    <label for="descripcioncrearanuncio">Descripcion<span></span></label>
                    <textarea name="descripcioncrearanuncio" id="descripcioncrearanuncio"
                        placeholder="Escriba una descripcion de su anuncio" required></textarea>
                </div>

                <div class="imagen">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                    <label for="imagencrearanuncio">Subir imagen<span></span></label>
                    <input type="file" name="nombreimagen[]" class="btn btn-default" id="gallery-photo-add"
                        accept="image/*" multiple>
                    <p>Tamaño recomendado: 800px * 400px, peso máximo 2MB</p>
                    <div id="arrastreImagenArticulo">
                    </div>
                    <div class="gallery">
                        <ul class="reorder-gallery">
                        </ul>
                    </div>
                </div>

                <div class="celular">
                    <label for="celularcrearanuncio">Tel. Contacto<span></span></label>
                    <input type="text" placeholder="Ingrese el numero de su celular" name="celularcrearanuncio"
                        id="celularcrearanuncio" required="">
                </div>

                <div class="tipomoneda">
                    <label for="tipomonedacrearanuncio">Tipo de moneda<span></span></label>
                    <select name="tipomonedacrearanuncio">
                        <option value="S/.">S/.</option>
                        <option value="$">$</option>
                        <option value="€">€</option>
                    </select>
                </div>
                <div class="precio">
                    <label for="preciocrearanuncio">Precio<span></span></label>
                    <input type="number" min="0" step="0.01" placeholder="Ingrese el precio de su anuncio"
                        name="preciocrearanuncio" id="preciocrearanuncio" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
			     event.charCode == 44 || event.charCode == 0" data-number-to-fixed="2" data-number-stepfactor="100" required>
                    <select name="preciotipocrearanuncio">
                        <option value="Negociable">Negociable</option>
                        <option value="No negociable">No negociable</option>
                    </select>
                </div>

                <div class="enviar">
                    <input type="submit" id="guardaranuncio" name="guardaranuncio" value="Guardar anuncio"
                        class="btn btn-primary">
                </div>

            </form>
        </div>
        <?php GestorAnunciosController::guardarClasificadoController(); ?>
        <div id="consejos">
            <h3>
                Algunos Consejos
            </h3>
            <p class="lead" style="font-size: 16px;">
                Publicar y vender en Anegociar es muy simple, pero si sigues estos consejos, tendrás aún más chances de
                vender rápido:
            </p>
            <ul>
                <li>
                    <b>¡Las fotos hablan por si solas!</b><br>
                    Un anuncio con fotos recibe hasta 5 veces mas visitas.
                </li>
                <li>
                    <b>¡El precio vende!</b> <br>
                    Introduce el precio correcto de tu producto. Si no sabes cuánto pedir por el mismo, te recomendamos
                    buscar productos similares.
                </li>
                <li>
                    <b>¡El título atrae!</b> <br>
                    Incluye información relevante en el mismo. Los datos infaltables en un buen título son: tipo de
                    producto, marca, modelo.
                </li>
                <li>
                    <b>¡La descripción cuenta la historia de tu producto!</b><br>
                    Indica todas las características de tu producto: si es usado, si es nuevo, en qué estado se
                    encuentra, qué accesorios trae, etc.
                </li>
            </ul>
        </div>
        <?php
        if (isset($_GET["action"])) {
            if ($_GET["action"] == "clasificado_exitoso") {
                echo "Clasificado Exitoso si se guarda";
            }
        } ?>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="vista/temas/js/cambiar.js"></script>

        <!-- listado de categorias -->
        <script type="text/javascript">
        $(document).ready(function() {
            $("#loding1").hide();
            $("#loding2").hide();
            $(".marca-modelo").hide();
            $(".categoriacrearanuncio").each(function() {
                $("#loding1").show();
                var nombre_categoria = $(this).val();
                var dataString = 'nombre_categoria=' + nombre_categoria;

                if (nombre_categoria === 'vehiculos') {
                    $('.marca-modelo').show();
                    $('.marcas').show();
                    $('.modelos').show();
                }
                if (nombre_categoria != 'vehiculos') {
                    $(".marca-modelo").hide();
                    $(".marcas").hide();
                    $(".modelos").hide();
                }
                // $(".subcategoriacrearanuncio").find('option').remove();
                // mostrar subcategorias
                $.ajax({
                    type: "POST",
                    url: "vista/modulos/ajax/ajax.php?op=mostrarSubCategoria",
                    data: dataString,
                    cache: false,
                    success: function(response) {
                        respuesta = JSON.parse(response);
                        $.each(respuesta, function(key, value) {
                            $("#loding1").hide();
                            $(".subcategoriacrearanuncio").append(
                                '<option value="' + value.idsubcategoria +
                                '">' + value.nombre_subcategoria + '</option>');
                        });
                    }
                });
            }); //fin de subcategorias

            //mostrar marcas
            $(".subcategoriacrearanuncio").change(function() {
                $("#loding2").show();
                var id = $(this).val();
                var dataString = 'id=' + id;
                // $(".marcacrearanuncio").find('option').remove();
                $.ajax({
                    type: "POST",
                    url: "vista/modulos/ajax/ajax.php?op=mostrarMarcas",
                    data: dataString,
                    cache: false,
                    success: function(response) {
                        respuesta = JSON.parse(response);
                        $.each(respuesta, function(key, value) {
                            $("#loding2").hide();
                            $(".marcacrearanuncio").append('<option value="' + value
                                .idmarca + '">' + value.nombre_marca +
                                '</option>');
                        });
                    }
                });
            }); //fin de mostrar marcas

            //mostrar modelo segun marca
            $(".marcacrearanuncio").change(function() {
                $("marcacrearanuncio").show();
                var id = $(this).val();
                var dataString = 'id=' + id;
                // $('.modelo').find('input:text').val('');
                // $(".modelocrearanuncio").find('option').remove();
                // $(".modelo").val(" ");
                $(".modelo").attr("placeholder", "Escribe o selecciona").val("").focus().blur();
                console.log(dataString);
                $.ajax({
                    type: "POST",
                    url: "vista/modulos/ajax/ajax.php?op=mostrarModelos",
                    data: dataString,
                    cache: false,
                    success: function(response) {
                        respuesta = JSON.parse(response);
                        $.each(respuesta, function(key, value) {
                            $("#modelocrearanuncio").append('<option value="' +
                                value.nombre_modelo + '" >' + value
                                .nombre_modelo + '</option>');
                        });
                        console.log(respuesta);
                    }
                });
            }); // fin de segun marca


        });
        </script>

        <script type="text/javascript">
        $(function() {
            var imagesPreview = function(input, placeToInsertImagePreview) {
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(
                                placeToInsertImagePreview);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };
            $('#gallery-photo-add').on('change', function() {
                imagesPreview(this, 'div.gallery');
            });
        });
        </script>

        <!-- validacion de descripcion del anuncio -->
        <script type="text/javascript">
        // Get reference to textbox
        var input = document.getElementById("descripcionrevistacrearanuncio");

        // Add event handler for event that can be cancelled and prevent excessive data
        // from ever getting into the textbox
        input.addEventListener("keypress", function(evt) {

            // Get value of textbox and split into array where there is one or more continous spaces
            const words = this.value.split(/\s+/);

            // Get # of words in array
            const numWords = words.length;

            const maxWords = 10;

            // If we are at the limit and the key pressed wasn't BACKSPACE or DELETE,
            // don't allow any more input
            if (numWords > maxWords) {
                evt.preventDefault(); // Cancel event
            }
        });
        </script>

        <!-- lista ubicaciones -->
        <script type="text/javascript">
        $(document).ready(function() {
            // cargar los departamentos
            $.ajax({
                type: "GET",
                url: 'vista/modulos/ajax/ajax.php?op=listarDepartamentos',
                cache: false,
                success: function(response) {
                    const respuesta = JSON.parse(response);
                    $.each(respuesta, function(key, value) {
                        $('.ubicacioncrearanunciodep').append("<option value='" + value
                            .iddepartamento + "' >" + value.nombredepartamento +
                            "</option>")
                    });
                }
            });
            // fin
            $("#loding1").hide();
            $("#loding2").hide();
            // cargar provincias
            $(".ubicacioncrearanunciodep").change(function() {
                $("#loding1").show();
                var id = $(this).val();
                var dataString = 'id=' + id;
                //$(".ubicacioncrearanunciop").find('option').remove();
                //$(".ubicacioncrearanunciod").find('option').remove();
                $.ajax({
                    type: "POST",
                    url: "vista/modulos/ajax/ajax.php?op=listarProvincias",
                    data: dataString,
                    cache: false,
                    success: function(response) {
                        respuesta = JSON.parse(response);
                        $.each(respuesta, function(key, value) {
                            $("#loding2").hide();
                            $(".ubicacioncrearanuncioprov").append(
                                "<option value='" + value.idprovincia + "' >" +
                                value.nombreprovincia + "</option>")
                        });
                    }
                });
            }); // fin provincias
            // cargar distritos
            $(".ubicacioncrearanuncioprov").change(function() {
                $("#loding2").show();
                var id = $(this).val();
                var dataString = 'id=' + id;

                $.ajax({
                    type: "POST",
                    url: "vista/modulos/ajax/ajax.php?op=listarDistritos",
                    data: dataString,
                    cache: false,
                    success: function(response) {
                        respuesta = JSON.parse(response);
                        $.each(respuesta, function(key, value) {
                            $("#loding2").hide();
                            $(".ubicacioncrearanunciodis").append(
                                "<option value='" + value.iddistrito + "' >" +
                                value.nombredistrito + "</option>")
                        });
                    }
                });
            }); //fin distritos

        });
        </script>