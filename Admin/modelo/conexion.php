<?php

class Conexion{

	public static function conectar(){
		#$link = new PDO("mysql:host=localhost;dbname=bdanegociar_equipo","root","root1234");
		$link = new PDO("mysql:host=anegociar.com.pe;dbname=anegociarcom_BDAnegociar;charset=utf8","anegociarcom_Admin","ZBQCn;_VfX=W");
		return $link;
	}

}
