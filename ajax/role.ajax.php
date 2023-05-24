<?php

require_once "../controladores/role.controlador.php";
require_once "../modelos/role.modelo.php";

class AjaxRole{

	public $idRole;

	public function ajaxEditarRole(){

		$item = "id_rol";
		$valor = $this->idRole;

		$respuesta = ControladorRole::ctrMostrarRole($item, $valor);
		echo json_encode($respuesta);

	}
}

if(isset($_POST["idRole"])){

	$role = new AjaxRole();
	$role -> idRole = $_POST["idRole"];
	$role -> ajaxEditarRole();
}
