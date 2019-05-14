<?php
ob_start();
session_start();
if (!$_SESSION["user_concesionaria"]) {
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
                        <h2>Selecione un plan web</h2>
                    </div>
                </div>
                <form method="post" action="elije_plan_anuncio">
                    <?php GestorPlanesController::mostrarPlanesController(); ?>
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