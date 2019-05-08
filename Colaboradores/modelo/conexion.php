<?php

class Conexion{

	public static function conectar(){
	    try{
            #$link = new PDO("mysql:host=localhost;dbname=bdanegociar_equipo;charset=utf8","root","root1234");
            $link = new PDO("mysql:host=anegociar.com.pe;dbname=anegociarcom_BDAnegociar;charset=utf8","anegociarcom_Admin","ZBQCn;_VfX=W");
            return $link;
        }catch (PDOException $e){
	        return print_r($e->getMessage());
        }
	}

}
