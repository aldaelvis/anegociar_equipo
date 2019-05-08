<?php
ob_start();
header_remove("Expires");
header_remove("Cache-Control");
header_remove("Pragma");
header_remove("Last-Modified");
session_start();
if (!$_SESSION["user-usuario"]) {
    echo '
  			<div id="bloque-contenido-crear-clasificados">
				<div class="bloque-contenido-crear-clasificados">
	  				<div id="crear-anuncio">
					<h1>Crear Anuncio</h1>
					<div class="crear-anuncio-ingreso-registro">
						<h2>Un momento...</h2>
						<h3>Es necesario que tenga una cuenta en Anegociar para continuar.</h3>
						<div class="crear-anuncio-ingreso">
							<p>Si ya tiene una cuenta</p>
							<a href="ingreso" class="btn btn-success"><i class="fa fa-user" aria-hidden="true"></i> Ingresar</a>
						</div>
						<div class="crear-anuncio-registro">
							<p>Si aun no tiene una cuenta</p>
							<a href="registro" class="btn btn-success"><i class="fa fa-user" aria-hidden="true"></i> Registar</a>
						</div>
					</div>
				</div>
			<div id="consejos">
				<h3>Algunos Consejos</h3>
				<p class="lead" style="font-size: 16px;">
					Publicar y vender en Anegociar es muy simple, pero si sigues estos consejos, tendrás aún más chances de vender rápido:
				</p>
				<ul>
					<li>
						<b>¡Las fotos hablan por si solas!</b><br>
							Un anuncio con fotos recibe hasta 5 veces mas visitas. 
					</li>
					<li>
						<b>¡El precio vende!</b> <br>
							Introduce el precio correcto de tu producto. Si no sabes cuánto pedir por el mismo, te recomendamos buscar productos similares.
					</li>
					<li>
						<b>¡El título atrae!</b> <br>
							Incluye información relevante en el mismo. Los datos infaltables en un buen título son: tipo de producto, marca, modelo.
					</li>
					<li>
						<b>¡La descripción cuenta la historia de tu producto!</b><br>
							Indica todas las características de tu producto: si es usado, si es nuevo, en qué estado se encuentra, qué accesorios trae, etc.
					</li>					
				</ul>
			</div>
							</div>
			</div>
			';
    include "vista/temas/footer.php";
    exit();
} else {
    #echo $_SESSION["idusuario"];
}
?>

