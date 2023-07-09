<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/role.controlador.php";
require_once "controladores/status.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/programas.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/inventario.controlador.php";
require_once "controladores/gestorprogramas.controlador.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/role.modelo.php";
require_once "modelos/status.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/programas.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/inventario.modelo.php";
require_once "modelos/gestorprogramas.modelo.php";
require_once "modelos/reportes.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();