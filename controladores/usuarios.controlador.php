<?php
class ControladorUsuarios{

	static public function ctrIngresoUsuario(){
		if(isset($_POST["ingUsuario"])){
			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"])){

			   	$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$tabla1 = "tbl_usuarios";
				$tabla2 = "tbl_status";
				$tabla3 = "tbl_roles";

				$item = "u.usuario";
				$valor = $_POST["ingUsuario"] ?? '';

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla1, $tabla2, $tabla3, $item, $valor);

				if(is_array($respuesta) && $respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["contrasenia"] == $encriptar){
					if($respuesta["estado"] == "Activo"){
						
                        $_SESSION["iniciarSesion"] = "ok";
						$_SESSION["id_usuario"] = $respuesta["id_usuario"];
						$_SESSION["token"] = $respuesta["token"];
						$_SESSION["usuario"] = $respuesta["usuario"];
						$_SESSION["nombres"] = $respuesta["nombres"];
                        $_SESSION["correo"] = $respuesta["correo"];
						$_SESSION["telefono"] = $respuesta["telefono"];
                        $_SESSION["contrasenia"] = $respuesta["contrasenia"];
						$_SESSION["role"] = $respuesta["role"];
						$_SESSION["id_rol"] = $respuesta["id_rol"];
						$_SESSION["estado"] = $respuesta["estado"];

                        echo '<script>
								window.location = "inicio";
							</script>';
						
					}else{
						echo '<br>
							<div class="alert alert-danger">El usuario aún no está activado</div>
						';

					}		

				}else{
					echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';



				}

			}	

		}

	}

	static public function ctrCrearUsuario(){
		if(isset($_POST["nuevoUsuario"])){
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])){

				$tabla = "tbl_usuarios";

				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$controlador = new ControladorUsuarios();
				
				$nombre = $_POST["nuevoNombre"];
				$usuario = $_POST["nuevoUsuario"]; 
				$correo = $_POST["nuevoCorreo"]; 
				$telefono = $_POST["nuevoTelefono"];
				$password = $_POST["nuevoPassword"];
				$rol = $_POST["nuevoRol"];

				$token = $controlador->ctrCrearToken($nombre, $usuario, $correo, $password);
				
				$datos = array("usuario" => $usuario,
							   "token" => $token,
					           "nombres" => $nombre,
							   "correo" => $correo,
							   "telefono" => $telefono,
					           "contrasenia" => $encriptar,
					           "id_rol" => $rol,
							   "id_status" => 1
							);
							echo "<script>alert($nombre+$usuario+$correo+$telefono+$password+$token,$rol) </script>";			
				$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
			
				if($respuesta == "ok"){
					echo '<script>
					swal({

						type: "success",
						title: "¡El usuario ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "usuarios";

						}

					});
					</script>';
				}	
			}else{
				echo '<script>
					swal({
						type: "error",
						title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){
						if(result.value){
							window.location = "usuarios";
						}
					});
				</script>';
			}


		}


	}

	public function ctrCrearToken($nombre, $nombre_usuario, $correo, $contrasena) {
		// Concatenar la información en una cadena
		$cadena_datos = $nombre . $nombre_usuario . $correo . $contrasena;
	
		// Generar un identificador único
		$salt = uniqid();
	
		// Concatenar el identificador único con la cadena de datos
		$cadena_datos_con_salt = $cadena_datos . $salt;
	
		// Calcular el hash SHA-256 del token
		$token = hash('sha256', $cadena_datos_con_salt);
	
		return $token;
	}

	static public function ctrMostrarUsuarios($item, $valor){
		$tabla1 = "tbl_usuarios";
		$tabla2 = "tbl_status";
		$tabla3 = "tbl_roles";
		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla1, $tabla2, $tabla3, $item, $valor);
		return $respuesta;
	}

	static public function ctrMostrarUsuariosInactivos($item, $valor){
		$tabla1 = "tbl_usuarios";
		$tabla2 = "tbl_status";
		$tabla3 = "tbl_roles";
		$respuesta = ModeloUsuarios::MdlMostrarUsuariosInactivos($tabla1, $tabla2, $tabla3, $item, $valor);
		return $respuesta;
	}



	static public function ctrEditarUsuario(){
		if(isset($_POST["editarUsuario"])){
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])){

				$tabla = "tbl_usuarios";

				if($_POST["editarPassword"] != ""){

					if($_POST["editarPassword"]){
						$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
					}else{

						echo'<script>

								swal({
									  type: "error",
									  title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result) {
										if (result.value) {
										window.location = "usuarios";
										}
									})

						  	</script>';

						  	return;

					}

				}else{
					$encriptar = $_POST["passwordActual"];
				}

				$datos = array("usuario" => $_POST["editarUsuario"],
							   "nombres" => $_POST["editarNombre"],
							   "correo" => $_POST["editarCorreo"],
							   "telefono" => $_POST["editarTelefono"],
							   "contrasenia" => $encriptar							   
							);
							

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>
					swal({
						  type: "success",
						  title: "El usuario ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "usuarios";

									}
								})
					</script>';

				}


			}else{

				echo'<script>
					swal({
						  type: "error",
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
							if (result.value) {

							window.location = "usuarios";

							}
						})
			  	</script>';

			}

		}

	}

	static public function ctrBorrarUsuario(){
		if(isset($_GET["idUsuario"])){
			
			$tabla ="tbl_usuarios";
			$datos = $_GET["idUsuario"];

			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

			if($respuesta == "ok"){
				echo'<script>

				swal({
					  type: "success",
					  title: "El usuario ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "usuarios";

								}
							})
				</script>';

			}		

		}

	}
}