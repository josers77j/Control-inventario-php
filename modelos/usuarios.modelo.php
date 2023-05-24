<?php

require_once "conexion.php";

class ModeloUsuarios{
	static public function mdlMostrarUsuarios($tabla1, $tabla2, $tabla3, $item, $valor){
		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT u.id_usuario, u.token, u.usuario, u.nombres, u.correo, u.telefono, u.contrasenia, s.id_status, s.nombre as 'estado', r.id_rol, r.nombre as 'role' 
				FROM $tabla1 AS u 
				INNER JOIN $tabla2 AS s ON u.id_status = s.id_status 
				INNER JOIN $tabla3 AS r ON u.id_rol = r.id_rol 
				WHERE $item = :valor
				ORDER BY u.id_usuario DESC");
				
			$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetch();
		}else{
			$stmt = Conexion::conectar()->prepare(
				"SELECT u.id_usuario, u.token, u.usuario, u.nombres, u.correo, u.telefono, u.contrasenia, s.id_status, s.nombre as 'estado', r.id_rol, r.nombre as 'role' 
					FROM $tabla1 AS u 
					INNER JOIN $tabla2 AS s ON u.id_status = s.id_status 
					INNER JOIN $tabla3 AS r ON u.id_rol = r.id_rol 
					ORDER BY u.id_usuario DESC;");

			$stmt -> execute();

			return $stmt -> fetchAll();
		}
		
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlIngresarUsuario($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(usuario, nombres, correo, telefono, contrasenia, id_rol, id_status) VALUES (:usuario, :nombres, :correo, :telefono, :contrasenia, :id_rol, :id_status)");

		$stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
		$stmt -> bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt -> bindParam(":contrasenia", $datos["contrasenia"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_rol", $datos["id_rol"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_status", $datos["id_status"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";	
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;

	}

	static public function mdlEditarUsuario($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombres = :nombres, correo = :correo, telefono = :telefono, contrasenia = :contrasenia, id_rol = :id_rol, id_status = :id_status WHERE usuario = :usuario");

		$stmt -> bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
		$stmt -> bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt -> bindParam(":contrasenia", $datos["contrasenia"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_rol", $datos["id_rol"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_status", $datos["id_status"], PDO::PARAM_STR);
		$stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";	
		}

		$stmt -> close();
		$stmt = null;

	}

	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";	
		}

		$stmt -> close();
		$stmt = null;

	}

	static public function mdlBorrarUsuario($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id");
		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);
		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";	
		}

		$stmt -> close();
		$stmt = null;
	}

}