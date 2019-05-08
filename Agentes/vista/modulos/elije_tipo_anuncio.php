<?php
ob_start();
session_start();
if (!$_SESSION["user_agente"]) {
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
            <div class="categoria">
                <div class="imagen-tipo-anuncio">
                    <form action="crear_anuncio" method="post">
                        <button type="submit" name="cat" value="inmuebles" class="btn-link">
                            <img src="vista\temas\img\publicacion-inmuebles.png" alt="Icon" class="img-responsive">
                        </button>
                    </form>
                </div>
                <div class="titulo-tipo-anuncio">
                    <h4>Inmuebles</h4>
                    <form action="crear_anuncio" method="post">
                        <button type="submit" name="cat" value="inmuebles" class="btn-link">Vender</button>
                    </form>
                </div>
            </div>
            <div class="categoria">
                <div class="imagen-tipo-anuncio">
                    <form action="crear_anuncio" method="post">
                        <button type="submit" name="cat" value="empleos" class="btn-link">
                            <img src="vista\temas\img\publicacion-clasificados.png" alt="Icon" class="img-responsive">
                        </button>
                    </form>
                </div>
                <div class="titulo-tipo-anuncio">
                    <h4>Empleos</h4>
                    <form action="crear_anuncio" method="post">
                        <button type="submit" name="cat" value="empleos" class="btn-link">Vender</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="otras-categorias">
            <h1>Buscas otra categoria ?</h1>
            <form action="crear_anuncio" method="post">
                <select name="cat" class="nombrecategoria" required="">
                    <option disabled value="" selected hidden>--Categoria--</option>
                    <option value="Hogar - Oficina - Negocio" class="imagebacked"
                            style="background-image: url(vista/temas/img/publicacion-clasificados.png)">Hogar - Oficina - Negocio
                    </option>
                    <option value="Servicios">Servicios</option>
                    <option value="Hobbies - Tiempo Libre">Hobbies - Tiempo Libre</option>
                    <option value="Telefonos - moviles">Teléfonos - móviles</option>
                    <option value="Informatica - Sonido - Video">Informatica - Sonido - Video</option>
                    <option value="Mascotas - Animales">Mascotas - Animales</option>
                    <option value="Ropa - Calzado - Accesorios">Ropa - Calzado - Accesorios</option>
                    <option value="Esoterismo">Esoterismo</option>
                    <option value="Contactos">Contactos</option>
                </select>
                <button type="submit" name="submit" value="" class="btn-link">Vender</button>
            </form>
        </div>

    </div>
</div>
