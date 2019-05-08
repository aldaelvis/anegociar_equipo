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
    <h1 class="page-title">Panel de <span style="color: #2196F3;">Administración</span></h1>

    <div class="bloque-panel-administracion">    
        <div class="bloque-contenido-administracion">
        <h3>Ubicacion</h3>
            <div class="panel-body">
                <ul>
                    <li><a href="">Ciudades, Provincias</a></li>
                </ul>
            </div>
        </div>
        <div class="bloque-contenido-administracion">
        <h3>Clasificados</h3>
            <div class="panel-body">
                <ul>
                    <li><a href="index.php?action=listar&cat=categoria">Categorias</a></li>
                </ul>
            </div>
        </div>
        <div class="bloque-contenido-administracion">
        <h3>Marcas / Modelos</h3>
            <div class="panel-body">
                <ul>
                    <li><a href="#">Vehículos</a></li>
                    <li><a href="#">Motos</a></li>
                </ul>
            </div>
        </div>
        <div class="bloque-contenido-administracion">
        <h3>Recursos Humanos</h3>
            <div class="panel-body">
                <ul>
                    <li><a href="index.php?action=listar&rol=agente">Agentes</a></li>
                    <li><a href="index.php?action=listar&rol=colaborador">Colaboradores</a></li>
                    <li><a href="index.php?action=listar&rol=usuario">Usuarios</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>



