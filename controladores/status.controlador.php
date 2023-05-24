<?php

class ControladorStatus{

	static public function ctrCrearStatus(){
		if(isset($_POST["nuevoNombreStatus"])){
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombreStatus"])){
				
                $tabla = "tbl_status";

                $datos = $_POST["nuevoNombreStatus"];

				$respuesta = ModeloStatus::mdlIngresarStatus($tabla, $datos);

				if($respuesta == "ok"){
					echo'<script>
					swal({
						  type: "success",
						  title: "El Status ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "status";

									}
								})

					</script>';
				}
			}else{
				echo'<script>
					swal({
						  type: "error",
						  title: "¡El Status no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "status";

							}
						})
			  	</script>';
			}

		}

	}


	static public function ctrMostrarStatus($item, $valor){
		$tabla = "tbl_status";
		$respuesta = ModeloStatus::mdlMostrarStatus($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrEditarStatus(){
		if(isset($_POST["editarNombreStatus"])){
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreStatus"])){
				
                $tabla = "tbl_status";
                
				$datos = array(
                    "nombre"=>$_POST["editarNombreStatus"],
                    "id_status"=>$_POST["idStatus"]);

				$respuesta = ModeloStatus::mdlEditarStatus($tabla, $datos);

				if($respuesta == "ok"){
					echo'<script>

					swal({
						  type: "success",
						  title: "El Status ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {
									    window.location = "status";
									}
								})

					</script>';
				}
			}else{
				echo'<script>
					swal({
						  type: "error",
						  title: "¡El Status no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {
							    window.location = "status";
							}
						})
			  	</script>';

			}

		}

	}

	static public function ctrBorrarCategoria(){
		if(isset($_GET["idStatus"])){

			$tabla ="tbl_status";
			$datos = $_GET["idStatus"];

			$respuesta = ModeloRole::mdlBorrarRole($tabla, $datos);
			if($respuesta == "ok"){
				echo'<script>

					swal({
						  type: "success",
						  title: "El Status ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "status";

									}
								})
					</script>';
			}
		}
		
	}
}
