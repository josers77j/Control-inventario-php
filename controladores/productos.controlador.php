<?php
date_default_timezone_set('America/Costa_Rica');
class ControladorProductos{

	static public function ctrMostrarProductos($item, $valor, $orden){
		$tabla1 = "tbl_productos";
        $tabla2 = "tbl_categoria";
		$tabla3 = "tbl_status";

		$respuesta = ModeloProductos::mdlMostrarProductos($tabla1, $tabla2, $tabla3, $item, $valor, $orden);
		return $respuesta;

	}

	static public function ctrMostrarProductosInactivos(){
		
		$respuesta = ModeloProductos::mdlMostrarProductosInactivos();
		return $respuesta;

	}

	static public function ctrCrearProducto(){
		if(isset($_POST["nuevoNombreProducto"])){
			if(	preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombreProducto"]) &&
			preg_match('/^[-+]?[0-9]+(\.[0-9]+)?$/', $_POST["nuevoPrecioUnitarioProducto"]) &&
			preg_match('/^[0-9 ]+$/', $_POST["nuevaCantidadProducto"]) &&
			preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNumeroContratoProducto"]) &&
			preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNumeroOfertaCompraProducto"])){

				$tabla = "tbl_productos";

				$datos = array("nombre" => $_POST["nuevoNombreProducto"],
							   "precio_unitario" => $_POST["nuevoPrecioUnitarioProducto"],
							   "cantidad" => $_POST["nuevaCantidadProducto"],
							   "numero_contrato" => $_POST["nuevoNumeroContratoProducto"],
							   "numero_oferta_compra" => $_POST["nuevoNumeroOfertaCompraProducto"],
							   "fecha_recepcion" => $_POST["nuevaFechaRecepcionProducto"],
                               "id_categoria" => $_POST["nuevaIdCategoriaProducto"],
							   "id_status" => 1,
							   "fecha_registro" => date("Y-m-d"),
							   "token" => $_POST["token"],
		                    );
                  
				$respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);

				if($respuesta == "ok"){
					echo'<script>

						swal({
							  type: "success",
							  title: "El producto ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "productos";

										}
									})
						</script>';
				}


			}else{

				echo'<script>
					swal({
						  type: "error",
						  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {
							window.location = "productos";
							}
						})
			  	</script>';
			}
		}

	}



	static public function ctrEditarProducto(){
		if(isset($_POST["editarNombreProducto"])){
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreProducto"])){

				$tabla = "tbl_productos";

				$datos = array("codigo_producto" => $_POST["editarCodigoProducto"],
							   "nombre" => $_POST["editarNombreProducto"],
							   "precio_unitario" => $_POST["editarPrecioUnitarioProducto"],
							   "numero_contrato" => $_POST["editarNumeroContratoProducto"],
							   "numero_oferta_compra" => $_POST["editarNumeroOfertaCompraProducto"],
							   "fecha_recepcion" => $_POST["editarFechaRecepcionProducto"],
                               "id_categoria" => $_POST["editarIdCategoriaProducto"],

		                    );

				$respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>
						swal({
							  type: "success",
							  title: "El producto ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "productos";

										}
									})
						</script>';
				}


			}else{

				echo'<script>
					swal({
						  type: "error",
						  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "productos";

							}
						})
			  	</script>';
			}
		}

	}

	static public function ctrEliminarProducto(){

		if(isset($_GET["idProducto"])){

			$tabla ="tbl_productos";
			$datos = $_GET["idProducto"];

			$respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);
			if($respuesta == "ok"){

				echo'<script>
				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "productos";

								}
							})

				</script>';

			}		
		}


	}

	static public function ctrReactivarProductos($id){
		$respuesta = ModeloProductos::mdlReactivarProducto($id);
		return $respuesta;

	}

}