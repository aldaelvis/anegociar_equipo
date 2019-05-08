<?php
session_start();

    if(!$_SESSION["user_inmobiliaria"]){
        #echo "inisice session";
        header('location:ingreso');
    }
    else{
        #echo $_SESSION["idusuario"];
    }

?>
<div id="bloque-principal-agente">
    <h1 class="page-title">Saldos y  <span style="color: #2196F3;">Movimientos</span></h1>
    <div id="app5">
        <input type="text" v-model="buscar" @keyup="listarMovimientos(1, buscar)"  placeholder="Buscar movimientos"> <br />
        <table>
            <thead>
                <th>#</th>
                <th>Codigo</th>
                <th>Titulo</th>
                <th>Fecha de creación</th>
                <th style="text-align: center;">Precio web</th>
                <th style="text-align: center;">Precio Revista</th>
                <th style="text-align: center;">Total Publicacion</th>
            </thead>
            <tbody>
                <tr v-for="(movimiento, key) in arrayMovimientos">
                    <td v-text="key + 1"></td>
                    <td v-text="movimiento.cod_revista"></td>
                    <td v-text="movimiento.titulo"></td>
                    <td v-text="movimiento.fechacreacion"></td>
                    <td style="text-align: center;">
                        <span v-if="movimiento.precio_plan_revista == null" >
                            -
                        </span>
                        <span v-else v-text=" 'S/. ' + movimiento.precio_plan_revista">
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <span v-if="movimiento.precio_plan_web == null">
                            -
                        </span>
                        <span v-else  v-text="'S/. ' + movimiento.precio_plan_web"></span>
                    </td>
                    <td style="text-align: center;" v-text="'S/. ' +  movimiento.total_pagado"></td>
                </tr>
                <tr>
                    <td colspan="6" style="text-align: right;"><h3>Total:</h3></td>
                    <td style="text-align: center;" colspan="1"><span class="badge">S/. {{total_final}}</span></td>
                </tr>
            </tbody>
            
        </table>
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
<script>
new Vue({
    el: '#app5',
    data: {
        arrayMovimientos: [],
        buscar: '',
        total_final: 0.0,
        paginacion: {
            total: 0,
            current_page: 0,
            per_page: 0,
            last_page: 0,
            from: 0,
            to: 0
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
        listarMovimientos: function(page, buscar){
            let me = this;
            axios.get('vista/modulos/ajax/ajax.php?op=movimientos&pagina=' + page + '&buscar='+buscar)
            .then(function(response){
                var respuesta = response.data;
                me.arrayMovimientos = respuesta.data;
                me.paginacion = respuesta.paginacion;
                me.total_final = respuesta.total_final;
                console.log(respuesta.total_final);
            })
            .catch(function(error){
                console.error(error);
            })
        },

        cambiarPagina: function(page, buscar){
            let me = this;
            //actualiza la pagina actual
            me.paginacion.current_page = page;
            me.listarMovimientos(page, buscar);
        },
    },
    mounted(){
        this.listarMovimientos(1, '');
    }
});
</script>
<style>
    table{
        width: 100%;
    }
    table th{
        text-align: left;
    }
    .badge{
        background: #6C757D;
        color: #fff;
        padding: 5px;
        border-radius: 10%;
    }

    /* Paginacion estilos */
    .paginacion{
      display: inline-flex;
      list-style: none;
    }
    .paginacion li {
      margin-left:  30px;
      padding: 8px;
    }
    .paginacion li a{
      color: #000;
      text-decoration: none;
    }
    .activado{
      background: #337AB7;
      border-radius:8px; 
    }
</style>