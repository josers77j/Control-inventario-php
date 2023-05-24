<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/role.controlador.php";
require_once "controladores/status.controlador.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/role.modelo.php";
require_once "modelos/status.modelo.php";


$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();