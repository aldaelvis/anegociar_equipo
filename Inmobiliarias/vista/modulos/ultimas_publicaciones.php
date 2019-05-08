<?php
session_start();
if(!$_SESSION["user_inmobiliaria"]){
    header("location:ingresar");
    exit();
}?>
<div id="app1">
  <div id="bloque-contenido-usuarios">

    <h1 class="page-title">Últimas  <span style="color: #2196F3;">Publicaciones</span></h1>
    <div class="bloque-contenido-usuario-clasifiados">

        <div class="bloque-usuario-clasifiados">
            <h2>Tus ultimas publicaciones</h2>
            <input type="text" v-model="buscar" @keyup.enter="paginacionClasificados(1, buscar)"  placeholder="Buscar publicacion"> <br />
            <div v-for="clasificado in arrayClasificado" :key="clasificado.idclasificado" class="bloque-lista-clasificados">
              <div class="lista-clasificados-campos">
                <div class="campo-imagen">
                    <img v-if="clasificado.nombreimagen != '' " :src="`../vista/imagenes/anuncios/${clasificado.nombreimagen}`">
                    <img v-else alt="No hay Imagen" :src="`../vista/imagenes/anuncios/logo.png`">
                </div>
                <div class="campo-titulo">
                  <a href="#">
                  <h4 v-text="clasificado.titulo"></h4>
                  </a>
                </div>
                <div class="campo-codigo-revista">
                  <a href="#">
                    <i class="far fa-newspaper"></i>&nbsp; Cod. Revista: <b v-text="clasificado.cod_revista"></b>
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
                  <a v-bind:href="'index.php?action=ver_clasificado&id='+clasificado.idclasificado">
                  <p><span>(Negociable)</span></p>
                  </a>
                </div>
                <div class="campo-descripcion">
                  <a href="#">
                  <p v-text="clasificado.descripcion"></p>
                  </a>
                </div>
                <div class="campo-fecha-creacion">
                  <a href="#">
                  <p>Publicado: Hace 1 semana {{ clasificado.fechacreacion }}  </p>
                  </a>
                  <a href="#pop2" @click="mostrarClasificado(clasificado)">
                    Editar
                  </a>
                  <template v-if="clasificado.estado == '1'">
                    <div style="background: red;  border-radius: 10px; ">
                      <a style="color: #fff;" href="#" @click="desactivarClasificado(clasificado.idclasificado)">Desactivar</a>
                    </div>
                  </template>
                  <template v-if="clasificado.estado == '0'">
                    <div style="background: green;  border-radius: 10px;">
                        <a style="color: #fff;" href="#" @click="activarClasificado(clasificado.idclasificado)">Activar</a>
                    </div>
                  </template>
                </div>
              </div>
            </div>
            <!-- paginacion -->
            <ul class="paginacion">
                <li class="page-item" v-if="paginacion.current_page > 1">
                    <a class="page-link" href="#"
                        @click.prevent="cambiarPagina(paginacion.current_page - 1, buscar)">Ant</a>
                </li>
                <li class="page-item" v-for="page in pageNumber" :key="page" :class="[page == isActive ? 'activado' : '']">
                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page, buscar)" v-text="page"></a>
                </li>
                <li class="page-item" v-if="paginacion.current_page < paginacion.last_page">
                    <a class="page-link" href="#" @click.prevent="cambiarPagina(paginacion.current_page +1, buscar)">Sig</a>
                </li>
            </ul>
            <!-- find de paginacion -->
        </div>
    </div>
  </div>


<div id="pop2" class="pop-up">
    <div class="popBox">
        <div class="popScroll">
                <div>
                    <?php
                    include 'editarClasificado.php';
                    ?>
                </div>
        </div>
        <a href="#links" class="close"><span>Close</span></span></a>
    </div>
    <a href="#links" class="lightbox">Back to links</a>
</div>
</div>
<script>
  new Vue({
    el: '#app1',
    data: {
      arrayClasificado: [],
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
      isActive: function(){
        return this.paginacion.current_page;
      },

      pageNumber: function(){
        if(!this.paginacion.to){
          return [];
        }
        var from = this.paginacion.current_page - this.offset;
        if(from < 1) {
            from = 1;
        }
        var to = from + (this.offset * 2);
        if(to >= this.paginacion.last_page){
            to = this.paginacion.last_page;
        }
        var pagesArray = [];
        while(from <= to){
            pagesArray.push(from);
            from++;
        }
        return pagesArray;
      },

    },

    methods: {
        paginacionClasificados: function(page, buscar){
          let me = this;
          axios.get('vista/modulos/ajax/ajax.php?op=paginacion&pagina=' + page + '&buscar='+buscar)
          .then(function(response){
            var respuesta = response.data;
            me.paginacion = respuesta.paginacion;
            me.arrayClasificado = respuesta.datos;
          }).catch(function(error){
            console.log(error);
          })
        },

        cambiarPagina: function(page, buscar){
            let me = this;
            //actualiza la pagina actual
            me.paginacion.current_page = page;
            me.paginacionClasificados(page, buscar);
        },

        mostrarClasificado: function(item){
          let me = this;
          me.objecto.idclasificado = item.idclasificado;
          me.objecto.titulo = item.titulo;
          me.objecto.descripcion = item.descripcion;
          me.objecto.nombreimagen = item.nombreimagen;
          me.objecto.celular = item.celular;
          me.objecto.tipo_moneda = item.tipo_moneda;
          me.objecto.precio = item.precio;
          me.objecto.precio_tipo = item.precio_tipo;
          // this.mostrarImagenes(data.idclasificado);
        },

        editarClasificado: function(){
          let me = this;
          var formData = new FormData();
          for(var key in this.objecto){
            formData.append(key, this.objecto[key]);
          }
          axios.post('vista/modulos/ajax/ajax.php?op=editarClasificadoUser', formData)
          .then(function(response){
            console.log(response.data);
            me.paginacionClasificados(1, '');
          })
          .catch(function(error){
            console.log(error);
          })
        },

        desactivarClasificado: function(id){
          let me  = this;
          axios.get('vista/modulos/ajax/ajax.php?op=desactivarClasificado&idclasificado=' + id )
          .then(function(response){
            console.log(response.data);
            me.paginacionClasificados(1, '');
          }).catch(function(error){
            console.log(error);
          });
        },

        activarClasificado: function(id){
          let me  = this;
          axios.get('vista/modulos/ajax/ajax.php?op=activarClasificado&idclasificado=' + id )
          .then(function(response){
            console.log(response.data);
            me.paginacionClasificados(1, '');
          }).catch(function(error){
            console.log(error);
          });
        },

    },
    mounted(){
      // this.listarClasificadosUser();
      this.paginacionClasificados(1, this.buscar);
    },


  });

</script>
<style type="text/css">
    /* Paginacion estilos */
    .paginacion{
      display: inline-flex;
      list-style: none;
    }
    .paginacion li {
      margin-left:  30px;
      padding: 15px;
    }
    .paginacion li a{
      color: #000;
      text-decoration: none;
    }

    .activado{
      background: #337AB7;
    }

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
