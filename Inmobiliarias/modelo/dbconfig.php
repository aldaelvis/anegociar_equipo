<?php

$DB_host = "localhost";

$DB_user = "root";

$DB_pass = "root1234";

$DB_name = "bdanegociar_equipo";
try 
{
	$DB_con = new PDO('mysql:host=localhost;dbname=bdanegociar_equipo', 'root', 'root1234');

}
catch (PDOException $e) 
{
    echo 'Error: ' . $e->getMessage();
    exit();
}
