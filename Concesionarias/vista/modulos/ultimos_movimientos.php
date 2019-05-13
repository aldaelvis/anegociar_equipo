<?php
session_start();
if (!$_SESSION["user_concesionaria"]) {
    header('location:ingreso');
    exit();
}
?>
<div id="bloque-principal-agente">
    <h1 class="page-title">Saldos y <span style="color: #2196F3;">Movimientos</span></h1>
    <div id="app3">
        <div class="contenedor-buscador">
            <input type="text" v-model="buscar" @keyup="listarMovimientos(1, buscar)" placeholder="Buscar movimientos">
            <br/>
        </div>
        <div class="box-table">
            <div class="box-body">
                <table class="table-movimientos">
                    <tbody>
                    <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Titulo</th>
                        <th>Fecha de creación</th>
                        <th>Precio web</th>
                        <th>Precio Revista</th>
                        <th>Total Publicación</th>
                    </tr>
                    <tr v-for="(movimiento, key) in arrayMovimientos">
                        <td v-text="key + 1"></td>
                        <td v-text="movimiento.cod_revista"></td>
                        <td v-text="movimiento.titulo"></td>
                        <td v-text="movimiento.fechacreacion"></td>
                        <td style="text-align: center;">
                        <span v-if="movimiento.precio_plan_web == null">
                            -
                        </span>
                            <span v-else v-text="'S/. ' + movimiento.precio_plan_web"></span>
                        </td>
                        <td style="text-align: center;">
                        <span v-if="movimiento.precio_plan_revista == null">
                            -
                        </span>
                            <span v-else v-text=" 'S/. ' + movimiento.precio_plan_revista">
                        </span>
                        </td>

                        <td class="total-pagado" style="text-align: center;"
                            v-text="'- S/. ' +  movimiento.total_pagado"></td>
                    </tr>
                    <tr>
                        <td colspan="6" style="text-align: right;"><h3>Total:</h3></td>
                        <td style="text-align: center;" colspan="1"><span class="badge">S/. {{total_final}}</span></td>
                    </tr>
                    </tbody>

                </table>
            </div>

        </div>
        <!-- paginacion -->
        <ul class="paginacion">
            <li class="page-item" v-if="paginacion.current_page > 1">
                <a class="page-link" href="#"
                   @click.prevent="cambiarPagina(paginacion.current_page - 1, buscar)">Ant</a>
            </li>
            <li class="page-item" v-for="page in pageNumber" :key="page" :class="[page == isActive ? 'active' : '']">
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
        el: '#app3',
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
    .box-table {
        position: relative;
        border-radius: 3px;
        background: #ffffff;
        border-top: 3px solid #d2d6de;
        margin-bottom: 20px;
        width: 100%;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
    }

    .box-body {
        border-radius: 0 0 3px 3px;
        padding: 10px;
    }

    table {
        border-spacing: 0;
        border-collapse: collapse;
        border: 1px solid #f4f4f4;
        width: 100%;
    }

    table th {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border: 1px solid #f4f4f4;
        height: 30px;
        font-size: 14px;
        font-weight: 700;
        text-align: center;
        text-transform: uppercase;
    }

    table tr td {
        border: 1px solid #f4f4f4;
        color: #000000;
    }

    table td {
        padding: 15px;
    }

    table tr:nth-of-type(odd) {
        background: #f9f9f9;
    }

    .badge {
        background: #6C757D;
        color: #fff;
        padding: 5px;
        border-radius: 10%;
    }

    .total-pagado {
        color: #cc0000;
    }

    .contenedor-buscador {
        width: 100%;
        display: flex;
        justify-content: center;
        margin-bottom: 15px;
    }

    .contenedor-buscador input {
        padding: 6px 12px;
        border: 1px solid #d2d6de;
        margin: 15px 0px;
        width: 40%;
    }

    .contenedor-buscador input:focus {
        outline: 0;
        border-color: #3c8dbc;
        box-shadow: none;
    }
</style>