<?php
require_once "conexion.php";
class ModeloInventario{

    static public function mdlMostrarInventario($tabla, $item, $valor){

		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("call getInventory()");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		$stmt -> close();
		$stmt = null;

	}

    static public function mdlIngresarInventario($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("call InventorytoProductStock(:codigoproducto, :cantidadinventario, :fechallegadaproducto, :fecharegistro, :idstatus,:token)");
		
        $stmt->bindParam(":codigoproducto", $datos["codigoproducto"], PDO::PARAM_INT);
        $stmt->bindParam(":cantidadinventario", $datos["cantidadinventario"], PDO::PARAM_INT);
        $stmt->bindParam(":fechallegadaproducto", $datos["fechallegadaproducto"], PDO::PARAM_STR);
        $stmt->bindParam(":fecharegistro", $datos["fecharegistro"], PDO::PARAM_STR);
        $stmt->bindParam(":idstatus", $datos["idstatus"], PDO::PARAM_INT);
		$stmt->bindParam(":token", $datos["token"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;

	}


    static public function mdlEditarInventario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, descripcion = :descripcion WHERE id_categoria = :id");

        $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id_categoria"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

    static public function mdlBorrarInventario($tabla, $id){
		$stmt = Conexion::conectar()->prepare("call anularInventario(:id)");
		$stmt -> bindParam(":id", $id, PDO::PARAM_INT);

		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";	
		}

		$stmt -> close();
		$stmt = null;

	}
}
