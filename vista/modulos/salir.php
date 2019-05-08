<?php

session_start();
#session_destroy();

echo "<h1>¡Haz salido de la aplicación!</h1>";

if(isset($_SESSION["user-usuario"])){
	unset($_SESSION['user-usuario']);
}

header("location:inicio");
?>