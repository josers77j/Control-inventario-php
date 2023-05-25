<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class TablaProductos{

	public function mostrarTablaProductos(){

		$item = null;
    	$valor = null;
    	$orden = "codigo_producto";

  		$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);	

  		if(count($productos) == 0){

  			echo '{"data": []}';
		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($productos); $i++){

		  	$item = "codigo_producto";
		  	$valor = $productos[$i]["id_categoria"];
			
  			if($productos[$i]["cantidad"] < 10){
				$stock = "<button class='btn btn-danger'>".$productos[$i]["cantidad"]."</button>";
			}else if($productos[$i]["cantidad"] >= 10 && $productos[$i]["cantidad"] < 20){
				$stock = "<button class='btn btn-warning'>".$productos[$i]["cantidad"]."</button>";
			}else{
				$stock = "<button class='btn btn-success'>".$productos[$i]["cantidad"]."</button>";
			}
			
			if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Usuario"){
				$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["codigo_producto"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button></div>"; 
			}else{
				 $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["codigo_producto"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["codigo_producto"]."'><i class='fa fa-times'></i></button></div>"; 
			}

		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$productos[$i]["codigo_producto"].'",
			      "'.$productos[$i]["nombre"].'",
				  "'.$productos[$i]["precio_unitario"].'",	
				  "'.$productos[$i]["numero_contrato"].'",	
				  "'.$productos[$i]["numero_oferta_compra"].'",	
			      "'.$stock.'",
			      "'.$productos[$i]["fecha_recepcion"].'",
			      "'.$productos[$i]["categoria"].'",
			      "'.$productos[$i]["estado"].'",
			      "'.$botones.'"
			    ],';
		                    
		  }

		$datosJson = substr($datosJson, 0, -1);
		$datosJson .=   '] 

		}';
		
		echo $datosJson;
	}
}

$activarProductos = new TablaProductos();
$activarProductos -> mostrarTablaProductos();

