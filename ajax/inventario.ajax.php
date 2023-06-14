<?php
require_once "../controladores/inventario.controlador.php";
require_once "../modelos/inventario.modelo.php";

class AjaxInventario{
    

    public function ajaxObtenerInventario(){
        $item = "id_inventario";
        $valor = $_GET["id"];

        $respuesta = ControladorInventario::ctrMostrarInventario($item, $valor);
        echo json_encode($respuesta);
    }

    public function ajaxMostrarInventario(){
        $item = null;
        $valor = null;
        $respuesta = ControladorInventario::ctrMostrarInventario($item,$valor);   
        echo json_encode($respuesta);
    }

    public function ajaxAnularInventario(){
        $id = $_GET["id"];
        $respuesta = ControladorInventario::ctrAnularInventario($id);
        echo json_encode($respuesta);
    }

    public function ajaxNuevoInventario(){
        $data = array(  $_POST["nuevoProductoInventario"],
                        $_POST["nuevoCantidadInventario"],
                        $_POST["nuevoFechallegadaInventario"],
                        $_POST["nuevoFechaemisionInventario"],
                        $_POST["nuevoStatusInventario"]);
        $respuesta = ControladorInventario::crtCrearInventario($data);
        echo json_encode($respuesta);
    }

    public function ajaxEditarInventario(){
        $data = array($_POST["editarNombreInventario"],$_POST["editarDescripcionInventario"], $_POST["id"]);
        $respuesta = ControladorInventario::ctrEditarInventario($data);
        echo json_encode($respuesta);
    }

}

if (isset($_POST["metodo"])) {
    switch($_POST["metodo"]){
        case 'nuevo':
            $categoria = new AjaxInventario();
            $categoria->ajaxNuevoInventario();
        break;
        case 'editar':
            $categoria = new AjaxInventario();
            $categoria->ajaxEditarInventario();
        break;        
    } 
}
if (isset($_GET["metodo"])) {
    switch ($_GET["metodo"]) {
        case 'mostrar':
                $categoria = new AjaxInventario();
                $categoria->ajaxMostrarInventario();
            break;
        case 'obtener':
                $categoria = new AjaxInventario();
                $categoria->ajaxObtenerInventario();
            break;
        case 'anular':
                $categoria = new AjaxInventario();
                $categoria->ajaxAnularInventario();
            break;    
    }
    
}

