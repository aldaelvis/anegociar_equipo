<?php
    if (($_GET["action"] == "inicio") OR ($_GET["action"] == "ver_clasificado")) {

        #include "temas/slider.php";
    ?>	
	<div id="header">
		<div class="logo">
			<picture>
				<a href="inicio"><img src="vista/temas/img/logo.png" alt="Anegociar" /></a>
			</picture>
		</div>
		<!-- <div style="margin: 14px 0px 0px 0px; font-size: 0.9em; font-weight: normal; color: #4a4a4a;">
		 Arequipa - Cusco - Puno - Tacna - Moquegua 
		</div> -->
	</div>
<?php
} 
else {

}
#}
?>