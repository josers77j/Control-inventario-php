<?php
class ControladorUsuarios{

	static public function ctrIngresoUsuario(){
		if(isset($_POST["ingUsuario"])){
			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"])){

			   	$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$tabla = "tbl_usuarios";

				$item = "usuario";
				$valor = $_POST["ingUsuario"] ?? '';

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

				if(is_array($respuesta) && $respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["contrasenia"] == $encriptar){
					if($respuesta["id_status"] == 1){
						
                        $_SESSION["iniciarSesion"] = "ok";
						$_SESSION["id_usuario"] = $respuesta["id_usuario"];
						$_SESSION["token"] = $respuesta["token"];
						$_SESSION["usuario"] = $respuesta["usuario"];
						$_SESSION["nombres"] = $respuesta["nombres"];
                        $_SESSION["correo"] = $respuesta["correo"];
						$_SESSION["telefono"] = $respuesta["telefono"];
                        $_SESSION["contrasenia"] = $respuesta["contrasenia"];
						$_SESSION["id_rol"] = $respuesta["id_rol"];
						$_SESSION["id_status"] = $respuesta["id_status"];

                        echo '<script>
								window.location = "inicio";
							</script>';
						
					}else{
						echo '<br>
							<div class="alert alert-danger">El usuario aún no está activado</div>';
					}		

				}else{
					echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
				}

			}	

		}

	}
}
	


