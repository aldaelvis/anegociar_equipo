<?php
ob_start();
session_start();
if (!$_SESSION["user_agente"]) {
    header('location:ingreso');
}

if (isset($_POST['idclasificado']) && isset($_POST['categoria'])) {
    $_SESSION['IDCLASIFICADO'] = $_POST['idclasificado'];
    $_SESSION["cat"] = $_POST['categoria'];
}
?>
    <div id="app3">
        <div id="bloque-elije-plan-clasificado">
            <div class="bloque-elije-plan-clasificado">
                <?php
                if (!empty($_SESSION['cat'])) {
                    $capturaCategoria = $_SESSION["cat"];
                } else {
                    header('location:elije_tipo_anuncio');
                }
                $capturaCategoria = $_SESSION["cat"];
                ?>
                <div class="titulo-plan">
                    <div class="titulo">
                        <h1>Planes Revista (<?php echo $capturaCategoria; ?>)</h1>
                    </div>
                </div>
                <form method="post" action="elije_plan_anuncio">
                    <?php GestorPlanesController::mostrarPlanesController(); ?>
                    <h3>Preview de clasificado en la revista</h3>

                    <div class="mostrar" v-if="categoria === 'Vehiculos'">
                        <div class="mostrar-info" v-if="plan != 'GRATIS' ">
                            <div class="mostrar-info_titulo">
                                <span v-text="clasificado.titulo"></span>
                            </div>
                            <div class="mostrar-info_img" v-if="clasificado.nombreimagen != '' ">
                                <img width="150" height="150" v-if=" plan === 'PREMIUM' "
                                     :src="`../vista/imagenes/anuncios/${clasificado.nombreimagen}`">
                                <img width="150" height="150" v-if=" plan === 'DESTACADO' "
                                     :src="`../vista/imagenes/anuncios/${clasificado.nombreimagen}`">
                                <img width="150" height="150" class="imagen_simple" v-else-if=" plan === 'SIMPLE' "
                                     :src="`../vista/imagenes/anuncios/${clasificado.nombreimagen}`">
                            </div>
                            <div class="mostrar-info_float">
                                <span class="codigo"> Cod: {{ clasificado.cod_revista }}</span>
                                <span class="precio" v-text="clasificado.precio"></span>
                            </div>
                            <div class="mostrar-info_descripcion">
                                <span v-show="descripcion == '' " style="color: red;">Ingrese su descripción(*)</span>
                                <span v-show="error" style="color: red;">La cantidad de palabras excede al plan</span>
                                <textarea name="descripcion_revista" v-model="descripcion"
                                          @keyup="validarPalabras(descripcion)"
                                          style="width: 100%; height: 30px; resize: none; border: none;"></textarea>
                            </div>
                        </div>
                        <div class="mostrar-info_gratis" v-if="plan == 'GRATIS' ">
                            <span v-show="descripcion == '' " style="color: red;">Ingrese su descripción(*)</span>
                            <span v-show="error" style="color: red;">La cantidad de palabras excede al plan</span>
                            <textarea name="descripcion_revista" v-model="descripcion" @keyup="validarPalabras(descripcion)"
                                      style="width: 100%; height: 40px; resize: none; border: none;"></textarea>
                        </div>
                    </div>

                    <div class="mostrar" v-if="categoria != 'Vehiculos'">
                        <div class="mostrar-info" v-if="plan == 'PREMIUM' ">
                            <div class="mostrar-info_titulo">
                                <span v-text="clasificado.titulo"></span>
                            </div>
                            <div class="mostrar-info_img" v-if="clasificado.nombreimagen != '' ">
                                <img width="150" height="150" v-if=" plan === 'PREMIUM' "
                                     :src="`../vista/imagenes/anuncios/${clasificado.nombreimagen}`">
                            </div>
                            <div class="mostrar-info_float">
                                <span class="codigo"> Cod: {{ clasificado.cod_revista }}</span>
                                <span class="precio" v-text="clasificado.precio"></span>
                            </div>
                            <div class="mostrar-info_descripcion">
                                <span v-show="descripcion == '' " style="color: red;">Ingrese su descripción(*)</span>
                                <span v-show="error" style="color: red;">La cantidad de palabras excede al plan</span>
                                <textarea name="descripcion_revista" v-model="descripcion"
                                          @keyup="validarPalabras(descripcion)"
                                          style="width: 100%; height: 30px; resize: none; border: none;"></textarea>
                            </div>
                        </div>

                        <div class="mostrar-info_inmueble-destacado" v-if="plan == 'DESTACADO' ">
                            <span v-show="descripcion == '' " style="color: red;">Ingrese su descripción(*)</span>
                            <span v-show="error" style="color: red;">La cantidad de palabras excede al plan</span>
                            <div class="cuadro_destacado">
                                <textarea name="descripcion_revista" v-model="descripcion"
                                          style="width: 99%; height: 200px; resize: none; border: none; font-size: 20px;"></textarea>
                            </div>
                        </div>

                        <div class="mostrar-info_gratis" v-if="plan == 'SIMPLE' ">
                            <span v-show="descripcion == '' " style="color: red;">Ingrese su descripción(*)</span>
                            <span v-show="error" style="color: red;">La cantidad de palabras excede al plan</span>
                            <textarea name="descripcion_revista" v-model="descripcion" @keyup="validarPalabras(descripcion)"
                                      style="width: 100%; height: 100px; resize: none; border: none;"></textarea>
                        </div>

                        <div class="mostrar-info_gratis" v-if="plan == 'GRATIS' ">
                            <span v-show="descripcion == '' " style="color: red;">Ingrese su descripción(*)</span>
                            <span v-show="error" style="color: red;">La cantidad de palabras excede al plan</span>
                            <textarea name="descripcion_revista" v-model="descripcion" @keyup="validarPalabras(descripcion)"
                                      style="width: 100%; height: 40px; resize: none; border: none;"></textarea>
                        </div>

                    </div>
                    <div>
                        <button v-if="!error" type="submit" name="enviar_plan" class="btn-link">Continuar</button>
                    </div>
                </form>
                <!-- <template v-if="nodeseoweb == true"> -->
                <?php GestorPlanesController::activarClasificadoController(); ?>
            </div>
        </div>
    </div>

    <script>
        const mv = new Vue({
            el: '#app3',
            data: {
                clasificado: [],
                nodeseoweb: false,
                mensajeError: '',
                error: false,
                categoria: '<?php echo ucwords($_SESSION['cat']); ?>',
                plan: 'PREMIUM',

                descripcion: '',
                cant_letras: 0
            },

            methods: {
                listarClasificado() {
                    let me = this;
                    axios.get('vista/modulos/ajax/ajax.php?op=mostrarPreviewClasificado')
                        .then(function (response) {
                            me.clasificado = response.data;
                        }).catch(error => {
                        console.log(error);
                    });
                },

                validarPalabras(campo) {
                    let me = this;
                    let textoDividido = campo.split(" ");
                    if (me.plan == 'GRATIS') {
                        textoDividido.length > 10 ? me.error = true : me.error = false;
                    } else if (me.plan == 'SIMPLE') {
                        textoDividido.length > 15 ? me.error = true : me.error = false;
                    }
                },
            },

            mounted() {
                this.listarClasificado();
            }
        });
    </script>

<?php ob_end_flush(); ?>