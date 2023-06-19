<?php
require_once "conexion.php";
class ModeloGestorProgramas{

    static public function mdlMostrarGestorProgramas($tabla, $item, $valor){
        
		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("call getProgramProduct()");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		$stmt -> close();
		$stmt = null;

	}

    static public function mdlIngresarGestorProgramas($datos){
		$stmt = Conexion::conectar()->prepare("call InventorytoProductStock(:codigoproducto, :cantidadinventario, :fechallegadaproducto, :fecharegistro, :idstatus)");
		
        $stmt->bindParam(":codigoproducto", $datos["codigoproducto"], PDO::PARAM_INT);
        $stmt->bindParam(":cantidadinventario", $datos["cantidadinventario"], PDO::PARAM_INT);
        $stmt->bindParam(":fechallegadaproducto", $datos["fechallegadaproducto"], PDO::PARAM_STR);
        $stmt->bindParam(":fecharegistro", $datos["fecharegistro"], PDO::PARAM_STR);
        $stmt->bindParam(":idstatus", $datos["idstatus"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;

	}


    static public function mdlBorrarGestorProgramas($tabla, $id){
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

	
	static public function mdlBuscarProducto($buscar){
		$stmt = Conexion::conectar()->prepare("call finderProduct('$buscar');");
		$stmt->execute();
		
		return $stmt->fetchAll();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlMostrarDetalleProducto($idProgramaProducto)
	{
		$stmt = Conexion::conectar()->prepare("call getDetailProduct($idProgramaProducto)");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlAgregarDetalleProducto($datos){
		$stmt = Conexion::conectar()->prepare("call managerDetailProduct(:producto,:cantidad,:idprogramaproducto)");
		
        $stmt->bindParam(":producto", $datos["producto"], PDO::PARAM_INT);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
        $stmt->bindParam(":idprogramaproducto", $datos["idprogramaproducto"], PDO::PARAM_INT);
      

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;

	}

	
    static public function mdlEliminarDetalleProgramas($id){
		$stmt = Conexion::conectar()->prepare("call deleteDetailProduct(:id)");
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
