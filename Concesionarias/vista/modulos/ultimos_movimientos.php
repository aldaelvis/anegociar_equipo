<?php
session_start();

if (!$_SESSION["user_concesionaria"]) {
    header('location:ingreso');
}
?>
<div id="bloque-principal-agente">
    <h1 class="page-title">Saldos y <span style="color: #2196F3;">Movimientos</span></h1>
    <div id="app5">
        <div class="contenedor-movimientos">
            <div class="contenedor-buscador">
                <input type="text" id="buscar" v-model="buscar" @keyup="listarMovimientos(1, buscar)"
                       placeholder="Buscar movimientos">
                <br/>
            </div>
            <div class="box-body">
                <table class="common-table">
                    <thead>
                    <th>#</th>
                    <th>Codigo</th>
                    <th>Titulo</th>
                    <th>Fecha de creación</th>
                    <th>Precio web</th>
                    <th>Precio Revista</th>
                    <th>Total Publicacion</th>
                    </thead>
                    <tbody>
                    <tr v-for="(movimiento, key) in arrayMovimientos">
                        <td v-text="key + 1"></td>
                        <td v-text="movimiento.cod_revista"></td>
                        <td v-text="movimiento.titulo"></td>
                        <td v-text="movimiento.fechacreacion"></td>
                        <td>
                        <span v-if="movimiento.precio_plan_web == null">
                            -
                        </span>
                            <span v-else v-text="'S/. ' + movimiento.precio_plan_web"></span>
                        </td>
                        <td>
                        <span v-if="movimiento.precio_plan_revista == null">
                            -
                        </span>
                            <span v-else v-text=" 'S/. ' + movimiento.precio_plan_revista">
                        </span>
                        </td>

                        <td style=" color: #B94A48">S/. {{ Number(movimiento.total_pagado).toFixed(2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="6" style="text-align: right;"><h4>Total</h4></td>
                        <td style="text-align: left;" colspan="1"><span class="placa">S/. {{ (total_final).toFixed(2)
                                }}</span></td>
                    </tr>
                    </tbody>

                </table>
            </div>
        </div>
        <!-- paginación -->
        <ul class="paginacion">
            <li class="page-item" v-if="paginacion.current_page > 1">
                <a class="page-link" href="#"
                   @click.prevent="cambiarPagina(paginacion.current_page - 1, buscar)">&#60;</a>
            </li>
            <li class="page-item" v-for="page in pageNumber" :key="page" :class="[page == isActive ? 'active' : '']">
                <a class="page-link" href="#" @click.prevent="cambiarPagina(page, buscar)" v-text="page"></a>
            </li>
            <li class="page-item" v-if="paginacion.current_page < paginacion.last_page">
                <a class="page-link" href="#" @click.prevent="cambiarPagina(paginacion.current_page +1, buscar)">&#62;</a>
            </li>
        </ul>
        <!-- find de paginación -->
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
            listarMovimientos: function (page, buscar) {
                let me = this;
                axios.get('vista/modulos/ajax/ajax.php?op=movimientos&pagina=' + page + '&buscar=' + buscar)
                    .then(function (response) {
                        var respuesta = response.data;
                        me.arrayMovimientos = respuesta.data;
                        me.paginacion = respuesta.paginacion;
                        me.total_final = respuesta.total_final;
                        console.log(respuesta.total_final);
                    })
                    .catch(function (error) {
                        console.error(error);
                    })
            },

            cambiarPagina: function (page, buscar) {
                let me = this;
                //actualiza la pagina actual
                me.paginacion.current_page = page;
                me.listarMovimientos(page, buscar);
            },
        },
        mounted() {
            this.listarMovimientos(1, '');
        }
    });
</script>
<style>

</style>