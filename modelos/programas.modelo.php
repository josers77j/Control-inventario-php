<?php
require_once "conexion.php";
class ModeloProgramas{

    static public function mdlMostrarProgramas($tabla, $item, $valor){

		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch(PDO::FETCH_ASSOC);
		}else{
			$stmt = Conexion::conectar()->prepare("call getProgram()");
			$stmt -> execute();
			return $stmt -> fetchAll(PDO::FETCH_ASSOC);
		}

		$stmt -> close();
		$stmt = null;

	}

    static public function mdlIngresarProgramas($tabla, $datos){
		$stmt = Conexion::conectar()->prepare(
            "INSERT INTO $tabla (nombre, descripcion,presupuesto,fecha,id_status) 
            VALUES (:nombre, :descripcion, :presupuesto, :fecha, :id_status)"
            );
		
   
        $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":presupuesto", $datos["presupuesto"], PDO::PARAM_STR);
        $stmt -> bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);		
        $stmt -> bindParam(":id_status", $datos["id_status"], PDO::PARAM_INT);
		
		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;

	}


    static public function mdlEditarProgramas($tabla, $datos){

		$stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla SET 
            nombre = :nombre, 
            descripcion = :descripcion,
            presupuesto = :presupuesto
            WHERE id_programa = :id"
        );

        $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":presupuesto", $datos["presupuesto"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id_programa"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

    static public function mdlBorrarProgramas($datos){
		$stmt = Conexion::conectar()->prepare("call anularProgram(:id)");
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
