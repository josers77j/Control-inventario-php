<?php
class ControladorNotificaciones
{
    
    static public function ctrMostrarNotificaciones($token)
    {
        return $respuesta = ModeloNotificaciones::mdlMostrarNotificaciones($token);
    }
    static public function ctrDesactivarNotificaciones($id)
    {
        return $respuesta = ModeloNotificaciones::mdlDesactivarNotificaciones($id);
    }
    static public function ctrDesactivarTodoNotificaciones()
    {
        return $respuesta = ModeloNotificaciones::mdlDesactivarTodoNotificaciones();
    }
}
