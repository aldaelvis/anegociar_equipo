<?php
session_start();

if (!$_SESSION["user_concesionaria"]) {
    header("location:ingresar");
    exit();
}
?>
<!--comienzo app vue-->
<div id="app2">
    <div id="bloque-contenido-usuarios">
        <h1 class="page-title">Últimas <span style="color: #2196F3;">Publicaciones</span></h1>
        <div class="bloque-contenido-usuario-clasifiados">
            <div class="bloque-usuario-clasifiados">
                <h2>Tus ultimas publicaciones</h2>
                <div class="buscador-contenedor">
                    <label for="">Buscar Publicación</label>
                    <input type="text" class="buscador" v-model="buscar" @keyup="listarClasificados(1, buscar)"
                           placeholder="Buscar publicación...">
                </div>
                <div class="bloque-lista-clasificados" v-for="clasificado in arrayClasificado">
                    <div class="lista-clasificados-campos">
                        <div class="campo-imagen">
                            <a :href="'index.php?action=ver_clasificado&id='+clasificado.idclasificado">
                                <img width="200" height="150" v-if="clasificado.nombreimagen != '' "
                                     :src="`../vista/imagenes/anuncios/${clasificado.nombreimagen}`">
                                <img width="300" height="150" v-else alt="No hay Imagen" :src="`../vista/imagenes/anuncios/logo.png`">
                            </a>
                        </div>
                        <div class="campo-titulo">
                            <a :href="'index.php?action=ver_clasificado&id='+clasificado.idclasificado">
                                <h4 v-text="clasificado.titulo"></h4>
                            </a>
                        </div>
                        <div class="campo-codigo-revista">
                            <a :href="'index.php?action=ver_clasificado&id='+clasificado.idclasificado">
                                <i class="far fa-newspaper"></i>&nbsp; Cod. Revista: <b
                                        v-text="clasificado.cod_revista"></b>
                            </a>
                        </div>
                        <div class="campo-tipo-moneda">
                            <a :href="'index.php?action=ver_clasificado&id='+clasificado.idclasificado">
                                <p v-text="clasificado.tipo_moneda"></p>
                            </a>
                        </div>
                        <div class="campo-precio">
                            <a :href="'index.php?action=ver_clasificado&id='+clasificado.idclasificado">
                                <p v-text="clasificado.precio"></p>
                            </a>
                        </div>
                        <div class="campo-precio-condicion">
                            <a :href="'index.php?action=ver_clasificado&id='+clasificado.idclasificado">
                                <p><span v-text="clasificado.precio_tipo"></span></p>
                            </a>
                        </div>
                        <div class="campo-descripcion">
                            <a :href="'index.php?action=ver_clasificado&id='+clasificado.idclasificado">
                                <p>{{ clasificado.descripcion.substring(0,200) }}</p>
                            </a>
                        </div>
                        <div class="campo-fecha-creacion">
                            <a :href="'index.php?action=ver_clasificado&id='+clasificado.idclasificado">
                                <p>Publicado: Hace 1 semana <span v-text="clasificado.fechacreacion"></span></p>
                            </a>

                            <a href="#pop2">
                                <button @click="abrirModal(clasificado)" class="btn active-modal">Editar</button>
                            </a>
                            <template v-if="clasificado.estado == 1 ">
                                <button class="btn btn-desactivar" type="button"
                                        @click="desactivarClasificado(isActive, clasificado.idclasificado)">Desactivar
                                </button>
                            </template>
                            <template v-if="clasificado.estado == 0 ">
                                <button class="btn btn-activar" type="button"
                                        @click="activarClasificado(isActive, clasificado.idclasificado)">Activar
                                </button>
                            </template>

                        </div>
                    </div>
                </div>
                <!-- paginación -->
                <ul class="paginacion">
                    <li class="page-item" v-if="paginacion.current_page > 1">
                        <a class="page-link" href="#"
                           @click.prevent="cambiarPagina(paginacion.current_page - 1, buscar)">Ant</a>
                    </li>
                    <li class="page-item" v-for="page in pageNumber" :key="page"
                        :class="[page == isActive ? 'active' : '']">
                        <a class="page-link" href="#" @click.prevent="cambiarPagina(page, buscar)" v-text="page"></a>
                    </li>
                    <li class="page-item" v-if="paginacion.current_page < paginacion.last_page">
                        <a class="page-link" href="#"
                           @click.prevent="cambiarPagina(paginacion.current_page +1, buscar)">Sig</a>
                    </li>
                </ul>
                <!-- fin de paginación -->
            </div>
        </div>
    </div>

    <!--modal-->
    <div id="pop2" class="pop-up">
        <div class="popBox">
            <div class="popScroll">
                <div>
                    <h3>Editar Anuncio</h3>
                    <form method="post" enctype="multipart/form-data" action="" class="form-modal">
                        <div class="titulo">
                            <label for="titulocrearanuncio">Titulo<span></span></label>
                            <div class="form-group">
                                <input v-model="objecto.titulo" type="text"
                                       placeholder="Escriba el titulo de su anuncio"
                                       required>
                            </div>

                        </div>
                        <div class="descripcion">
                            <label for="descripcioncrearanuncio">Descripcion<span></span></label>
                            <div class="form-group">
                                <textarea v-model="objecto.descripcion" placeholder="Escriba una descripcion de su anuncio"
                                          required></textarea>
                            </div>

                        </div>

                        <div class="imagen">
                            <label for="imagencrearanuncio">Subir imagen<span></span></label>
                            <div class="form-group">
                                <input type="file" class="btn btn-default" id="gallery-photo-add" accept="image/*" multiple
                                       required>
                                <input type="hidden" v-model="objecto.imagen_actual">
                                <p>Tamaño recomendado: 800px * 400px, peso máximo 2MB</p>
                                <div id="arrastreImagenArticulo">
                                </div>
                                <div class="gallery">
                                    <img :src="`../vista/imagenes/anuncios/${objecto.nombreimagen}`">
                                </div>
                            </div>
                        </div>
                        <div class="celular">
                            <label for="celularcrearanuncio">Tel. Contacto<span></span></label>
                            <div class="form-group">
                                <input type="text" placeholder="Ingrese el numero de su celular" v-model="objecto.celular"
                                       required>
                            </div>
                        </div>
                        <div class="tipomoneda">
                            <label for="tipomonedacrearanuncio">Tipo de moneda<span></span></label>
                            <div class="form-group">
                                <select name="tipomonedacrearanuncio" v-model="objecto.tipo_moneda">
                                    <option  disabled value="" selected hidden>Elige tipo de moneda</option>
                                    <option value="S/.">S/.</option>
                                    <option value="$">$</option>
                                    <option value="€">€</option>
                                </select>
                            </div>
                        </div>
                        <div class="precio">
                            <label for="preciocrearanuncio">Precio<span></span></label>
                            <div class="form-group">
                                <input type="number" min="0" step="0.01" placeholder="Ingrese el precio de su anuncio"
                                       v-model="objecto.precio" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
		event.charCode == 44 || event.charCode == 0" data-number-to-fixed="2" data-number-stepfactor="100" required>
                                <select name="preciotipocrearanuncio" v-model="objecto.precio_tipo">
                                    <option disabled value="" selected hidden>Elije uno</option>
                                    <option value="Negociable">Negociable</option>
                                    <option value="No negociable">No negociable</option>
                                </select>
                            </div>

                        </div>
                        <button type="button" @click="editarClasificado(isActive)" class="btn-guardar"> Editar Clasificado</button>
                    </form>
                </div>
            </div>
            <a href="#links" class="close"><span>Close</span></span></a>
        </div>
        <a href="#links" class="lightbox">Back to links</a>
    </div>
    <!--fin del modal-->
