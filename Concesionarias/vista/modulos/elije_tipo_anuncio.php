<?php
ob_start();
session_start();
if (!$_SESSION["user_concesionaria"]) {
    header('location:ingreso');
}
?>
<div id="bloque-elije-tipo-clasificado">
    <div class="bloque-elije-tipo-clasificado">
        <div class="elije-tipo-anuncio">
            <h1>Categorías disponibles para publicar</h1>
            <div class="categoria">
                <div class="imagen-tipo-anuncio">
                    <form action="crear_anuncio" method="post">
                        <button type="submit" name="cat" value="vehiculos" class="btn-link">
                            <img src="vista\temas\img\publicacion-vehiculos.png" alt="Icon" class="img-responsive">
                        </button>
                    </form>
                </div>
                <div class="titulo-tipo-anuncio">
                    <h4>Vehículos</h4>
                    <form action="crear_anuncio" method="post">
                        <button type="submit" name="cat" value="vehiculos" class="btn-link">Vender</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>