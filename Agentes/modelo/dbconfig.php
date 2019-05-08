<?php

$DB_host = "localhost";

$DB_user = "root";

$DB_pass = "root1234";

$DB_name = "bdanegociar_equipo";

/*
try
{
	#$DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
	$pdo = new PDO('mysql:host=localhost;dbname=anegociar_BDAnegociar', 'anegociar_Admin', 'ZBQCn;_VfX=W');
	$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	$e->getMessage();
}
*/
try 
{
	$DB_con = new PDO('mysql:host=localhost;dbname=bdanegociar_equipo', 'root', 'root1234');

}
catch (PDOException $e) 
{
    echo 'Error: ' . $e->getMessage();
    exit();
}
