<?php
require_once "../controladores/inicio.controlador.php";
require_once "../modelos/inicio.modelo.php";

class AjaxInicio{
    
    public function ajaxMostrarCategoria(){
        $item = null;
        $valor = null;
        $respuesta = ControladorCategoria::ctrMostrarCategoria($item,$valor);   
        echo json_encode($respuesta);
    }
}

if (isset($_GET["metodo"])) {
    switch ($_GET["metodo"]) {
        case 'mostrar':
                $categoria = new AjaxInicio();
                $categoria->ajaxMostrarCategoria();
            break;            
    }
    
}

