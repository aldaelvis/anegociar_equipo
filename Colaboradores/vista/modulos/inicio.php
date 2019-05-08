<?php
session_start();

    if(!$_SESSION["user_colaborador"]){
        #echo "inisice session";
        header('location:ingreso');
        exit();
    }
    else{
        #echo $_SESSION["idusuario"];
    }

?>
<div id="bloque-principal-agente">
    <h1>Página  <span style="color: #2196F3;">principal</span></h1>
    <div class="bloque-principal-agente">
        <div class="bloque-bienvenida">
            <h2>Bienvenid@: <?php 
                #session_start();
                if(isset($_SESSION['user_colaborador'])){
                    echo $_SESSION["usuarioCol"];
                }
                else {
                    echo '';
                }
            ?>
            </h2>
        </div>
        <div class="enlace-recarga-saldo">
            <form action="saldo_agente" method="post">
                <button type="submit" name="cat" value="vehiculos" class="btn-link">Recargar Saldo</button>
            </form>
        </div>
        <div class="contenido-inicio">
            <div class="cuadro-saldo">
                <?php
                    $ingreso = new GestorUsuariosController();
                    $ingreso -> SaldoDisponibleClasificadoController();
                ?>
            </div>
            <div class="cuadro-ubicacion">
                <legend>Ubicación</legend>
                <p>Peru</p>
            </div>
            <div class="cuadro-cuenta">
                <legend>Cuenta</legend>
                <p>Última sesión: <i>2018-06-28 11:43:24</i></p>
                <a href="salir" class="btn btn-default"><i class="fa fa-sign-out" aria-hidden="true"></i> Terminar Sesión</a>
            </div>
        </div>
    </div>
</div>