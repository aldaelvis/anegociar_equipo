<?php
// <?xml version="1.0" encoding="UTF-8"
ob_start();
header("Content-type: application/xml");
/*
echo '
<juiceboxgallery
galleryTitle="Juicebox Lite Gallery"
 >
<image imageURL="vista/modulos/galeria/images/wide.jpeg"
thumbURL="vista/modulos/galeria/thumbs/wide.jpeg"
linkURL="vista/modulos/galeria/images/wide.jpeg"
linkTarget="_blank">
<title>Welcome to Juicebox!</title>
</image>
</juiceboxgallery>
';
*/
		$vistaVehiculos = new GestorAnunciosController();
		$vistaVehiculos -> mostrarClasificadosController();

	?>