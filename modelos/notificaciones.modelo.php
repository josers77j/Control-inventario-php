<?php
require_once "conexion.php";
class ModeloNotificaciones
{

    static public function mdlMostrarNotificaciones($token)
    {

        $stmt = Conexion::conectar()->prepare("call getAlert($token)");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->close();
        $stmt = null;
    }

    static public function mdlDesactivarNotificaciones($id)
    {

        $stmt = Conexion::conectar()->prepare("call deactivateNotification($id)");
        
        return $stmt->execute();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlDesactivarTodoNotificaciones($id)
    {

        $stmt = Conexion::conectar()->prepare("call desactivateNotifications($id)");
        
        return $stmt->execute();
        $stmt->close();
        $stmt = null;
    }
}
