<?php
session_start();

    if(!$_SESSION["user_agente"]){

        header("location:ingresar");

        exit();

    }
?> 
<div id="bloque-contenido-usuarios">

    <h1 class="page-title">Últimas  <span style="color: #2196F3;">Publicaciones</span></h1>
    <div class="bloque-contenido-usuario-clasifiados">
        
        <div class="bloque-usuario-clasifiados">
            <h2>Tus ultimas publicaciones</h2>
            <?php   
                $crearArticulo = new GestorUsuariosController();
                $crearArticulo -> mostrarClasificadosPorUsuarioController();
            ?>
        </div>
    </div>
</div>
