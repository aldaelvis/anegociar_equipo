<?php
session_start();
if (!$_SESSION["user-usuario"]) {
    header("location:ingresar");
    exit();
}
?>
<div id="app1">
    <div id="bloque-contenido-usuarios">
        <div class="bloque-usuario">
            <div class="contenido-usuario">
                <div class="foto-perfil">
                    <a href="#">
                        <img src="vista\temas\img\pagina\usuarios/usuario.png" width="150" height="150"
                             alt="User Images"
                             class="img-responsive">
                    </a>
                </div>
                <div class="contenido-perfil">
                    <div class="informacion-usuario">
                        <h2>Bienvenido(a) <a href="#"><?php echo $_SESSION["usuario"]; ?></a></h2>
                        <span>{{ infoUsuario.pais }}, {{ infoUsuario.departamento }}, {{ infoUsuario.provincia }}, {{ infoUsuario.distrito }}</span>
                        <p>Nombres: <span v-text="infoUsuario.nombres"></span></p>
                        <p>Apellidos: <span v-text="infoUsuario.apellidos"></span></p>
                        <p>Dirección: <span v-text="infoUsuario.direccion"></span></p>
                        <p>Saldo: <span>S/. {{ infoUsuario.saldo_usuario }}</span></p>
                        <?php
                        date_default_timezone_set("America/Lima");
                        echo '<p>Último ingreso:
                    <span>2018-07-23  a las ' . date("h") . ':' . date("i") . ':' . date("s") . ' ' . date("a") . '</span></p>';
                        ?>

                    </div>
                    <div class="opciones">
                        <button class="btn btn-editar"><i class="fas fa-chalkboard-teacher" aria-hidden="true"></i>&nbsp;Editar
                            perfil
                        </button>
                        <a href="salir" class="btn btn-danger">
                            <i class="fas fa-sign-out-alt" aria-hidden="true"></i>Salir
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bloque-contenido-usuario-clasifiados">
        <div class="bloque-usuario-clasifiados">
            <div class="buscador-contenedor">
                <label for="">Buscar Publicación</label>
                <input type="text" class="buscador" v-model="buscar" @keyup="listarClasificados(1, buscar)"
                       placeholder="Buscar publicación...">
            </div>
            <h2>Tus ultimas publicaciones</h2>
            <div class="bloque-lista-clasificados" v-for="clasificado in arrayClasificado"
                 :key="clasificado.idclasificado">
                <div class="lista-clasificados-campos">
                    <div class="campo-imagen">
                        <div class="imagen">
                            <a href="#">
                                <img :src="`vista/imagenes/anuncios/${clasificado.nombreimagen}`">
                            </a>
                        </div>
                    </div>
                    <div class="campo-titulo">
                        <a href=#">
                            <h4 v-text="clasificado.titulo"></h4>
                        </a>
                    </div>
                    <div class="campo-codigo-revista">
                        <a href="#">
                            <i class="far fa-newspaper"></i>&nbsp; Cod. Revista: <b
                                    v-text="clasificado.cod_revista"></b>
                        </a>
                    </div>
                    <div class="campo-tipo-moneda">
                        <a href="#">
                            <p v-text="clasificado.tipo_moneda"></p>
                        </a>
                    </div>
                    <div class="campo-precio">
                        <a href="#">
                            <p v-text="clasificado.precio"></p>
                        </a>
                    </div>
                    <div class="campo-precio-condicion">
                        <a href="#">
                            <p><span>({{ clasificado.precio_tipo }})</span></p>
                        </a>
                    </div>
                    <div class="campo-descripcion">
                        <a href="#">
                            <p>{{ clasificado.descripcion }}</p>
                        </a>
                    </div>
                    <div class="campo-fecha-creacion">
                        <a href="#">
                            <p>Publicado: {{ clasificado.fechacreacion }}</p>
                        </a>
                        <div class="opciones-publicaciones">
                            <form v-if="clasificado.estado == 2" action="elije_plan_anuncio" method="post">
                                <input type="hidden" :value="clasificado.idclasificado" name="idclasificado">
                                <input type="hidden" :value="clasificado.nombre_categoria" name="categoria">
                                <input type="submit" class="btn" style="color: #D73925;" value="Activar mi clasificado">
                            </form>
                            <div class="dropdown">
                                <button @click="openDrop(this, clasificado.idclasificado)" id="toggleDropdown" class="btn btn-success">
                                    <i class="fas fa-cog"></i>     
                                </button>
                                <div :id="clasificado.idclasificado + 'myDropdown'" class="dropdown-content">
                                    <a href="#pop2" @click="abrirModal(clasificado)">
                                        Editar
                                    </a>
                                    <a v-if="clasificado.estado == 1 " href="#" @click="desactivarClasificado(isActive, clasificado.idclasificado)">Desactivar</a>
                                    <a v-if="clasificado.estado == 0 " href="#" @click="activarClasificado(isActive, clasificado.idclasificado)">Activar</a>
                                </div>
                            </div>
                        </div>
                    </div>
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
        <!-- find de paginación -->
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
                                <textarea v-model="objecto.descripcion"
                                          placeholder="Escriba una descripcion de su anuncio"
                                          required></textarea>
                            </div>

                        </div>

                        <div class="imagen">
                            <label for="imagencrearanuncio">Subir imagen<span></span></label>
                            <div class="form-group">
                                <input type="file" class="btn btn-default" id="gallery-photo-add" accept="image/*"
                                       multiple
                                       required>
                                <input type="hidden" v-model="objecto.imagen_actual">
                                <p>Tamaño recomendado: 800px * 400px, peso máximo 2MB</p>
                                <div id="arrastreImagenArticulo">
                                </div>
                                <div class="gallery">
                                    <img :src="`vista/imagenes/anuncios/${objecto.nombreimagen}`">
                                </div>
                            </div>
                        </div>
                        <div class="celular">
                            <label for="celularcrearanuncio">Tel. Contacto<span></span></label>
                            <div class="form-group">
                                <input type="text" placeholder="Ingrese el numero de su celular"
                                       v-model="objecto.celular"
                                       required>
                            </div>
                        </div>
                        <div class="tipomoneda">
                            <label for="tipomonedacrearanuncio">Tipo de moneda<span></span></label>
                            <div class="form-group">
                                <select name="tipomonedacrearanuncio" v-model="objecto.tipo_moneda">
                                    <option disabled value="" selected hidden>Elige tipo de moneda</option>
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
                        <button type="button" @click="editarClasificado(isActive)" class="btn-guardar"> Editar
                            Clasificado
                        </button>
                    </form>
                </div>
            </div>
            <a href="#links" class="close"><span>Close</span></span></a>
        </div>
        <a href="#links" class="lightbox">Back to links</a>
        <!--fin del modal-->
    </div>
