<?php
require_once "../controladores/inicio.controlador.php";
require_once "../modelos/inicio.modelo.php";

class AjaxInicio{
    
    public function ajaxMostrarInicio(){
        $respuesta = ControladorInicio::ctrMostrarInicio();   
        echo json_encode($respuesta);
    }

    public function ajaxMostrarBanner(){
        $respuesta = ControladorInicio::ctrMostrarBanner();   
        echo json_encode($respuesta);
    }
}

if (isset($_GET["metodo"])) {
    switch ($_GET["metodo"]) {
        case 'mostrar':
                $categoria = new AjaxInicio();
                $categoria->ajaxMostrarInicio();
            break;
        case 'mostrarBanner':
                $categoria = new AjaxInicio();
                $categoria->ajaxMostrarBanner();
            break;            
    }
    
}

