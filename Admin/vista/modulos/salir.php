<?php

session_start();
#session_destroy();

echo "<h1>¡Haz salido de la aplicación!</h1>";

unset($_SESSION["user_admin"]);
if(isset($_SESSION["user_admin"])){
	unset($_SESSION["user_admin"]);
}

header("location:ingreso");
?>