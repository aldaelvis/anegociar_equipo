<?php

#$DB_host = "localhost";
$DB_host = "anegociar.com.pe";
#$DB_user = "root";
$DB_user = "anegociarcom_Admin";
#$DB_pass = "MySql1318";
#$DB_pass = "root1234";
$DB_pass = "ZBQCn;_VfX=W";
#$DB_name = "bdanegociar";
$$DB_name = "anegociarcom_BDAnegociar";
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
	// $DB_con = new PDO('mysql:host=localhost;dbname=anegociarcom_BDAnegociar', 'anegociarcom_Admin', 'ZBQCn;_VfX=W');
	$DB_con = new PDO('mysql:host=localhost;dbname=anegociarcom_BDAnegociar', 'root', '');

}
catch (PDOException $e) 
{
    echo 'Error: ' . $e->getMessage();
    exit();
}
