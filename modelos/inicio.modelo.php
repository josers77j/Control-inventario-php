<?php
require_once "conexion.php";
class ModeloInicio
{

    static public function mdlMostrarInicio()
    {

        $stmt = Conexion::conectar()->prepare("call getDashboardData()");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->close();
        $stmt = null;
    }

    static public function mdlMostrarBanner()
    {

        $stmt = Conexion::conectar()->prepare("call getInfoStock()");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->close();
        $stmt = null;
    }
}
