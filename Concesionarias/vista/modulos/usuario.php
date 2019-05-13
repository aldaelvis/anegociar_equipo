<?php
ob_start();
session_start();
if( !$_SESSION["user-inm"] ){
	header('location:ingresar');
}
else{  }
?>
<div id="bloque-principal-agente">
    <h1>Página  <span style="color: #2196F3;">principal</span></h1>
    <div class="bloque-principal-agente">
        <div class="bloque-bienvenida">
            <h2>Bienvenid@: <?php 
                if(isset($_SESSION['inmobiliaria'])){
                    echo $_SESSION["inmobiliaria"];
                }
                else {
                    echo '';
                }
            ?>
            </h2>
			<?php
				date_default_timezone_set("America/Lima");
				echo '<h5>Último ingreso: <strong>2018-07-23</strong> a las <strong>' . 
				date("h") . ':' . date("i") . ':' . date("s") . ' ' . date("a") . '</strong></h5>';
			?>
        </div>
        <div class="enlace-recarga-saldo">
            <form action="saldo_agente" method="post">
                <button type="submit" name="cat" value="vehiculos" class="btn-link">Recargar Saldo</button>
            </form>
        </div>
    </div>
</div>

<div class="bloque-contenido-usuario-clasifiados">	
<div class="bloque-usuario-clasifiados">
	<h2>Tus ultimas publicaciones</h2>
	<?php	
		$crearArticulo = new GestorUsuariosController();
		$crearArticulo -> mostrarClasificadosPorUsuarioController();
	?>
</div>

