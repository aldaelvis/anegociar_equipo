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
.contenedor {
    display: flex;
    width: 90%;
    margin: 0 auto;
    box-shadow: 1px 1px 4px rgba(0,0,0,0.4);
    border-radius: 5px;
    padding: 2rem;

}

.contenedor .foto {
    width: 30%;
}

.contenedor .informacion-content {
    width: 60%;
    display: inline-block;

}

.informacion {
    display: flex;
    flex-wrap: wrap;
}

.informacion label {
    margin-bottom: 0;
    padding-top: calc(0.250rem + 1px);
    padding-bottom: calc(.375rem + 1px);
    flex: 0 0 15.666667%;
    max-width: 16.666667%;
}

.informacion .informacion-info {
    width: 83.33%;
    padding-top: .375rem;
    padding-bottom: .375rem;
    flex: 0 0 83.333333%;
}
</style>