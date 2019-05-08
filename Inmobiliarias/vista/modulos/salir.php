<?php

session_start();
#session_destroy();

echo "<h1>¡Haz salido de la aplicación!</h1>";

unset($_SESSION["user_inmobiliaria"]);
if(isset($_SESSION["user_inmobiliaria"])){
	unset($_SESSION["user_inmobiliaria"]);
}
session_destroy();
header("location:inicio");
?>