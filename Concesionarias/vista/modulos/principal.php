<?php
ob_start();
session_start();
if (!$_SESSION["user_concesionaria"]) {
    header('location:ingreso');
    exit();
}
?>
<div id="bloque-principal-agente">
    <h1>Página <span style="color: #2196F3;">principal</span></h1>
    <div class="bloque-principal-agente">
        <div class="bloque-bienvenida">
            <h2>Bienvenid@:
            </h2>
        </div>
        <div class="contenido-inicio">
            <div class="cuadro-saldo">
                <?php
                GestorUsuariosController::mostrarInformacionUserController();
                ?>
            </div>
        </div>
    </div>
</div>
<?php ob_end_flush(); ?>
<style>
    .cerrar-sesion {
        background: #cc0000;
        color: #fff;
        padding: 8px;
        border-radius: 3px;
        border: none;
        width: 150px;
        margin-top: 190px;
    }

    .cerrar-sesion a {
        color: #fff;
    }

    .btn-info {
        border: none;
        color: #fff;
        background: #008FB9;
        padding: 8px;
        border-radius: 3px;
        cursor: pointer;
        width: 150px;
    }
    .contenedor-datos{
        display: flex;
        max-width: 100%;
    }
    .datos-personales {
        border: 1px solid #dddddd;
        width: 60%;
    }
    .content-cuenta {
        width: 40%;
        border: 1px solid #dddddd
    }
</style>