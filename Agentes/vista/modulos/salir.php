<?php

session_start();
#session_destroy();

echo "<h1>¡Haz salido de la aplicación!</h1>";

unset($_SESSION["user_agente"]);
if(isset($_SESSION["user-agente"])){
	unset($_SESSION["user-agente"]);
}
session_destroy();
header("location:ingreso");
?>