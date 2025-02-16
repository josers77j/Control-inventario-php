<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxProductos{

  public $idCategoria;

  public function ajaxCrearCodigoProducto(){

  	$item = "id_categoria";
  	$valor = $this->idCategoria;
    $orden = "codigo_producto";

  	$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

  	echo json_encode($respuesta);

  }

  public $idProducto;
  public $traerProductos;
  public $nombreProducto;

  public function ajaxEditarProducto(){

    if($this->traerProductos == "ok"){

      $item = null;
      $valor = null;
      $orden = "codigo_producto";

      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

      echo json_encode($respuesta);


    }else if($this->nombreProducto != ""){

      $item = "nombre";
      $valor = $this->nombreProducto;
      $orden = "codigo_producto";

      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

      echo json_encode($respuesta);

    }else{

      $item = "codigo_producto";
      $valor = $this->idProducto;
      $orden = "codigo_producto";

      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor,$orden);

      echo json_encode($respuesta);

    }

  }

  public function ajaxObtenerProductosInactivos(){
  	$respuesta = ControladorProductos::ctrMostrarProductosInactivos();
  	echo json_encode($respuesta);

  }


  public function ajaxReactivarProductos(){
    $id = $_GET["id"];
  	$respuesta = ControladorProductos::ctrReactivarProductos($id);
  	echo json_encode($respuesta);

  }

  public $validarProducto;
	public function ajaxValidarProducto(){

    
    $orden = "p.nombre";
    $item = "p.nombre";
		$valor = $this->validarProducto;

  
		$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

		echo json_encode($respuesta);

	}

}

if(isset($_POST["idCategoria"])){

	$codigoProducto = new AjaxProductos();
	$codigoProducto -> idCategoria = $_POST["idCategoria"];
	$codigoProducto -> ajaxCrearCodigoProducto();

}

if(isset($_POST["idProducto"])){

  $editarProducto = new AjaxProductos();
  $editarProducto -> idProducto = $_POST["idProducto"];
  $editarProducto -> ajaxEditarProducto();

}

if(isset($_POST["traerProductos"])){

  $traerProductos = new AjaxProductos();
  $traerProductos -> traerProductos = $_POST["traerProductos"];
  $traerProductos -> ajaxEditarProducto();

}

if(isset($_POST["nombreProducto"])){

  $traerProductos = new AjaxProductos();
  $traerProductos -> nombreProducto = $_POST["nombreProducto"];
  $traerProductos -> ajaxEditarProducto();

}

if(isset( $_POST["validarProducto"])){

	$valProducto = new AjaxProductos();
	$valProducto -> validarProducto = $_POST["validarProducto"];
	$valProducto -> ajaxValidarProducto();

}

if(isset($_GET["metodo"])){
  switch ($_GET["metodo"]) {

    case 'inactivo':
      $traerProductos = new AjaxProductos();
      $traerProductos -> ajaxObtenerProductosInactivos();
      break;
    case 'reactivar':
      $reactivarProductos = new AjaxProductos();
      $reactivarProductos ->ajaxReactivarProductos();
    
  
  }
}