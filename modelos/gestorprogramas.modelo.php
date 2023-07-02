<?php
require_once "conexion.php";
class ModeloGestorProgramas{

    static public function mdlMostrarGestorProgramas($valor){
        
		if($valor != null){
			$stmt = Conexion::conectar()->prepare("call getEditProgramProduct(:valor)");
			$stmt -> bindParam(":valor", $valor, PDO::PARAM_INT);
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
		$stmt = Conexion::conectar()->prepare("call insertGestorProgram(:id_usuario,:id_programa,:fecha,:total,:cantidad,:id_status)");
		
        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":id_programa", $datos["id_programa"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(":total", $datos["total"]);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
        $stmt->bindParam(":id_status", $datos["id_status"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;

	}
	
	static public function mdlEditarGestorProgramas($datos){
		$stmt = Conexion::conectar()->prepare("call updateProgramProduct(:idPrograma,:total,:cantidad,:idProgramaProducto)");
		
        $stmt->bindParam(":idPrograma", $datos["id_programa"], PDO::PARAM_INT);
        $stmt->bindParam(":total", $datos["total"], PDO::PARAM_INT);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
        $stmt->bindParam(":idProgramaProducto", $datos["idProgramaProducto"], PDO::PARAM_INT);
      

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;

	}


    static public function mdlAnularGestorProgramas($id){
		$stmt = Conexion::conectar()->prepare("call anularGestorProgram(:id)");
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

	static public function mdlObtenerPresupuesto($id){
		$stmt = Conexion::conectar()->prepare("call getBudget('$id');");
		$stmt->execute();
		
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlBuscarPrograma($buscar){
		$stmt = Conexion::conectar()->prepare("call finderProgram('$buscar');");
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