</div>

<script>
    new Vue({
        el: "#app1",
        data: {
            arrayClasificado: [],
            infoUsuario: [],
            buscar: '',
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
                let from = this.paginacion.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                let to = from + (this.offset * 2);
                if (to >= this.paginacion.last_page) {
                    to = this.paginacion.last_page;
                }
                let pagesArray = [];
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
                axios.get('vista/modulos/ajax/ajax.php?op=listarClasificados&pagina=' + page + '&buscar=' + buscar)
                    .then(function (response) {
                        var respuesta = response.data;
                        me.paginacion = respuesta.paginacion;
                        me.arrayClasificado = respuesta.datos;
                    }).catch(function (error) {
                    console.log(error);
                })
            },

            mostrarInformacionUsuario: function () {
                let me = this;
                axios.get('vista/modulos/ajax/ajax.php?op=mostrarInformacionUsuario')
                    .then(function (response) {
                        me.infoUsuario = response.data;
                    }).catch(function (error) {
                    console.log(error);
                })
            },

            cambiarPagina: function (page, buscar) {
                let me = this;
                //actualiza la pagina actual
                me.paginacion.current_page = page;
                me.listarClasificados(page, buscar);
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
                        me.listarClasificados(page, me.buscar);
                    }).catch(function (error) {
                    console.error(error);
                })
            },

            desactivarClasificado: function (page, id) {
                let me = this;
                axios.get('vista/modulos/ajax/ajax.php?op=desactivarClasificado&id=' + id)
                    .then(function (response) {
                        me.listarClasificados(page, me.buscar);
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

            openDrop(event, id) {
                document.getElementById(id + "myDropdown").classList.toggle("show");
                if(false) {
                    var dropdowns = document.getElementsByClassName('dropdown-content');
                    for(let i = 0; i < dropdowns.length; i++) {
                        var openDropdown = dropdowns[i];
                        if(openDropdown.classList.contains('show')) {
                            openDropdown.classList.remove('show');
                        }
                    }
                }
            },

        },
        mounted() {
            this.listarClasificados(1, '');
            this.mostrarInformacionUsuario();
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
        width: 90%;
        padding: 6px 12px;
        border: 1px solid #d2d6de;
        margin: 15px 0px;

    }

    .buscador:focus {
        outline: 0;
        border-color: #3c8dbc;
        box-shadow: none;
    }

    .btn {
        border: none;
        color: #fff;
        background: none;
        cursor: pointer;
        padding: .25rem .5rem;
        font-weight: 400;
        font-size: 14px;
    }

    .btn-editar {
        background: #337AB7;
    }

    .btn-danger {
        background: #D73925;
    }

    .btn-success {
        background-color: #f4f4f4;
        color: #444;
        border-color: #ddd;
    }

    .opciones-publicaciones {
        float: right;
        display: inline-flex;
        align-items: center;
    }
    .opciones-publicaciones .activar {
        color: #D73925;
    } 

    /*Perfil usuario*/
    .contenido-usuario {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        align-items: center;
    }

    .contenido-usuario .foto-perfil {
        width: 20%;
    }

    .contenido-usuario .contenido-perfil {
        width: 80%;
    }

    .contenido-usuario .contenido-perfil {
        font-weight: 700;
        font-size: 14px;
    }

    .contenido-usuario .contenido-perfil span {
        color: #777;
        font-weight: normal;
    }

    .contenido-usuario .opciones {
        display: inline-grid;
        float: right;
        margin: 5px;
    }

    .contenido-usuario .opciones button {
        margin: 5px;
    }

</style>
