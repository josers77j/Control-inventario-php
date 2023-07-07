<?php
require_once "../controladores/notificaciones.controlador.php";
require_once "../modelos/notificaciones.modelo.php";

class AjaxInicio{
    
    public function ajaxMostrarNotificaciones(){
        $token = $_GET["token"];
        $respuesta = ControladorNotificaciones::ctrMostrarNotificaciones($token);   
        echo json_encode($respuesta);
    }

    public function ajaxDesactivarNotificaciones(){
        $id = $_GET["id"];
        $respuesta = ControladorNotificaciones::ctrDesactivarNotificaciones($id);   
        echo json_encode($respuesta);
    }

    public function ajaxDesactivarTodoNotificaciones(){
        $respuesta = ControladorNotificaciones::ctrDesactivarTodoNotificaciones();   
        echo json_encode($respuesta);
    }
}

if (isset($_GET["metodo"])) {
    switch ($_GET["metodo"]) {
        case 'mostrar':
                $categoria = new AjaxInicio();
                $categoria->ajaxMostrarNotificaciones();
            break;            
            case 'desactivar':
                $categoria = new AjaxInicio();
                $categoria->ajaxDesactivarNotificaciones();
            break;        
            case 'desactivartodo':
                $categoria = new AjaxInicio();
                $categoria->ajaxDesactivarTodoNotificaciones();
            break;       
    }
    
}

