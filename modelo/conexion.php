<?php

class Conexion{

	public function conectar(){
		$link = new PDO("mysql:host=localhost;dbname=anegociarcom_bdanegociar;charset=utf8","root","");
		//$link = new PDO("mysql:host=anegociar.com.pe;dbname=anegociarcom_BDAnegociar;charset=utf8","anegociarcom_Admin","ZBQCn;_VfX=W");
		return $link;

	}

}