<div id="bloque-contenido-crear-clasificados">
    <div class="bloque-contenido-crear-clasificados">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <!-- CHANGE THE JQUERY FILE DEPENDING ON THE VERSION YOU HAVE DOWNLOADED -->
        <script src="vista/temas/js/cambiar.js"></script>

        <div id="crear-anuncio">
            <h1>Crear anuncio</h1>
            <form method="post" enctype="multipart/form-data">
                <div class="ubicacion">
                    <div class="ubicacion">
                        <label for="ubicacioncrearanuncio">Ubicacion<span></span></label>
                        <div class="ubicaciondepartamento">
                            <label for="ubicacioncrearanuncio"> <span></span></label>
                            <select id="ubicacioncrearanunciodep" name="ubicacioncrearanunciodep"
                                class="ubicacioncrearanunciodep" required>
                                <option disabled value="0" selected>Departamento</option>
                            </select>
                        </div>
                        <div class="ubicacionprovincia">
                            <label for="ubicacioncrearanuncio"> <span></span></label>
                            <select name="ubicacioncrearanuncioprov" class="ubicacioncrearanuncioprov" required>
                                <option value="0" selected>Provincia</option>
                            </select>
                            <!-- <img src="vista/modulos/ajax-loader.gif" id="loding1"></img> -->
                        </div>
                        <div class="ubicaciondistrito">
                            <label for="ubicacioncrearanuncio"> <span></span></label>
                            <select name="ubicacioncrearanunciodis" id="ubicacioncrearanunciodis"
                                class="ubicacioncrearanunciodis" required>
                                <option value="0" selected>Distrito</option>
                            </select>
                            <!-- <img src="vista/modulos/ajax-loader.gif" id="loding2"></img> -->
                        </div>
                    </div>
                </div>

                <div class="caracteristicas">
                    <label for="ubicacioncrearanuncio">Categorias<span></span></label>
                    <?php
                    include "lista_categorias.php";
                    ?>
                </div>

                <div id="show">
                    <!-- ITEMS TO BE DISPLAYED HERE -->
                </div>

                <div class="titulo">
                    <label for="titulocrearanuncio">Titulo<span></span></label>
                    <input type="text" placeholder="Escriba el titulo de su anuncio" name="titulocrearanuncio"
                        id="titulocrearanuncio" maxlength="65" required>
                </div>
                <div class="descripcion">
                    <label for="descripcioncrearanuncio">Descripcion<span></span></label>
                    <textarea name="descripcioncrearanuncio" id="descripcioncrearanuncio"
                        placeholder="Escriba una descripcion de su anuncio" maxlength="400"
                        onkeypress="if (this.value.length > 400) { return false; }" required></textarea>
                </div>
                <script>
                $(document).ready(function() {
                    $("#descripcionrevistacrearanuncio").on('keydown', function(e) {
                        var words = $.trim(this.value).length ? this.value.match(/\S+/g).length : 0;
                        if (words <= 9) {
                            $('#display_count').text(words);
                            $('#word_left').text(10 - words)
                        } else {
                            if (e.which !== 12) e.preventDefault();
                        }
                    });
                });
                </script>
                <div class="descripcion-revista">
                    <label for="descripcionrevistacrearanuncio">Descripcion en revista<span></span></label>
                    <textarea name="descripcionrevistacrearanuncio" id="descripcionrevistacrearanuncio"
                        placeholder="Escriba una descripcion que saldra en la revista (Opcional)."></textarea>
                    <div class="contador palabras">
                        <span><br>(Opcional) Total palabras conteo</span> : <span id="display_count">0</span> palabras.
                        Palabras izuierda : <span id="word_left">10</span>
                    </div>
                </div>
                <div class="imagen">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                    <label for="imagencrearanuncio">Subir imagen<span></span></label>
                    <input type="file" name="nombreimagen[]" class="btn btn-default" id="gallery-photo-add"
                        accept="image/*" multiple required>
                    <p>Tamaño recomendado: 800px * 400px, peso máximo 2MB</p>
                    <div id="arrastreImagenArticulo">
                    </div>
                    <div class="gallery"></div>
                    <script type="text/javascript">
                    $(function() {
                        // Multiple images preview in browser
                        var imagesPreview = function(input, placeToInsertImagePreview) {

                            if (input.files) {
                                var filesAmount = input.files.length;

                                for (i = 0; i < filesAmount; i++) {
                                    var reader = new FileReader();

                                    reader.onload = function(event) {
                                        $($.parseHTML('<img>')).attr('src', event.target.result)
                                            .appendTo(placeToInsertImagePreview);
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
                    <!--<input type="text" placeholder="Ingrese el precio de su anuncio" name="tipomoneda" id="" required>-->
                </div>
                <div class="precio">
                    <label for="preciocrearanuncio">Precio<span></span></label>
                    <input type="number" step="any" placeholder="Ingrese el precio de su anuncio"
                        name="preciocrearanuncio" id="preciocrearanuncio" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
     event.charCode == 44 || event.charCode == 0 " required>
                    <select name="preciotipocrearanuncio">
                        <option value="No negociable">No negociable</option>
                        <option value="Negociable" selected="">Negociable</option>
                    </select>
                </div>

                <div class="enviar">
                    <input type="submit" id="guardaranuncio" name="guardaranuncio" value="Guardar anuncio"
                        class="btn btn-primary">
                </div>
            </form>
        </div>

        <?php

        $crearArticulo = new GestorAnunciosController();
        #$crearArticulo -> guardarImagenController();
        $crearArticulo->guardarArticuloController();
        ob_end_flush();
        ?>
        <div id="consejos">
            <h3>Algunos Consejos</h3>
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
                #header("location:usuario");

            }

        }
        ?>
        <!-- lista ubicaciones -->
        <script type="text/javascript">
        //Funciones
        async function cargarDepartamentos() {
            const url = 'vista/modulos/ajax/ajax.php?op=listarDepartamentos';
            const respuestaUrl = await fetch(url);
            const departamentos = await respuestaUrl.json()
            return {
                departamentos
            }
        }

        async function cargarProvincias(id) {
            const url = `vista/modulos/ajax/ajax.php?op=listarProvincias&id=${id}`;
            const respuestaUrl = await fetch(url);
            const provincias = await respuestaUrl.json();
            return {
                provincias
            }
        }

        async function cargarDistritos(id) {
            const url = `vista/modulos/ajax/ajax.php?op=listarDistritos&id=${id}`;
            const respuestaUrl = await fetch(url);
            const distritos = await respuestaUrl.json();
            return {
                distritos
            }
        }

        //.Funciones
        document.addEventListener('DOMContentLoaded', (evt) => {
            //Variables
            const selDepartamento = document.getElementById('ubicacioncrearanunciodep');
            const selProvincia = document.querySelector('.ubicacioncrearanuncioprov');
            const selDistrito = document.getElementById('ubicacioncrearanunciodis');
            //.Variables

            cargarDepartamentos().then(response => {
                const respuesta = response.departamentos;
                const selectDep = document.getElementById('ubicacioncrearanunciodep');
                respuesta.forEach(dep => {
                    const option = document.createElement('option');
                    option.value = dep.iddepartamento;
                    option.innerText = dep.nombredepartamento;
                    selectDep.appendChild(option);
                })
            });

            selDepartamento.addEventListener('change', (evt) => {
                const iddep = selDepartamento.options[selDepartamento.selectedIndex].value;
                if (selProvincia.options.length > 1) {
                    selProvincia.options.length = 1;
                    selProvincia.selectedIndex = 0;
                }
                cargarProvincias(iddep)
                    .then(response => {
                        const respuesta = response.provincias;
                        respuesta.forEach(prov => {
                            const option = document.createElement('option');
                            option.value = prov.idprovincia;
                            option.innerText = prov.nombreprovincia;
                            selProvincia.appendChild(option);
                        })
                    });
            });

            selProvincia.addEventListener('change', (evt) => {
                const idprov = selProvincia.options[selProvincia.selectedIndex].value;
                if (selDistrito.options.length > 1) {
                    selDistrito.options.length = 1;
                    selDistrito.selectedIndex = 0;
                }
                cargarDistritos(idprov)
                    .then(response => {
                        const respuesta = response.distritos;
                        respuesta.forEach(dist => {
                            const option = document.createElement('option');
                            option.value = dist.iddistrito;
                            option.innerText = dist.nombredistrito;
                            selDistrito.appendChild(option);
                        })
                    }).catch(error => console.log(error));
            });
        });
        </script>