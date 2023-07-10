<?php

require_once "conexion.php";

class ModeloProductos{

	static public function mdlMostrarProductos($tabla1, $tabla2, $tabla3, $item, $valor, $orden){

		if($item != null){
			$stmt = Conexion::conectar()->prepare(
                "SELECT p.codigo_producto, p.nombre, p.precio_unitario, p.cantidad, p.numero_contrato, p.numero_oferta_compra, p.fecha_recepcion, s.id_status, s.nombre as 'estado', c.id_categoria, c.nombre as 'categoria' 
                FROM $tabla1 AS p 
                INNER JOIN $tabla2 AS c ON p.id_categoria = c.id_categoria 
                INNER JOIN $tabla3 AS s ON p.id_status = s.id_status 
                WHERE $item = :valor
                ORDER BY $orden DESC;"
            );
			$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
            
			$stmt = Conexion::conectar()->prepare(
                "SELECT p.codigo_producto, p.nombre, p.precio_unitario, p.cantidad, p.numero_contrato, p.numero_oferta_compra, p.fecha_recepcion, s.id_status, s.nombre as 'estado', c.id_categoria, c.nombre as 'categoria' 
                FROM $tabla1 AS p 
                INNER JOIN $tabla2 AS c ON p.id_categoria = c.id_categoria 
                INNER JOIN $tabla3 AS s ON p.id_status = s.id_status 
                ORDER BY p.codigo_producto DESC;"
            );
			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		$stmt -> close();
		$stmt = null;

	}

	static public function mdlIngresarProducto($tabla, $datos){
		
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo_producto, nombre, precio_unitario, cantidad, numero_contrato, numero_oferta_compra, fecha_recepcion, id_categoria, id_status) VALUES (:codigo_producto, :nombre, :precio_unitario, :cantidad, :numero_contrato, :numero_oferta_compra, :fecha_recepcion, :id_categoria, :id_status)");
		
		$stmt->bindParam(":codigo_producto", $datos["codigo_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_unitario", $datos["precio_unitario"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		$stmt->bindParam(":numero_contrato", $datos["numero_contrato"], PDO::PARAM_STR);
		$stmt->bindParam(":numero_oferta_compra", $datos["numero_oferta_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_recepcion", $datos["fecha_recepcion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_STR);
		$stmt->bindParam(":id_status", $datos["id_status"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;

	}

	static public function mdlEditarProducto($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, precio_unitario = :precio_unitario, cantidad = :cantidad, numero_contrato = :numero_contrato, numero_oferta_compra = :numero_oferta_compra, fecha_recepcion = :fecha_recepcion, id_categoria = :id_categoria, id_status = :id_status WHERE codigo_producto = :codigo_producto");

		$stmt->bindParam(":codigo_producto", $datos["codigo_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_unitario", $datos["precio_unitario"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		$stmt->bindParam(":numero_contrato", $datos["numero_contrato"], PDO::PARAM_STR);
		$stmt->bindParam(":numero_oferta_compra", $datos["numero_oferta_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_recepcion", $datos["fecha_recepcion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_STR);
		$stmt->bindParam(":id_status", $datos["id_status"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;

	}

	static public function mdlEliminarProducto($tabla, $datos){
		
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE codigo_producto = :id");
		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";	
		}

		$stmt -> close();
		$stmt = null;

	}

	static public function mdlActualizarProducto($tabla, $item1, $valor1, $valor){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE codigo_producto = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";	
		}

		$stmt -> close();
		$stmt = null;

	}

	static public function mdlMostrarProductoBajoStock($status){
        
		if($status != null){
			$stmt = Conexion::conectar()->prepare("call getReporteProductosBajoStock(:status)");
			$stmt -> bindParam(":status", $status, PDO::PARAM_INT);

			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("call getReporteProductosBajoStock()");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		$stmt -> close();
		$stmt = null;

	}

}