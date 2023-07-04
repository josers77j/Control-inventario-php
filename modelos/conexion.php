<?php
class Conexion{
	static public function conectar(){
		$link = new PDO("mysql:host=localhost;dbname=insaforp", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$link->exec("set names utf8");
		return $link;
	}
}
