<?php 
ob_start();
if(isset($_POST['idclasificado']) && isset($_POST['categoria']) ) {
    $_SESSION['val2'] =  $_POST['idclasificado'];
    $_SESSION["val1"] = $_POST['categoria'];
}
?>
    <div id="bloque-elije-plan-clasificado">
        <div class="bloque-elije-plan-clasificado">
            <?php
            if (isset($_SESSION['val1'])) {
                $algo = $_SESSION['val1'];
                $algo2 = $_SESSION['val2'];
                echo '<h1 Style="color:white">Su anuncio esta creado, seleccione uno de estos planes para activarlo!</h1>';
                
                GestorPlanesController::vistaAnunciosPlanesController();
            } else {
                header('location:crear_anuncio');
            }
            ?>
        </div>
    </div>
<?php
$vistaVehiculos = new GestorAnunciosController();
$vistaVehiculos->activarClasificadoController();
ob_end_flush();
?>
<script>
function init() {
    planRevista = document.getElementById('planRevista');
    planRevista.checked = false;
}

function mostrarPlan() {
    revista = document.getElementById('planes_revista');
    if(revista.style.display === 'none') {
        revista.style.display = "block";
    } else {
        revista.style.display = "none";
        planRevista = document.getElementById('planRevista');
        planRevista.checked = (planRevista.checked) ? false : true;
    }
}

function limpiarMensaje() {
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if(alert) {
            alert.remove();
        }
    }, 5000);
}

init();

document.addEventListener('DOMContentLoaded', (evt) => {
    limpiarMensaje();
})


</script>