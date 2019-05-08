<?php
session_start();

    if(!$_SESSION["user_admin"]){
        #echo "inisice session";
        header('location:ingreso');
        exit();
    }
    else{
        #echo $_SESSION["idusuario"];
    }

?>
<div id="bloque-principal-agente">
    <h1>Página  <span style="color: #2196F3;">editar</span></h1>
    <div class="bloque-principal-agente">
        <form method="post">
            <?php
                $editarUsuario = new GestorUsuariosController();
                $editarUsuario -> editarUsuarioPorRolController();
                $editarUsuario -> actualizarUsuarioPorRolController();
            ?>
        </form>
    </div>
</div>