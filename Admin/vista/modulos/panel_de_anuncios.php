<?php
session_start();

    if(!$_SESSION["user_admin"]){
        #echo "inisice session";
        header('location:ingreso');
    }
    else{
        #echo $_SESSION["idusuario"];
    }

?>
<div id="bloque-elije-tipo-clasificado">
    <h1 class="page-title">Panel de <span style="color: #2196F3;">Anuncios</span></h1>

    <div class="bloque-panel-administracion">    
        <div class="bloque-contenido-administracion">
        <h3>Vehiculos</h3>
            <div class="panel-body">
                <ul>
                    <li><a href="">Ciudades, Provincias</a></li>
                </ul>
            </div>
        </div>
        <div class="bloque-contenido-administracion">
        <h3>Inmuebles</h3>
            <div class="panel-body">
                <ul>
                    <li><a href="">Categorias</a></li>
                </ul>
            </div>
        </div>
        <div class="bloque-contenido-administracion">
        <h3>Empleos</h3>
            <div class="panel-body">
                <ul>
                    <li><a href="#">Vehículos</a></li>
                    <li><a href="#">Motos</a></li>
                </ul>
            </div>
        </div>
        <div class="bloque-contenido-administracion">
        <h3>Otros</h3>
            <div class="panel-body">
                <ul>
                    <li><a href="">Otros</a></li>
                    <li><a href="">Otros</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>



