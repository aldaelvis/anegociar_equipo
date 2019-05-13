<?php
ob_start();
session_start();
if (!$_SESSION["user_concesionaria"]) {
    header('location:ingreso');
}
$_SESSION["cat"];
?>
<div id="bloque-elije-tipo-clasificado">
    <h1 class="page-title">Anuncios <span style="color: #2196F3;">Web</span></h1>
    <div class="bloque-elije-tipo-clasificado">
        <div class="elije-tipo-anuncio">
            <h1>¿Que deseas Publicar?</h1>
            <div class="categoria">
                <div class="imagen-tipo-anuncio">
                    <form action="elije_plan_anuncio" method="post">
                        <button type="submit" name="cat" value="vehiculos" class="btn-link">
                            <img src="vista\temas\img\publicacion-vehiculos.png" alt="Icon" class="img-responsive">
                        </button>
                    </form>
                </div>
                <div class="titulo-tipo-anuncio">
                    <h4>Vehículos</h4>
                    <form action="elije_plan_anuncio" method="post">
                        <button type="submit" name="cat" value="vehiculos" class="btn-link">Vender</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
