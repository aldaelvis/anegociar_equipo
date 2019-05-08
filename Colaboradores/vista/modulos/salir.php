<?php

session_start();
#session_destroy();

echo "<h1>¡Haz salido de la aplicación!</h1>";

unset($_SESSION["user_colaborador"]);
if(isset($_SESSION["user_colaborador"])){
	unset($_SESSION["user_colaborador"]);
}

header("location:ingreso");
?>