<?php
require_once "../controladores/gestor-programas.controlador.php";
require_once "../modelos/gestor-programas.modelo.php";

class AjaxGestorProductos{
    

    public function ajaxObtenerGestorProductos(){
        $item = "id_programa_productos";
        $valor = $_GET["id"];

        $respuesta = ControladorGestorProductos::ctrMostrarGestorProductos($item, $valor);
        echo json_encode($respuesta);
    }

    public function ajaxMostrarGestorProductos(){
        $item = null;
        $valor = null;
        $respuesta = ControladorGestorProductos::ctrMostrarGestorProductos($item,$valor);   
        echo json_encode($respuesta);
    }

    public function ajaxAnularGestorProductos(){
        $id = $_GET["id"];
        $respuesta = ControladorGestorProductos::ctrAnularGestorProductos($id);
        echo json_encode($respuesta);
    }

    public function ajaxNuevoGestorProductos(){
        $data = array(  $_POST["nuevoProductoGestorProductos"],
                        $_POST["nuevoCantidadGestorProductos"],
                        $_POST["nuevoFechallegadaGestorProductos"],
                        $_POST["nuevoFechaemisionGestorProductos"],
                        $_POST["nuevoStatusGestorProductos"]);
        $respuesta = ControladorGestorProductos::crtCrearGestorProductos($data);
        echo json_encode($respuesta);
    }

    public function ajaxBuscarProducto(){
        $buscar = $_GET['buscar'];
        $respuesta = ControladorGestorProductos::ctrBuscarProducto($buscar);
        echo json_encode($respuesta);
    }

    public function ajaxDetalleProducto(){
        $buscar = $_GET['buscar'];
        $respuesta = ControladorGestorProductos::ctrBuscarProducto($buscar);
        echo json_encode($respuesta);
    }
    public function ajaxMostrarDetalleProducto()
    {
        $idProgramaProducto = $_GET["idProgramaProducto"];
        $respuesta = ControladorGestorProductos::ctrMostrarDetalleProducto($idProgramaProducto);
        echo json_encode($respuesta);
    }

    public function ajaxAgregarGestorProductos()
    {
        $data = array(
             $_POST["nuevoProductoInventario"],
             $_POST["nuevoCantidadInventario"],
             $_POST["idprogramaproducto"]       
        );
        $respuesta = ControladorGestorProductos::ctrAgregarDetalleProducto($data);
        echo json_encode($respuesta);
    }

    public function ajaxEliminarProducto(){
        $id = $_GET["id"];
        $respuesta = ControladorGestorProductos::ctrEliminarDetalleProductos($id);
        echo json_encode($respuesta);
    }
}

if (isset($_POST["metodo"])) {
    switch($_POST["metodo"]){
        case 'nuevo':
            $gestorproducto = new AjaxGestorProductos();
            $gestorproducto->ajaxNuevoGestorProductos();
        break;

        case 'agregar':
            $gestorproducto = new AjaxGestorProductos();
            $gestorproducto->ajaxAgregarGestorProductos();
        break;          
    } 
}
if (isset($_GET["metodo"])) {
    switch ($_GET["metodo"]) {
        case 'mostrar':
                $gestorproducto = new AjaxGestorProductos();
                $gestorproducto->ajaxMostrarGestorProductos();
            break;
        case 'obtener':
                $gestorproducto = new AjaxGestorProductos();
                $gestorproducto->ajaxObtenerGestorProductos();
            break;
        case 'anular':
                $gestorproducto = new AjaxGestorProductos();
                $gestorproducto->ajaxAnularGestorProductos();
            break;
        case 'detalle':
            $gestorproducto = new AjaxGestorProductos();
            $gestorproducto->ajaxMostrarDetalleProducto();
            break;
        case 'buscar':
            $gestorproducto = new AjaxGestorProductos();
            $gestorproducto->ajaxBuscarProducto();
            break;    

        case 'eliminar':
            $gestorproducto = new AjaxGestorProductos();
            $gestorproducto->ajaxEliminarProducto();
            break;    
    }
    
}

