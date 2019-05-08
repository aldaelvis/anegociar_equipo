<form method="post" enctype="multipart/form-data" action="">
    <h3>Editar Anuncio</h3>
    <div class="titulo">
        <label for="titulocrearanuncio">Titulo<span></span></label>
        <input v-model="objecto.titulo" type="text" placeholder="Escriba el titulo de su anuncio" required>
    </div>
    <div class="descripcion">
        <label for="descripcioncrearanuncio">Descripcion<span></span></label>
        <textarea v-model="objecto.descripcion" placeholder="Escriba una descripcion de su anuncio" required></textarea>
    </div>

    <div class="imagen">
        <label for="imagencrearanuncio">Subir imagen<span></span></label>
        <input type="file" class="btn btn-default"  id="gallery-photo-add" accept="image/*"  multiple required>
        <input type="hidden" v-model="objecto.imagen_actual">
        <p>Tamaño recomendado: 800px * 400px, peso máximo 2MB</p>
        <div id="arrastreImagenArticulo">
        </div>
        <div class="gallery">
            <img :src="`../vista/imagenes/anuncios/${objecto.nombreimagen}`">
        </div>
    </div>
    <div class="celular">
        <label for="celularcrearanuncio">Tel. Contacto<span></span></label>
        <input type="text" placeholder="Ingrese el numero de su celular" v-model="objecto.celular" required>
    </div>
    <div class="tipomoneda">
        <label for="tipomonedacrearanuncio">Tipo de moneda<span></span></label>
        <select name="tipomonedacrearanuncio" v-model="objecto.tipo_moneda">
            <option value="S/.">S/.</option>
            <option value="$">$</option>
            <option value="€">€</option>
        </select>
    </div>
    <div class="precio">
        <label for="preciocrearanuncio">Precio<span></span></label>
        <input type="number" min="0" step="0.01" placeholder="Ingrese el precio de su anuncio" v-model="objecto.precio" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
		event.charCode == 44 || event.charCode == 0"  data-number-to-fixed="2" data-number-stepfactor="100" required>
        <select name="preciotipocrearanuncio" v-model="objecto.precio_tipo">
            <!-- <option disabled value="" selected hidden>Elije uno</option> -->
            <option value="Negociable">Negociable</option>
            <option value="No negociable">No negociable</option>
        </select>
    </div>
    <button type="button" @click="editarClasificado()">Editar Clasificado</button>
</form>
