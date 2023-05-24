<?php

class ControladorRole{

	static public function ctrCrearRole(){
		if(isset($_POST["nuevoNombreRole"])){
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombreRole"])){
				
                $tabla = "tbl_roles";

                $datos = array("nombre" => $_POST["nuevoNombreRole"],
					           "descripcion" => $_POST["nuevoDescripcionRole"],
                            );

				$respuesta = ModeloRole::mdlIngresarRole($tabla, $datos);

				if($respuesta == "ok"){
					echo'<script>
					swal({
						  type: "success",
						  title: "El role ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "role";

									}
								})

					</script>';
				}
			}else{
				echo'<script>
					swal({
						  type: "error",
						  title: "¡El role no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "role";

							}
						})
			  	</script>';
			}

		}

	}


	static public function ctrMostrarRole($item, $valor){
		$tabla = "tbl_roles";
		$respuesta = ModeloRole::mdlMostrarRole($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrEditarRole(){
		if(isset($_POST["editarNombreRole"])){
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreRole"])){
				
                $tabla = "tbl_roles";
                
				$datos = array(
                    "nombre"=>$_POST["editarNombreRole"],
                    "descripcion"=>$_POST["editarDescripcionRole"],
                    "id_rol"=>$_POST["idRole"]);

				$respuesta = ModeloRole::mdlEditarRole($tabla, $datos);

				if($respuesta == "ok"){
					echo'<script>

					swal({
						  type: "success",
						  title: "EL Role ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {
									    window.location = "role";
									}
								})

					</script>';
				}
			}else{
				echo'<script>
					swal({
						  type: "error",
						  title: "¡El Role no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {
							    window.location = "role";
							}
						})
			  	</script>';

			}

		}

	}

	static public function ctrBorrarRole(){
		if(isset($_GET["idRole"])){

			$tabla ="tbl_roles";
			$datos = $_GET["idRole"];

			$respuesta = ModeloRole::mdlBorrarRole($tabla, $datos);
			if($respuesta == "ok"){
				echo'<script>

					swal({
						  type: "success",
						  title: "El rol ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "role";

									}
								})
					</script>';
			}
		}
		
	}
}
