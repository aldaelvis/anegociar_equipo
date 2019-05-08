<?php

#DB_host = "localhost";
$DB_host = "anegociar.pe";
#$DB_user = "root";
$DB_user = "anegociar_Admin";
#$DB_pass = "MySql1318";
#$DB_pass = "root1234";
$DB_pass = "ZBQCn;_VfX=W";
#$DB_name = "bdanegociar";
$$DB_name = "anegociar_BDAnegociar";

/*
try
{
	$DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
	$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	$e->getMessage();
}
*/

try 
{
	$DB_con = new PDO('mysql:host=localhost;dbname=anegociar_BDAnegociar', 'anegociar_Admin', 'ZBQCn;_VfX=W');

}
catch (PDOException $e) 
{
    echo 'Error: ' . $e->getMessage();
    exit();
}
