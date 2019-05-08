<?php
ob_start();
session_start();
header("Cache-Control: no cache");
session_cache_limiter("private_no_expire");
if (!$_SESSION["user_colaborador"]) {
    #echo "inisice session";
    header('location:ingreso');
} else {
}

if (isset($_POST['cat'])) {
    $_SESSION['cat'] = $_POST['cat'];
} else {
    header('location:elije_tipo_anuncio');
}

$capturaCategoria = $_POST["cat"];
?>
<div id="bloque-elije-plan-clasificado">
    <div class="bloque-elije-plan-clasificado">
        <div id="app">
            <div v-if="mensajeError.lenght !=0 " v-bind:class="{ error: error }">
                <h3 v-text="mensajeError"></h3>
            </div>
            <form method="post" action="crear_anuncio">
                <input type="checkbox" v-model="nodeseoweb" value="" @click="limpiar()">No deseo este plan
                <h1>Planes Web (<?php echo $capturaCategoria; ?>)</h1>
                <div class="planes-anuncio" v-for="planweb in arrayPlanesWeb" v-bind:class="{ nodeseo: nodeseoweb }">
                    <div class="categoria-plan"><h1 v-text="planweb.categoria_plan_web"></h1></div>
                    <div class="nombre-plan"><h2 v-text="planweb.nombre_plan_web">GRATIS</h2></div>
                    <div class="precio-plan"><h3>s/.<span v-text="planweb.precio_plan_web"></span></h3></div>
                    <div class="descripcion-plan" v-text="planweb.descripcion_plan_web">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde error consequatur suscipit nihil
                        non maxime, ab magni excepturi, commodi alias quo adipisci corporis architecto rem. Maxime
                        velit, dolore aliquam voluptate.
                        <ul>
                        </ul>
                    </div>
                    <div class="enlace-crear-anuncio">
                        <input type="radio" name="planSeleccionadoWeb" :value="planweb.nombre_plan_web"
                               :disabled="nodeseoweb" v-bind:checked="!nodeseoweb">
                    </div>
                </div>
                <input type="checkbox" v-model="nodeseorevista" name="nodeseorevista" @click="limpiar()">No deseo este
                plan
                <h1>Planes Revista (<?php echo $capturaCategoria; ?>)</h1>
                <div class="planes-anuncio" v-for="planrevista in arrayPlanesRevista"
                     v-bind:class="{ nodeseo: nodeseorevista }">
                    <div class="categoria-plan" v-text="planrevista.categoria_plan_revista"><h1>VEHICULOS</h1></div>
                    <div class="nombre-plan"><h2 v-text="planrevista.nombre_plan_revista">GRATIS</h2></div>
                    <div class="precio-plan"><h3>s/.<span v-text="planrevista.precio_plan_revista"></span></h3></div>
                    <div class="descripcion-plan" v-text="planrevista.descripcion_plan_revista">
                        <ul>
                        </ul>
                    </div>
                    <div class="enlace-crear-anuncio">
                        <input type="radio" name="planSeleccionadoRevista" :disabled="nodeseorevista"
                               v-bind:checked="!nodeseorevista" :value="planrevista.nombre_plan_revista">
                    </div>
                </div>
                <button type="submit" name="cat-plan" value="<?php echo $capturaCategoria; ?>" class="btn-link" v-if="verificarPlan()">
                    Continuar
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    new Vue({
        el: '#app',
        data: {
            arrayPlanesWeb: [],
            arrayPlanesRevista: [],
            nodeseoweb: false,
            nodeseorevista: false,
            planSeleccionadoWeb: '',
            mensajeError: '',
            error: false,
        },
        methods: {
            listarPlanesWeb: function () {
                let me = this;
                axios.get('vista/modulos/ajax/ajax.php?op=planesWeb')
                    .then(function (response) {
                        me.arrayPlanesWeb = response.data;
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            },

            listarPlanesRevista: function () {
                let me = this;
                axios.get('vista/modulos/ajax/ajax.php?op=planesRevista')
                    .then(function (response) {
                        me.arrayPlanesRevista = response.data;
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            },

            verificarPlan: function(){
                let me = this;
                if(me.nodeseoweb && me.nodeseorevista){
                    me.mensajeError = 'Debe de seleccionar al menos un plan.';
                    me.error = true;
                    return false;
                }else {
                    me.mensajeError = '';
                    me.error = false;
                    return true;
                }
            },
            limpiar: function(){
                planSeleccionadoWeb = '';

            },
        },
        mounted() {
            this.listarPlanesWeb();
            this.listarPlanesRevista();
            this.limpiar();
        }
    });
</script>

<style>
    .nodeseo {
        background: #4E4D4D;
    }

    .error {
        margin-top: 16px;
        background: #F2DEDE;
        color: #B94A48;
        border-radius: 3px;
        padding: 5px;
    }
</style>
<?php
ob_end_flush();
?>

