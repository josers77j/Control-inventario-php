<?php

require_once "conexion.php";

class ModeloReportes{

    static public function mdlMostrarHistorialEntrada($fechaInicio, $fechaFin, $Istatus){
        
		if($Istatus != null){
			$stmt = Conexion::conectar()->prepare("CALL getReporteHistorialEntrada(:fechaInicio, :fechaFin, :Istatus)");

			$stmt->bindParam(':fechaInicio', $fechaInicio, PDO::PARAM_STR);
			$stmt->bindParam(':fechaFin', $fechaFin, PDO::PARAM_STR);
			$stmt->bindParam(':Istatus', $Istatus, PDO::PARAM_INT);
	
			$stmt->execute();
			return $stmt->fetchAll();
		}else{
			$stmt = Conexion::conectar()->prepare("call getReporteHistorialEntrada()");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		$stmt -> close();
		$stmt = null;

	}

    static public function mdlMostrarHistorialSalida($fechaInicio, $fechaFin, $Istatus){
        
		if($Istatus != null){
			$stmt = Conexion::conectar()->prepare("call getReporteHistorialSalida(:fechaInicio, :fechaFin, :Istatus)");

			$stmt->bindParam(':fechaInicio', $fechaInicio, PDO::PARAM_STR);
			$stmt->bindParam(':fechaFin', $fechaFin, PDO::PARAM_STR);
			$stmt->bindParam(':Istatus', $Istatus, PDO::PARAM_INT);

			$stmt -> execute();
			return $stmt -> fetchAll();
		}else{
			$stmt = Conexion::conectar()->prepare("call getReporteHistorialSalida()");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		$stmt -> close();
		$stmt = null;

	}

    static public function mdlMostrarInventarioActual($status){
        
		if($status != null){
			$stmt = Conexion::conectar()->prepare("call getReporteInventarioActual($status)");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}else{
			$stmt = Conexion::conectar()->prepare("call getReporteInventarioActual()");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		$stmt -> close();
		$stmt = null;

	}

    static public function mdlMostrarProductoBajoStock($status){
        
		if($status != null){
			$stmt = Conexion::conectar()->prepare("call getReporteProductosBajoStock($status)");

			$stmt -> execute();
			return $stmt -> fetchAll();
		}else{
			$stmt = Conexion::conectar()->prepare("call getReporteProductosBajoStock()");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		$stmt -> close();
		$stmt = null;

	}

}