</div>
<!--fin del app vue-->

<script>
    new Vue({
        el: '#app2',
        data: {
            arrayClasificado: [],
            buscar: '',
            modal: 0,
            objecto: {
                idclasificado: 0,
                titulo: '',
                descripcion: '',
                nombreimagen: '',
                imagen_actual: '',
                celular: '',
                tipo_moneda: '',
                precio: 0.0,
                precio_tipo: ''
            },
            paginacion: {
                'total': 0,
                'current_page': 0,
                'per_page': 0,
                'last_page': 0,
                'from': 0,
                'to': 0
            },
            offset: 3,
        },
        computed: {
            isActive: function () {
                return this.paginacion.current_page;
            },

            pageNumber: function () {
                if (!this.paginacion.to) {
                    return [];
                }
                var from = this.paginacion.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if (to >= this.paginacion.last_page) {
                    to = this.paginacion.last_page;
                }
                var pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            },

        },
        methods: {
            listarClasificados: function (page, buscar) {
                let me = this;
                axios.get('vista/modulos/ajax/ajax.php?op=listarPublicaciones&page=' + page + '&buscar=' + buscar)
                    .then(function (response) {
                        var respuesta = response.data;
                        me.arrayClasificado = respuesta.datos;
                        me.paginacion = respuesta.paginacion;
                    }).catch(function (error) {
                    console.error(error);
                });
            },

            editarClasificado: function (page) {
                let me = this;
                var formData = new FormData();
                for (var key in this.objecto) {
                    formData.append(key, this.objecto[key]);
                }
                axios.post('vista/modulos/ajax/ajax.php?op=editarClasificado', formData)
                    .then(function (response) {
                        console.log(response.data);
                        me.listarClasificados(page, '');
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },

            activarClasificado: function (page, id) {
                let me = this;
                axios.get('vista/modulos/ajax/ajax.php?op=activarClasificado&id=' + id)
                    .then(function (response) {
                        me.listarClasificados(page, '');
                    }).catch(function (error) {
                    console.error(error);
                })
            },

            desactivarClasificado: function (page, id) {
                let me = this;
                axios.get('vista/modulos/ajax/ajax.php?op=desactivarClasificado&id=' + id)
                    .then(function (response) {
                        me.listarClasificados(page, '');
                    }).catch(function (error) {
                    console.error(error);
                })
            },

            abrirModal: function (data) {
                let me = this;
                me.objecto.idclasificado = data.idclasificado;
                me.objecto.titulo = data.titulo;
                me.objecto.descripcion = data.descripcion;
                me.objecto.nombreimagen = data.nombreimagen;
                me.objecto.imagen_actual = data.nombreimagen;
                me.objecto.celular = data.celular;
                me.objecto.tipo_moneda = data.tipo_moneda;
                me.objecto.precio = data.precio;
                me.objecto.precio_tipo = data.precio_tipo;
            },

            cambiarPagina: function (page, buscar) {
                let me = this;
                me.paginacion.current_page = page;
                me.listarClasificados(page, buscar);
            }
        },
        mounted() {
            this.listarClasificados(1, this.buscar);
        }
    });
</script>
<style>
    .buscador-contenedor {
        display: flex;
        width: 100%;
        align-content: center;
        align-items: center;
    }
    .buscador-contenedor label {
        font-weight: 700;
        font-size: 14px;
    }
    .buscador {
        width: 80%;
        padding: 6px 12px;
        border: 1px solid #d2d6de;
        margin: 15px 0px;

    }
    .buscador:focus{
        outline: 0;
        border-color: #3c8dbc;
        box-shadow: none;
    }
    .btn {
        margin-top: 6px;
        border: none;
        color: #fff;
        background: none;
        cursor: pointer;
        padding: 5px;
        border-radius: 3px;
        width: 100px;
    }

    .btn-activar {
        background: #53A853;
    }

    .btn-desactivar {
        background: #C83F39;
    }

    .active-modal {
        width: 100px;
        background: #337AB7;
    }

    /*inicio del modal*/
    .pop-up {
        position: fixed;
        top: 0;
        left: -500em;

        /*new*/
        pointer-events: none;
    }

    .pop-up:target {
        /*position: static;*/
        left: 0;
        opacity: 1;

        /*new*/
        pointer-events: auto;
    }

    .popBox {
        background-color: #fff;
        position: absolute;
        left: 15%;
        right: 15%;
        top: 10%;
        bottom: 30%;
        z-index: 6;
        border: 1px solid #3a3a3a;
        border-radius: 5px;
        box-shadow: 0 0.5rem 0.5rem rgba(0, 0, 0, 0.5);
        opacity: 0;
        transition: opacity 0.5s ease-out;
        max-height: 70%;
    }

    :target .popBox {
        position: fixed;
        opacity: 1;
    }

    .popBox:hover {
        box-shadow: 0 0 0.5rem 0.5rem rba(255, 0, 0, 0.5);
    }

    .lightbox {
        display: none;
        text-indent: -200em;
        background-color: rgba(0, 0, 0, .4);
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        z-index: 5;
    }

    :target .lightbox {
        display: block;
    }

    .close:link,
    .close:visited {
        position: absolute;
        top: -0.75em;
        right: -0.75em;
        display: block;
        width: 2em;
        height: 2em;
        line-height: 1.8;
        padding: 0;
        text-align: center;
        text-decoration: none;
        background-color: #000;
        border: 2px solid #fff;
        color: #fff;
        border-radius: 50%;
        box-shadow: 0 0 .5rem .5rem rba(0, 0, 0, .5);
    }

    .close:before {
        content: "X";
    }

    .close:hover,
    .close:active,
    .close:focus {
        box-shadow: 0 0 .5rem .5rem rba(255, 0, 0, .5);
        background-color: #c00;
        color: #fff;
    }

    .close span {
        text-indent: -200em;
        display: block;
    }

    .popScroll {
        position: absolute;
        top: 1rem;
        left: 1rem;
        right: 1rem;
        bottom: 1rem;
        overflow-y: auto;
        *overflow-y: scroll;
        padding-right: 1.5em;
    }

    .form-modal {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }
    .form-modal label{
        font-weight: 700;
        font-size: 14px;
    }
    form-modal .form-group{
        width: 100%;
    }

    .form-modal .titulo, .descripcion, .imagen, .celular, .tipomoneda, .precio {
        width: 100%;
        margin: 5px;
    }

    .form-modal input[type="text"], input[type="number"], textarea, select {
        padding: 6px 12px;
        border: 1px solid #d2d6de;

    }
    .form-modal input:focus, textarea:focus, select:focus{
        outline: 0;
        border-color: #3c8dbc;
        box-shadow: none;
    }
    .form-modal input[type="text"], textarea {
        width: 100%;
    }
    .form-group .celular input[type="text"]{
        width: 40% !important;
    }

    .form-modal select{
        width: 40%;
    }

    .form-modal input[type="number"]{
        width: 40%;
    }
    .btn-guardar{
        color: #fff;
        background-color: #337ab7;
        border: 1px solid #2e6da4;
        width: 100%;
        max-width: 150px;
        height: auto;
        padding: 10px;
        border-radius: 4px;
        cursor: pointer;
    }

</style>
