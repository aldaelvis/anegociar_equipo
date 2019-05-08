<?php
session_start();

    if(!$_SESSION["user_admin"]){
        header('location:ingreso');
    }
    else{
        #echo $_SESSION["idusuario"];
    }

?>
<!-- <script type="text/javascript" src="vista/temas/js/jquery-3.3.1.js"></script>
<script type="text/javascript" src="vista/temas/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script>

<link rel="stylesheet" href="vista/temas/css/jquery.dataTables.min.css">
 -->

<div id="app1">
    <div id="bloque-contenido-usuarios">

    <h1 class="page-title">Últimas  <span style="color: #2196F3;">Publicaciones</span></h1>
        <div class="bloque-contenido-usuario-clasifiados">
            
            <div class="bloque-usuario-clasifiados">
                <h2>Tus ultimas publicaciones</h2> 
                <!-- <div v-for="clasificado in arrayClasificado" class="bloque-lista-clasificados"> -->
                    <input type="text" v-model="usuarios">
                    <div class="lista-clasificados-campos">
                        <table id="tablaSuscriptores" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>opciones</th>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Codigo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="persona in arraylistarUsuarios">
                                    <td v-text="persona.idusuario">  
                                    </td>
                                    <td v-text="persona.usuario">  
                                    </td>
                                    <td v-text="persona.email">  
                                    </td>
                                    <td>
                                        <!-- <button type="buttom" @click="mostrarUsuarios(persona)">editar</button> -->
                                        <a href="?#pop2" @click="mostrarUsuarios(persona)">Editar</a>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>opciones</th>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Codigo</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>


    <div id="pop2" class="pop-up">
        <div class="popBox">
            <div class="popScroll">
                <?php 
                    include 'editarUsuario.php';
                ?>
            </div>
            <a href="#links" class="close"><span>Close</span></span></a>
        </div>
        <a href="#links" class="lightbox">Back to links</a>
    </div>

 <style type="text/css">
    .pop-up {
      position: absolute;
      top: 0;
      left: -500em;
    }
    .pop-up:target {
      position: static;
      left: 0;
    }
    .popBox {
      background-color: #fff;

      /* alternatively fixed width / height and negative margins from 50% */
      position: absolute;
      left: 5%;
      right: 5%;
      top: 10%;
      bottom: 30%;
      z-index: 6;
      border: 1px solid #3a3a3a;
      /*border-radius: 0.25rem;*/
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
      background-color: rgba(0,0,0,.4);
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
      box-shadow: 0 0 .5rem .5rem rba(0,0,0,.5);
    }
    .close:before {content:"X";}
    .close:hover,
    .close:active,
    .close:focus {
      box-shadow: 0 0 .5rem .5rem rba(255,0,0,.5);
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
      padding-right: 0.5em;
    }
</style>

<script>
new Vue({
    el: '#app1',
    data: {
        arraylistarUsuarios: [],
        usuarios:'',
    },  
    methods: {

        listarUsuarios: function(){
            let me = this;
            axios.get('vista/modulos/ajax/ajax.php?op=listarUsuariosVue')
                .then(function(response){
                    me.arraylistarUsuarios = response.data;
                }).catch(function(e){
                console.log(e);
            })
        },
        mostrarUsuarios: function(data){
            let me = this;
            this.usuarios = data.usuario;
            console.log(data);
        },
    },
    mounted(){
        this.listarUsuarios();
    }
});

</script>


<!-- <script>
Vue.config.devtools = true;

new Vue({
        el: '#vue-registro',
        data: {
            arraylistarUsuarios: [],
            usuarios:'',
        },
        methods: {
            listarusuarios: function(){
                let me = this;
                axios.get('vista/modulos/ajax/ajax.php?op=listarUsuariosVue')
                    .then(function(response){
                        me.arraylistarUsuarios = response.data;
                    }).catch(function(e){
                    console.log(e);
                })
            },

            mostrarusuario: function(data){
                let me = this;
                this.usuarios = data.usuario;
                console.log(data);
            },
        },
        mounted() {
            this.listarusuarios();
        }

    });
</script> -->

<!-- <script type="text/javascript" src="vista/temas/js/script.js"></script> -->
<script type="text/javascript">

    // <!-- $(document).ready(function() { -->
    // $('#tablaSuscriptores').DataTable();
// } );

$(document).ready(function() {
    $('#tablaSuscriptores').DataTable(
        {
            "order": [[ 1, "desc" ]]
        }
    );
});

//     $('#tablaSuscriptores').DataTable({
//     "language": {
//             "sProcessing":     "Procesando...",
//             "sLengthMenu":     "Mostrar _MENU_ registros",
//             "sZeroRecords":    "No se encontraron resultados",
//             "sEmptyTable":     "Ningún dato disponible en esta tabla",
//             "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
//             "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
//             "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
//             "sInfoPostFix":    "",
//             "sSearch":         "Buscar:",
//             "sUrl":            "",
//             "sInfoThousands":  ",",
//             "sLoadingRecords": "Cargando...",
//             "oPaginate": {
//                 "sFirst":    "Primero",
//                 "sLast":     "Último",
//                 "sNext":     "Siguiente",
//                 "sPrevious": "Anterior"
//             },
//             "oAria": {
//                 "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
//                 "sSortDescending": ": Activar para ordenar la columna de manera descendente"
//             }
//         }
// });

</script>