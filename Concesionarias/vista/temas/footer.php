<?php
    if (($_GET["action"] == "inicio") OR ($_GET["action"] == "ver_clasificado")) {

        #echo "Tu cuenta fue correctamente activada ahora puedes inngresar";
        #header("location:usuario");
    ?>
<div id="footer">
		<div class="sub-footer">
			<div class="anegociar-detalles">
				<!-- agregue anegociar-content -->
				<div class="anegociar-content">
					<div class="anegociar-impreso">
						<div class="anegociar-impreso-imagen">
							<img src="img/icon_anegociar-impreso.png" alt="Icon" class="img-responsive">
						</div>
						<div class="anegociar-impreso-informacion">
							<h4>Versión Impresa</h4>
							<p>Siguiente Publicación Impresa <br> <span style="font-weight: bold; color: #016EB5;">Domingo 11 de Diciembre</span>.
							</p>
						</div>
					</div>
				</div>
				<!-- agregue anegociar-content -->
				<div class="anegociar-content">
					<div class="anegociar-informacion-agentes">
							<div class="anegociar-imagen-informacion">
								<img src="img/icon_anegociar-agente.png" alt="Icon" class="img-responsive">
							</div>
							<div class="anegociar-agentes-informacion">
								<h4>Agentes de Publicación</h4>
								<p>Contamos con <a href="http://anegociar.com.pe/agentes/">Agentes</a> cercanos que le permitiran publicar tus anuncios.</p>
							</div>
					</div>
				</div>
				<!-- agregue anegociar-content -->
				<div class="anegociar-content">
					<div class="anegociar-consultas">
						<div class="anegociar-imagen-consultas">
							<img src="img/icon_anegociar-ayuda.png" alt="Icon" class="img-responsive">
							</div>
						<div class="anegociar-agentes-consultas">
							<h4>Ayuda</h4>
							<p>Para consultas, dudas y/o sugerencias <a href="http://anegociar.com.pe/agentes/">Contáctenos</a> por nuestros Canales.</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer">
			<div class="anegociar-publicar">
				<div class="anegociar-enlace-publicar">
					<h2 class="title">Publica un Anuncio en Nuestro Portal</h2>
					<h4>Publica tu Anuncio Gratis!</h4>
					<a href="crear_anuncio" class="btn-publicar"><i class="fas fa-mouse-pointer"></i> Vender</a>
				</div>
			</div>

			<div class="anegociar-servicios-informacion">
				<!-- agregue anegociar-informacion-content -->
				<div class="anegociar-informacion-content">
					<div class="anegociar-informacion">
						<h2 class="title_informacion">Informacion util</h2>
						<div class="anegociar-enlaces-informacion">
							<ul>
								<li><a href="#">Contacto & Ayuda</a></li>
								<li><a href="#">Consejos de seguridad</a></li>
								<li><a href="#">Acerca de anegociar</a></li>
								<li><a href="#">Súmate a anegociar</a></li>
								<li><a href="#">Terminos y Condiciones</a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- agregue anegociar-informacion-content -->
				<div class="anegociar-informacion-content">
					<div class="anegociar-servicios">
						<h2 class="title_informacion">Servicios de anegociar</h2>
						<div class="anegociar-enlaces-servicios">
							<ul>
								<li><a href="#">Publica tu anuncio gratis</a></li>
								<li><a href="#">regístrate</a></li>
								<li><a href="#">Vende más rápido</a></li>
								<li><a href="#">Anegociar para Empresas</a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- agregue anegociar-informacion-content -->
				<div class="anegociar-informacion-content">
					<div class="anegociar-aplicaciones">
						<h2 class="title_informacion">Proximamente en</h2>
						<div class="anegociar-enlaces-servicios-img">
							<img src="img/android.png" alt="Icon" class="img-responsive">
						</div>
						<div class="anegociar-enlaces-servicios-img">
							<img src="img/ios.png" alt="Icon" class="img-responsive">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="copyright">
			<p>Anuncios Clasificados gratis en <strong>Perú</strong> - Copyright © 2018-2019 Anegociar Perú</p>
		</div>
	</div>
<?php
} 
?>
<script>
	$(window).ready(function(){
   	$('#click').click(function(){
      if($('.ubicaciones-por-anuncio').hasClass('desplegado')){
         $('.ubicaciones-por-anuncio').removeClass('desplegado');
      }else{
         $('.ubicaciones-por-anuncio').addClass('desplegado');
      }
   	})
	})
</script>
